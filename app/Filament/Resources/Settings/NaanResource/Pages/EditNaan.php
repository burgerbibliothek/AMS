<?php

namespace App\Filament\Resources\Settings\NaanResource\Pages;

use App\Filament\Resources\Settings\NaanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNaan extends EditRecord
{
    protected static string $resource = NaanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
