<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\Filament\Imports\ArkImporter;
use App\Filament\Resources\Ark\ArkResource;
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
                ->modalHeading(__('ams.ark_resource_import_modalheading'))
                ->modalSubmitActionLabel(__('ams.ark_resource_import_submitactionlabel'))
                ->importer(ArkImporter::class),
            Actions\CreateAction::make()
                ->label(__('ams.ark_resource_actions_create')),
        ];
    }
}
