<?php

namespace App\Filament\Resources\Settings\Minters\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\Settings\Minters\MinterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMinter extends EditRecord
{
    protected static string $resource = MinterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label(__('ams.button_delete'))
                ->modalHeading(__('ams.minter_resource_dialog_delete_heading'))
                ->modalDescription(__('ams.minter_resource_dialog_delete_desc'))
                ->modalSubmitActionLabel(__('ams.minter_resource_dialog_delete_submit')),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['xdigits'] = MinterResource::arkCharacterRepetoire($data['xdigits']);

        return $data;
    }
}
