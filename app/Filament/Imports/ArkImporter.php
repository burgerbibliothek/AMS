<?php

namespace App\Filament\Imports;

use Burgerbibliothek\ArkManagementTools\Ark;
use Burgerbibliothek\ArkManagementTools\Erc;
use App\Models\Ark as ArkModel;
use App\Models\Naan;
use App\Models\SuccessfullImportRow;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;
use Filament\Forms\Get;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;

class ArkImporter extends Importer
{
    protected static ?string $model = Ark::class;

    public static function getOptionsFormComponents(): array
    {
        return [
            Select::make('naan')
                ->label('NAAN')
                ->options(Naan::all()->whereNotNull('minter_settings_id')->pluck('naan', 'naan'))
                ->required()
                ->live(),
            Select::make('shoulder')
                ->label('Shoulder')
                ->options(function (Get $get): array {
                    // Get shoulders of NAAN
                    $options = [];
                    if ($get('naan')) {
                        $shoulders = Naan::where('naan', $get('naan'))->pluck('shoulders')->flatten(1);
                        if ($shoulders && !is_null($shoulders[0])) {
                            foreach ($shoulders as $shoulder) {
                                $options[$shoulder['shoulder']] = $shoulder['shoulder'] . ' (' . $shoulder['description'] . ')';
                            }
                        }
                    }
                    return $options;
                }),
            Checkbox::make('skipExistingUri')
                ->default('true')
                ->label('Bestehende URI überspringen'),
        ];
    }

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('ark')
                ->label('ARK'),
            ImportColumn::make('uri')
                ->label('URI')
                ->requiredMapping()
                ->rules(['required', 'url']),
            ImportColumn::make('metadata')
                ->label('Metadata')
        ];
    }

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

        return new ArkModel();
    }

    /** TODO implement Revision when importing */

    /**
     * Save which ARKs have been touched by the import.
     */
    protected function afterSave(): void
    {
        // Runs after a record is saved to the database.
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
