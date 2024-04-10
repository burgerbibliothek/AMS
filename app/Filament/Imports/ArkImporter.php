<?php

namespace App\Filament\Imports;

use App\Models\Ark;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\Models\Import;

class ArkImporter extends Importer
{
    protected static ?string $model = Ark::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('ark')
                ->requiredMapping()
                ->rules(['required', 'max:191']),
            ImportColumn::make('uri')
                ->requiredMapping()
                ->rules(['required', 'max:191']),
        ];
    }

    public function resolveRecord(): ?Ark
    {
        // return Ark::firstOrNew([
        //     // Update existing records, matching them by `$this->data['column_name']`
        //     'email' => $this->data['email'],
        // ]);

        return new Ark();
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your ark import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
