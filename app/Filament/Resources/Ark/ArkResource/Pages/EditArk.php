<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\AMS\Anvl;
use App\AMS\Erc;
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

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $erc = Erc::parseKernelMetadata($data['metadata']);
        $data['who'] = $erc['who'];
        $data['what'] = $erc['what'];
        $data['when'] = $erc['when'];
        $data['where'] = $erc['where'];
        if(key_exists('note', $erc)){
            $data['note'] = $erc['note'];
        }
        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $erc = new Erc([$data['who'], $data['what'], $data['when'], $data['where']]);
        $data['metadata'] = $erc->record();
        
        unset($data['who']);
        unset($data['what']);
        unset($data['when']);
        unset($data['where']);
        unset($data['note']);
                
        return $data;
    }
}
