<?php

namespace App\Filament\Resources\Ark\Arks\Pages;

use App\Ams\Metadata;
use App\Filament\Resources\Ark\Arks\ArkResource;
use App\Models\Ark as ArkModel;
use App\Models\ArkRevision;
use App\Models\Status as StatusModel;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditArk extends EditRecord
{
    protected static string $resource = ArkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label(__('ams.button_delete'))
                ->modalHeading(__('ams.ark_resource_dialog_delete_heading'))
                ->modalDescription(__('ams.ark_resource_dialog_delete_desc'))
                ->modalSubmitActionLabel(__('ams.ark_resource_dialog_delete_submit')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->getRecord()]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        /** Parse metadata for form */
        if (empty($data['metadata']) === false) {
            $data['metadata'] = Metadata::deserialize($data['metadata']);
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {   
        /** Convert to ERC text format */
        $data['metadata'] = Metadata::serialize($data['metadata']);

        $ark = $this->record;
        $ark->fill($data);

        /** Save current as revision if change detected */
        if ($ark->isDirty(['uri', 'status_id', 'metadata']) === true) {
            ArkRevision::snapshot($ark);
        }

        return $data;
    }
}
