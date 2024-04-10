<?php

namespace App\Filament\Resources\Settings\MinterResource\Pages;

use App\Filament\Resources\Settings\MinterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMinter extends EditRecord
{
    protected static string $resource = MinterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
