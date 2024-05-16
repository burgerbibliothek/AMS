<?php

namespace App\Filament\Imports;

use App\AMS\Ark;
use App\AMS\Erc;
use App\Models\Ark as ArkModel;
use App\Models\Naan;
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
                ->options(Naan::all()->whereNotNull('minter_settings_id')->pluck('naan','naan'))
                ->required(),
            Checkbox::make('skipExistingUri')
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
                ->rules(['required','url']),
            ImportColumn::make('who')
                ->label('Who')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('what')
                ->label('What')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('when')
                ->label('When')
                ->requiredMapping()
                ->rules(['required']),
            ImportColumn::make('what')
                ->label('Where')
                ->requiredMapping()
                ->rules(['required']),
        ];
    }

    protected function beforeFill(): void
    {

        $erc = new Erc([$this->data['who'], $this->data['what'], $this->data['what'], $this->data['when']]);
        $this->data['metadata'] = $erc->record();

        unset($this->data['who']);
        unset($this->data['when']);
        unset($this->data['what']);
        unset($this->data['where']);

        // If ARK column is empty, generate new ARK.
        if(!$this->data['ark']){
            $ark = new Ark;
            $this->data['ark'] = $ark->generate($this->options['naan']);
        }

    }

    public function resolveRecord(): ?ArkModel
    {

        if ($this->options['skipExistingUri'] ?? false) {
            
            $uri = ArkModel::where([
                ['uri', '=', $this->data['uri']],
                ['ark', 'like', $this->options['naan'].'%'],
            ])->first();
            
            if($uri){
                throw new RowImportFailedException("Option to skip existing URIs has been set and URI already has at least one corresponding ARK: {$uri->ark}.");
            }
        }
        
        

        return ArkModel::firstOrNew([
            'ark' => $this->data['ark'],
        ]);

        return new ArkModel();
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
