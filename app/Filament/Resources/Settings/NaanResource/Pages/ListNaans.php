<?php

namespace App\Filament\Resources\Settings\NaanResource\Pages;

use App\Filament\Resources\Settings\NaanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNaans extends ListRecords
{
    protected static string $resource = NaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label(__('ams.button_new', ['thing' => 'NAAN'])),
        ];
    }
}
