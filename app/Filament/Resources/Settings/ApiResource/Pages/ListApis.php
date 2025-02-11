<?php

namespace App\Filament\Resources\Settings\ApiResource\Pages;

use App\Filament\Resources\Settings\ApiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApis extends ListRecords
{
    protected static string $resource = ApiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
