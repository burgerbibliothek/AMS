<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\AMS\Metadata;
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
        $erc = Metadata::parseKernelMetadata($data['metadata']);
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
        $data['metadata'] = 'erc:'.chr(0x0A);
        $data['metadata'] .= 'who:'.$data['who'].chr(0x0A);
        $data['metadata'] .= 'what:'.$data['what'].chr(0x0A);
        $data['metadata'] .= 'when:'.$data['when'].chr(0x0A);
        $data['metadata'] .= 'where:'.$data['where'].chr(0x0A);
        if($data['note']){
            $data['metadata'] .= 'note:'.$data['note'].chr(0x0A);
        }
        $data['metadata'] .= chr(0x0A);
        
        unset($data['who']);
        unset($data['what']);
        unset($data['when']);
        unset($data['where']);
        unset($data['note']);
                
        return $data;
    }
}
