<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\Ams\Metadata;
use App\Filament\Resources\Ark\ArkResource;
use App\Models\Ark as ArkModel;
use App\Models\Status as StatusModel;
use App\Models\ArkRevision;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArk extends EditRecord
{
    protected static string $resource = ArkResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
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
        /** Deserialize ERC Metadata */
        if ($data['metadata']) {
            $data['metadata'] = Metadata::deserialize($data['metadata']);
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['metadata'] = Metadata::serialize('erc', $data['metadata']);
        
        /** Save current data as revision. */
        $change = ArkModel::hasChanged($this->data['id'], [
            'ark' => $this->data['ark'], 
            'uri' => $this->data['uri'],
            'status_id' => $this->data['status_id'],
            'metadata' => $data['metadata']
        ]);
        
        if($change){

            $currentData = ArkModel::find($this->data['id']);

            /** Get status label */
            $currentStatus = null;
            if($currentData->status_id){
                $currentStatus = StatusModel::find($currentData->status_id)->label;
            }

            $revisionData = ['uri' => $currentData->uri, 'http-status' => $currentStatus, 'metadata' => $currentData->metadata];
            $revision = new ArkRevision;
            $revision->ark_id = $this->data['id'];
            $revision->revision = json_encode($revisionData);
            $revision->save();
        }

        return $data;
    }
}
