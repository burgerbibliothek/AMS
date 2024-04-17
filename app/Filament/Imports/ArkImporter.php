<?php

namespace App\Filament\Imports;

use App\AMS\ARK;
use App\Models\Ark as ArkModel;
use App\Models\Naan;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;
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
            ->options(Naan::all()->pluck('naan','naan'))
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
                ->rules(['required']),
        ];
    }

    protected function beforeFill(): void
    {

        if()
        // If ARK column is empty, generate new ARK.
        if(!$this->data['ark']){
            $ark = new Ark;
            $this->data['ark'] = $ark->generate($this->options['naan']);
        }

        
    }

    public function resolveRecord(): ?ArkModel
    {
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
