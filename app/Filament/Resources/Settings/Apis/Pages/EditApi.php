<?php

namespace App\Filament\Resources\Settings\Apis\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Settings\Apis\ApiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditApi extends EditRecord
{
    protected static string $resource = ApiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
