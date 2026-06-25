<?php

namespace App\Filament\Exports;

use App\Models\FailedImportRow;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class UnsuccessfullImportExporter extends Exporter
{
    protected static ?string $model = FailedImportRow::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('data'),
            ExportColumn::make('validation_error'),
            ExportColumn::make('created_at'),
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
