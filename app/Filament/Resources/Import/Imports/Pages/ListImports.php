<?php

namespace App\Filament\Resources\Import\Imports\Pages;

use App\Filament\Resources\Import\Imports\ImportsResource;
use Filament\Resources\Pages\ListRecords;

class ListImports extends ListRecords
{
    protected static string $resource = ImportsResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
