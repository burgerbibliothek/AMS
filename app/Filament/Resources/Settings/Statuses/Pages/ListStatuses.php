<?php

namespace App\Filament\Resources\Settings\Statuses\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Settings\Statuses\StatusResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStatuses extends ListRecords
{
    protected static string $resource = StatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
