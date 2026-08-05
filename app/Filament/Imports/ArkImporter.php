<?php
namespace App\Filament\Imports;

use App\Ams\Metadata;
use App\Models\Ark as ArkModel;
use App\Models\ArkRevision;
use App\Models\Naan;
use App\Models\SuccessfullImportRow;
use App\Rules\NaanInDatabase;
use Burgerbibliothek\ArkManagementTools\Ark;
use Burgerbibliothek\ArkManagementTools\Erc;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Utilities\Get;

class ArkImporter extends Importer
{
    protected static ?string $model = ArkModel::class;

    /**
     * Import Dialog
     * Form for the import dialog.
     */
    public static function getOptionsFormComponents(): array
    {
        return [
            Select::make('naan')
                ->label(__('ams.ark_resource_import_naan'))
                ->helperText(__('ams.ark_resource_import_naan_helptext'))
                ->options(Naan::all()->whereNotNull('minter_id')->pluck('naan', 'naan'))
                ->required()
                ->live(),
            Select::make('shoulder')
                ->label(__('ams.ark_resource_import_shoulder'))
                ->helperText(__('ams.ark_resource_import_shoulder_helptext'))
                ->placeholder('−')
                ->options(fn(Get $get): array => Naan::shoulders($get('naan')))
                ->visible(fn(Get $get): bool => Naan::hasShoulder($get('naan')))
                ->live(),
            Select::make('metadataMergeStrategy')
                ->label(__('ams.ark_resource_import_mergestrategy'))
                ->helperText(__('ams.ark_resource_import_mergestrategy_helptext'))
                ->options([
                    'keep' => __('ams.ark_resource_import_mergestrategy_keep'), 
                    'overwrite' => __('ams.ark_resource_import_mergestrategy_overwrite')
                ])
                ->default('keep'),
            Checkbox::make('skipExistingUri')
                ->default('true')
                ->label(__('ams.ark_resource_import_skip'))
                ->helperText(__('ams.ark_resource_import_skip_hint')),
            Checkbox::make('emptyMetadataDelete')
                ->label(__('ams.ark_resource_import_emptydatadelete'))
                ->helperText(__('ams.ark_resource_import_emptydatadelete_helptext')),
            Checkbox::make('ercWhere')
                ->label(__('ams.ark_resource_import_ercwhere'))
                ->helperText(__('ams.ark_resource_import_ercwhere_helptext')),
        ];
    }

    /**
     * Define Example CSV
     * Example CSV which can be downloaded in the dialog.
     */
    public static function getColumns(): array
    {
        return [
            ImportColumn::make('ark')
                ->label('ARK')
                ->example('12345/abc1337')
                ->rules([new NaanInDatabase()]),
            ImportColumn::make('uri')
                ->label('URI')
                ->example('https://burgerbib.ch')
                ->requiredMapping()
                ->rules(['required', 'url']),
            ImportColumn::make('metadata')
                ->castStateUsing(function (string $originalState): ?string {
                    // Default cast removes ending \n\n from erc record.
                    return $originalState;
                })
                ->label('Metadata')
                ->example('[{"type":"erc","data":"erc:\nwho: Burgerbibliothek%spBern\nwhat: Burgerbibliothek%spBern\nwhere: https%cn%sl%slburgerbib.ch%sl\nwhen: 1951\n\n"}]'),
        ];
    }

    /**
     * Resolve Record.
     * https://filamentphp.com/docs/3.x/actions/prebuilt-actions/import#updating-existing-records-when-importing
     */
    public function resolveRecord(): ?ArkModel
    {

        /** Allocate new ARK if no ARK is provided by import. */
        if (empty($this->data['ark']) === true) {

            /** If the option for skipping existing URI is set, don't allocate new ARK. */
            if ($this->options['skipExistingUri'] === true) {

                $uri = ArkModel::select('ark')->firstWhere('uri', $this->data['uri']);

                if ($uri && (string)Ark::splitIntoComponents($uri->ark)['naan'] === (string)$this->options['naan']) {
                    throw new RowImportFailedException("Option to skip existing URIs has been set and URI already has at least one corresponding ARK: {$uri->ark}.");
                }
            }

            /** Get minter settings */
            $minterSettings = Naan::select('naan', 'minter_id')
                ->with('minter:id,length,xdigits,ncda')
                ->firstWhere('naan', $this->options['naan']);

            if ($minterSettings === null) {
                throw new RowImportFailedException('There is no minter associated with this NAAN.');
            }

            $this->options['shoulder'] = $this->options['shoulder'] ?? null;

            /** Allocate new ARK, retry three times */
            for ($i = 1; $i <= 3; $i++) {

                /** Allocate new ARK */
                $this->data['ark'] = Ark::generate(
                    naan: $minterSettings->naan,
                    xdigits: $minterSettings->minter->xdigits,
                    length: $minterSettings->minter->length,
                    shoulder: $this->options['shoulder'],
                    ncda: $minterSettings->minter->ncda
                );

                /** Check if allocated ARK does not already exist */
                if (ArkModel::select('ark')->firstWhere('ark', '=', $this->data['ark']) === null) {
                    break;
                } elseif ($i >= 3) {
                    throw new RowImportFailedException('Failed allocating new ARK.');
                }
            }
        }

        $arkComponents = Ark::splitIntoComponents($this->data['ark']);

        /** Update metadata */
        if(empty($this->data['metadata']) === false){

            if(Erc::isValidRecord($this->data['metadata']) === false){
                throw new RowImportFailedException('Provided ERC record is not valid.');
            }
            
            $currentMetadata = ArkModel::firstWhere('ark', $this->data['ark']);

            if(empty($currentMetadata->metadata) === false){
                $this->data['metadata'] = Erc::mergeRecords($currentMetadata->metadata, $this->data['metadata'], $this->options['metadataMergeStrategy']);
            }

        } else if ($this->options['emptyMetadataDelete'] === true) {
            unset($this->data['metadata']);
        }
        
        /** Add "where" story w/ ARK */
        if ($this->options['ercWhere'] === true) {
            $nma = Naan::firstWhere('naan', '=', $arkComponents['naan'])->nma;
            $erc = new Erc;
            $erc->load($this->data['metadata']);
            $erc->add('where', $nma . $arkComponents['baseCompactName']);
            $this->data['metadata'] = $erc->record();
        }

        /** Save to record matching with ark field or create a new one */
        return ArkModel::firstOrNew([
            'ark' => $this->data['ark'],
        ]);
    }

    /**
     * Save which ARKs have been touched by the import.
     */
    protected function beforeSave(): void
    {
        $currentData = ArkModel::firstWhere('ark', $this->data['ark']);
        if ($currentData) {
            $revisionData = ['uri' => $currentData->uri, 'metadata' => $currentData->metadata];
            $revision = new ArkRevision;
            $revision->ark_id = $currentData->id;
            $revision->revision = json_encode($revisionData);
            $revision->save();
        }
    }

    protected function afterSave(): void
    {
        $successfullRow = new SuccessfullImportRow;
        $successfullRow->import_id = $this->import['id'];
        $successfullRow->ark_id = $this->record['id'];
        $successfullRow->save();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your ARK import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
