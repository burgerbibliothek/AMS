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
            Actions\DeleteAction::make()
                ->label(__('ams.button_delete'))
                ->modalHeading(__('ams.naan_resource_dialog_delete_heading'))
                ->modalDescription(__('ams.naan_resource_dialog_delete_desc'))
                ->modalSubmitActionLabel(__('ams.naan_resource_dialog_delete_submit')),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        /** Add trailing slash to nma */
        $data['nma'] = rtrim($data['nma'],"/").'/';
        return $data;
    }
}
