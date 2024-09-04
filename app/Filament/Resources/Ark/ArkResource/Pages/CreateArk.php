<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use Burgerbibliothek\ArkManagementTools\Ark;
use Burgerbibliothek\ArkManagementTools\Erc;
use App\Models\Naan;
use App\Filament\Resources\Ark\ArkResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArk extends CreateRecord
{
    protected static string $resource = ArkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        /** Get minter settings of naan */
        $minterSettings = Naan::firstWhere('naan', $data['naan'])->minter;    
        
        /** Retrieve new ARK */
        $data['ark'] = Ark::generate($data['naan'], $minterSettings->xdigits, $minterSettings->length, $data['shoulder'], $minterSettings->ncda);

        /** Create ERC record */
        $erc = new Erc;
        $erc->addStory([$data['who'], $data['what'], $data['when'], $data['where']]);
        $data['metadata'] = $erc->record();
        unset($data['who'], $data['what'], $data['when'], $data['where'], $data['note'], $data['naan']);
        
        return $data;
    }
}
