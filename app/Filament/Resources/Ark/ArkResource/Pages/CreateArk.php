<?php
namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\AMS\Ark;
use App\AMS\Erc;
use App\Filament\Resources\Ark\ArkResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateArk extends CreateRecord
{
    protected static string $resource = ArkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $erc = new Erc([$data['who'], $data['what'], $data['when'], $data['where']]);
        
        $data['metadata'] = $erc->record();
        $data['ark'] = Ark::generate($data['naan']);

        unset($data['who']);
        unset($data['what']);
        unset($data['when']);
        unset($data['where']);
        unset($data['note']);
        unset($data['naan']);

        return $data;
    }

}
