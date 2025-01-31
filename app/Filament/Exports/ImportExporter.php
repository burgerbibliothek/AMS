<?php

namespace App\Filament\Exports;

use App\Models\Naan;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;

class ImportExporter extends Exporter
{
    protected static ?string $model = Imports::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('ark')
                ->prefix(fn(array $options) => $options['nma'] ?? 'https://n2t.org/'),
            ExportColumn::make('uri'),
        ];
    }

    public static function getOptionsFormComponents(): array
    {
        return [
            Select::make('nma')
                ->label('Name Mapping Authority (Default: https://n2t.org/)')
                ->options(Naan::nmas()->pluck('nma', 'nma'))
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your import export has completed and '.number_format($export->successful_rows).' '.str('row')->plural($export->successful_rows).' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' '.number_format($failedRowsCount).' '.str('row')->plural($failedRowsCount).' failed to export.';
        }

        return $body;
    }
}
