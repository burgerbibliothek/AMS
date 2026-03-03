<?php

namespace App\Filament\Resources\Settings\Naans\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\Settings\Naans\NaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNaans extends ListRecords
{
    protected static string $resource = NaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label(__('ams.button_new', ['thing' => 'NAAN'])),
        ];
    }
}
