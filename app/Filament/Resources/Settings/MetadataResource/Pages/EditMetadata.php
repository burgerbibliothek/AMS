<?php

namespace App\Filament\Resources\Settings\MetadataResource\Pages;

use App\Filament\Resources\Settings\MetadataResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMetadata extends EditRecord
{
    protected static string $resource = MetadataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
