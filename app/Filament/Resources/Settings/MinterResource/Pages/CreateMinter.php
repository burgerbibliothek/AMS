<?php

namespace App\Filament\Resources\Settings\MinterResource\Pages;

use App\Filament\Resources\Settings\MinterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMinter extends CreateRecord
{
    protected static string $resource = MinterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $xdigits = str_split($data['xdigits']);
        sort($xdigits);
        $xdigits = array_unique($xdigits);
        
        $data['xdigits'] = implode('', $xdigits);
                
        return $data;
    }
}
