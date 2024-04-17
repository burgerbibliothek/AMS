<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\Filament\Resources\Ark\ArkResource;
use App\Filament\Imports\ArkImporter;
use Filament\Actions;
use Filament\Actions\ImportAction;
use Filament\Resources\Pages\ListRecords;

class ListArks extends ListRecords
{
    protected static string $resource = ArkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label('CSV-Import')
                ->importer(ArkImporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
