<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\Filament\Resources\Ark\ArkResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArk extends EditRecord
{
    protected static string $resource = ArkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
