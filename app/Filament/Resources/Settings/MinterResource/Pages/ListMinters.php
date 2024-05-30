<?php

namespace App\Filament\Resources\Settings\MinterResource\Pages;

use App\Filament\Resources\Settings\MinterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMinters extends ListRecords
{
    protected static string $resource = MinterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('ams.button_new', ['thing' => 'Minter'])),
        ];
    }
}
