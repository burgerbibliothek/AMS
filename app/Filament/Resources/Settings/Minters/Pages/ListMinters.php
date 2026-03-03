<?php

namespace App\Filament\Resources\Settings\Minters\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Settings\Minters\MinterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMinters extends ListRecords
{
    protected static string $resource = MinterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('ams.button_new', ['thing' => 'Minter'])),
        ];
    }
}
