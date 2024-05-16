<?php

namespace App\Filament\Resources\Import\ImportsResource\Pages;

use App\Filament\Resources\Import\ImportsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImports extends ListRecords
{
    protected static string $resource = ImportsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
