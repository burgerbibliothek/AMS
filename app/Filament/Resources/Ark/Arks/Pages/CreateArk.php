<?php

namespace App\Filament\Resources\Ark\Arks\Pages;

use App\Ams\Metadata;
use App\Filament\Resources\Ark\Arks\ArkResource;
use App\Models\Naan;
use Burgerbibliothek\ArkManagementTools\Ark;
use Filament\Resources\Pages\CreateRecord;

class CreateArk extends CreateRecord
{
    protected static string $resource = ArkResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        
        /** Get minter settings of NAAN */
        $minterSettings = Naan::firstWhere('naan', $data['naan'])->minter;

        /** Retrieve new ARK */
        $data['ark'] = Ark::generate(
            naan: $data['naan'], 
            xdigits: $minterSettings->xdigits, 
            length: $minterSettings->length, 
            shoulder: $data['shoulder'] ?? null,
            ncda: $minterSettings->ncda
        );

        /** Create ERC record */
        $data['metadata'] = Metadata::serialize($data['metadata']);

        return $data;
    }
}
