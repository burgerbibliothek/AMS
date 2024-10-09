<?php

namespace App\Filament\Imports;

use App\Ams\Metadata;
use Burgerbibliothek\ArkManagementTools\Ark;
use Burgerbibliothek\ArkManagementTools\Erc;
use App\Models\Ark as ArkModel;
use App\Models\Naan;
use App\Models\SuccessfullImportRow;
use App\Models\ArkRevision;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;
use Filament\Forms\Get;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;


class ArkImporter extends Importer
{
    protected static ?string $model = ArkModel::class;

    /**
     * Import Dialog
     * Form for the import dialog.
     * @return array
     */
    public static function getOptionsFormComponents(): array
    {
        return [
            Select::make('naan')
                ->label(__('ams.ark_resource_import_naan'))
                ->helperText(__('ams.ark_resource_import_naan_helptext'))
                ->options(Naan::all()->whereNotNull('minter_settings_id')->pluck('naan', 'naan'))
                ->required()
                ->live(),
            Select::make('shoulder')
                ->label(__('ams.ark_resource_import_shoulder'))
                ->helperText(__('ams.ark_resource_import_shoulder_helptext'))
                ->placeholder('−')
                ->options(fn(Get $get): array => Naan::shoulders($get('naan')))
                ->visible(fn(Get $get): bool => Naan::hasShoulder($get('naan')))
                ->live(),
            Checkbox::make('skipExistingUri')
                ->default('true')
                ->label(__('ams.ark_resource_import_skip'))
                ->helperText(__('ams.ark_resource_import_skip_hint')),
            Checkbox::make('emptyMetadataDelete')
                ->label(__('ams.ark_resource_import_emptydatadelete'))
                ->helperText(__('ams.ark_resource_import_emptydatadelete_helptext')),
        ];
    }

    /**
     * Define Example CSV
     * Example CSV which can be downloaded in the dialog.
     * @return array
     */
    public static function getColumns(): array
    {
        return [
            ImportColumn::make('ark')
                ->label('ARK')
                ->example('12345/abc1337'),
            ImportColumn::make('uri')
                ->label('URI')
                ->example('https://burgerbib.ch')
                ->requiredMapping()
                ->rules(['required', 'url']),
            ImportColumn::make('metadata')
                ->label('Metadata')
                ->example('[{"type":"erc","data":"erc:\nwho: Burgerbibliothek%spBern\nwhat: Burgerbibliothek%spBern\nwhere: https%cn%sl%slburgerbib.ch%sl\nwhen: 1951\n\n"}]')
        ];
    }

    /**
     * Resolve Record.
     * https://filamentphp.com/docs/3.x/actions/prebuilt-actions/import#updating-existing-records-when-importing
     */
    public function resolveRecord(): ?ArkModel
    {
        
        /**
         * Option: Skip existing URI.
         * If the option is set, don't update or allocate new ARK.
         */
        if ($this->options['skipExistingUri'] ?? false) {

            /** Search for ARK with given URI and NAAN from options. */
            $uri = ArkModel::where([
                ['uri', '=', $this->data['uri']],
                ['ark', 'LIKE', $this->options['naan'] . '/' . '%'],
            ])->first();

            if ($uri) {
                throw new RowImportFailedException("Option to skip existing URIs has been set and URI already has at least one corresponding ARK: {$uri->ark}.");
            }
        }

        /** Validate and preprocess metadata */
        if (!empty($this->data['metadata'])) {

            $json = json_decode($this->data['metadata'], 1);
            $check = null;

            if ($json) {

                foreach ($json as $j) {
                    if ($j['type'] == 'erc' && Erc::isValidRecord($j['data'])) {
                        
                        $check = true;

                        $erc = new Erc;
                        $erc->record = Erc::parseKernelMetadata($j['data']);
                        
                        $this->data['metadata'] = [];

                        foreach ($erc->record as $label => $value) {
                            if(in_array($label, ['who', 'what', 'when', 'where', 'how', 'why', 'huh', 'erc', 'about-erc', 'about-who', 'about-what', 'about-when', 'about-where', 'about-how', 'support-erc', 'support-who', 'support-what', 'support-when', 'support-where', 'meta-erc', 'meta-who', 'meta-what', 'meta-when', 'meta-where', 'depositor-erc', 'depositor-who', 'depositor-what', 'depositor-when', 'depositor-where', 'title', 'creator', 'subject', 'description', 'publisher', 'contributor', 'date', 'type', 'format', 'identifier', 'source', 'language', 'relation', 'coverage', 'rights', 'note', 'in'])){
                                $this->data['metadata'][] = ['label' => $label, 'value' => $value];
                            }
                        }

                        $this->data['metadata'] = Metadata::serialize('erc', $this->data['metadata']);
                        break;
                    }
                }

                if (!$check) {
                    throw new RowImportFailedException("Metadata: No valid ERC record found.");
                }

            } else {
                throw new RowImportFailedException("Metadata: JSON could not be decoded.");
            }
        }

        /**
         * Use empty metadata entries to delete or not
         */
        if (!$this->options['emptyMetadataDelete'] && empty($this->data['metadata'])) {
            unset($this->data['metadata']);
        }

        /**
         * Validate or allocate ARK.
         * Check if ARK already exists, if not, allocate new ARK.
         */
        if (!empty($this->data['ark'])) {

            /** Check if ARK from Import contains a NAAN which is in database */
            $ark = explode('/', $this->data['ark']);

            if (!Naan::firstWhere('naan', '=', $ark[0])) {
                throw new RowImportFailedException("NAAN not found in database.");
            }

        } else {

            /** Get minter settings */
            $minterSettings = Naan::firstWhere('naan', $this->options['naan'])->minter;

            if (!$minterSettings) {
                throw new RowImportFailedException("There is no minter associated with this NAAN.");
            }

            if(empty($this->options['shoulder'])){
                $this->options['shoulder'] = null;
            }

            /** Allocate new ARK */
            $this->data['ark'] = Ark::generate($this->options['naan'], $minterSettings->xdigits, $minterSettings->length, $this->options['shoulder'], $minterSettings->ncda);

            /** Check if allocated ARK not already existing */
            if (ArkModel::firstWhere('ark', '=', $this->data['ark'])) {
                throw new RowImportFailedException("Failed allocating new ARK.");
            }
        }

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
        $successfullRow = new SuccessfullImportRow();
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
