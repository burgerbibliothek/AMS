<?php
namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\AMS\ARK;
use App\Filament\Resources\Ark\ArkResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateArk extends CreateRecord
{
    protected static string $resource = ArkResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        
        $ark = new ARK;
        $data['ark'] = $ark->generate($data['naan']);
        unset($data['naan']);
        
        return static::getModel()::create($data);
    }


}
