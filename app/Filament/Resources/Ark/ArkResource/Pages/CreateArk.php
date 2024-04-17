<?php
namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\AMS\Ark;
use App\AMS\Metadata;
use App\Filament\Resources\Ark\ArkResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateArk extends CreateRecord
{
    protected static string $resource = ArkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['metadata'] = 'erc:'.chr(0x0A);
        $data['metadata'] .= "who: ".$data['who'].chr(0x0A);
        $data['metadata'] .= 'what:'.chr(0x20).$data['what'].chr(0x0A);
        $data['metadata'] .= 'when:'.chr(0x20).$data['when'].chr(0x0A);
        $data['metadata'] .= 'where:'.chr(0x20).$data['where'].chr(0x0A);
        if($data['note']){
            $data['metadata'] .= 'note:'.$data['note'].chr(0x0A);
        }
        $kernel = [$data['who'], $data['what'], $data['when'], $data['where']];
        Metadata::serizalizeKernelMetadata($kernel);

        $data['metadata'] .= chr(0x0A);
        
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
