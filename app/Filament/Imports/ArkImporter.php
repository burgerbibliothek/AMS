<?php

namespace App\Filament\Imports;

use Burgerbibliothek\ArkManagementTools\Ark;
use App\Models\Ark as ArkModel;
use App\Models\Naan;
use App\Models\SuccessfullImportRow;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
use Filament\Actions\Imports\Exceptions\RowImportFailedException;
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
                ->required(),
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
            ImportColumn::make('who')
                ->label('Who'),
            ImportColumn::make('what')
                ->label('What'),
            ImportColumn::make('when')
                ->label('When'),
            ImportColumn::make('where')
                ->label('Where')
        ];
    }

    protected function beforeFill(): void
    {

        /**
         * Validate ARK to Import.
         * Check if ARK already exists.
         * If not existing, allocate new ARK.
         */
        if ($this->data['ark']) {

            /** Check if ARK from Import contains a NAAN which is in database */
            $ark = explode('/', $this->data['ark']);

            if (!Naan::firstWhere('naan', '=', $ark[0])) {
                throw new RowImportFailedException("NAAN not found in database.");
            }

        } else {

            /** Get minter settings of NAAN */
            $naan = $this->options['naan'];
            $minterSettings = Naan::firstWhere('naan', $naan)->minter;

            if (!$minterSettings) {
                throw new RowImportFailedException("There is no minter associated to this NAAN.");
            }

            /** Allocate new ARK */
            $this->data['ark'] = Ark::generate($naan, $minterSettings->xdigits, $minterSettings->length, null, $minterSettings->ncda);
            
            /** Check if allocated ARK not already existing */
            if (ArkModel::firstWhere('ark', '=', $this->data['ark'])) {
                throw new RowImportFailedException("Failed allocating new ARK.");
            }

        }
        
        /** Create ERC metadata record */
        /*
        $erc = new Erc([$this->data['who'], $this->data['what'], $this->data['what'], $this->data['when']]);
        $this->data['metadata'] = $erc->record();
        unset($this->data['who']);
        unset($this->data['when']);
        unset($this->data['what']);
        unset($this->data['where']);
        */
    }

    public function resolveRecord(): ?ArkModel
    {

        /**
         * Skip existing URI Option.
         * If the option is set, don't update or allocate new ARK.
         */
        if ($this->options['skipExistingUri'] ?? false) {

            /** Search for ARK with given URI and NAAN from options. */
            $uri = ArkModel::where([
                ['uri', '=', $this->data['uri']],
                ['ark', 'like', $this->options['naan'] . '%'],
            ])->first();

            if ($uri) {
                throw new RowImportFailedException("Option to skip existing URIs has been set and URI already has at least one corresponding ARK: {$uri->ark}.");
            }
        }
        
        return ArkModel::firstOrNew([
            'ark' => $this->data['ark'],
        ]);

        return new ArkModel();
    }

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
