<?php

namespace App\Filament\Resources\ArkResource\Pages;

use App\Filament\Resources\ArkResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArks extends ListRecords
{
    protected static string $resource = ArkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
