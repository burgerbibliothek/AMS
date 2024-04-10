<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\Filament\Imports\ArkImporter;
use App\Filament\Resources\Ark\ArkResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageArks extends ManageRecords
{
    protected static string $resource = ArkResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ImportAction::make()
                ->importer(ArkImporter::class),
            Actions\CreateAction::make(),
        ];
    }
}