<?php

namespace App\Filament\Resources\Settings\Apis\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Settings\Apis\ApiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListApis extends ListRecords
{
    protected static string $resource = ApiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
