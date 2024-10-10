<?php

namespace App\Filament\Resources\Settings\MetadataResource\Pages;

use App\Filament\Resources\Settings\MetadataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMetadata extends ListRecords
{
    protected static string $resource = MetadataResource::class;
    
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
