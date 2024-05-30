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
    protected static ?string $title = 'Archival Resource Keys (ARKs)';

    protected function getHeaderActions(): array
    {
        return [
            ImportAction::make()
                ->label(__('ams.ark_resource_actions_import'))
                ->importer(ArkImporter::class),
            Actions\CreateAction::make()
                ->label(__('ams.ark_resource_actions_create')),
        ];
    }
}
