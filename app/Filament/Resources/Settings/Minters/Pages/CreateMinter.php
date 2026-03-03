<?php

namespace App\Filament\Resources\Settings\Minters\Pages;

use App\Filament\Resources\Settings\Minters\MinterResource;
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
