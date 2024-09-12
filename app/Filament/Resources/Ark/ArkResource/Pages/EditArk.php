<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use Burgerbibliothek\ArkManagementTools\Erc;
use App\Filament\Resources\Ark\ArkResource;
use App\Models\Ark as ArkModel;
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

    protected function mutateFormDataBeforeFill(array $data): array
    {        
        /** Deserialize ERC Metadata */
        if($data['metadata']){
            $data = array_merge($data, ArkResource::desirializeMetadata($data['metadata']));
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        /** Save current data as revision. */
        $currentData = ArkModel::find($this->data['id']);
        $revisionData = ['uri' => $currentData->uri, 'metadata' => $currentData->metadata];
        $revision = new ArkRevision;
        $revision->ark_id = $this->data['id'];
        $revision->revision = json_encode($revisionData);
        $revision->save();

        if($data['who'] || $data['what'] || $data['when'] || $data['where']){
            $erc = new Erc();
            $erc->addStory([$data['who'], $data['what'], $data['when'], $data['where']]);
            $data['metadata'] = $erc->record();
            unset($data['who'], $data['what'], $data['when'], $data['where']);
        }
                
        return $data;
    }
}
