<?php

namespace App\Filament\Resources\Settings\Statuses\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Settings\Statuses\StatusResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditStatus extends EditRecord
{
    protected static string $resource = StatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
