<?php

namespace App\Filament\Resources\Settings\MinterResource\Pages;

use App\Filament\Resources\Settings\MinterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMinter extends CreateRecord
{
    protected static string $resource = MinterResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['xdigits'] = MinterResource::arkCharacterRepetoire($data['xdigits']);

        return $data;
    }
}
