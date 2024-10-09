<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use Burgerbibliothek\ArkManagementTools\Ark;
use App\Ams\Metadata;
use App\Models\Naan;
use App\Filament\Resources\Ark\ArkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArk extends CreateRecord
{
    protected static string $resource = ArkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        /** Get minter settings of NAAN */
        $minterSettings = Naan::firstWhere('naan', $data['naan'])->minter;

        if(empty($data['shoulder'])){
            $data['shoulder'] = null;
        }

        /** Retrieve new ARK */
        $data['ark'] = Ark::generate($data['naan'], $minterSettings->xdigits, $minterSettings->length, $data['shoulder'], $minterSettings->ncda);
        
        /** Create ERC record */
        $data['metadata'] = Metadata::serialize('erc', $data['metadata']);
        
        return $data;
    }
}
