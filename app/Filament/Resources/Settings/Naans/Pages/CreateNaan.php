<?php

namespace App\Filament\Resources\Settings\Naans\Pages;

use App\Filament\Resources\Settings\Naans\NaanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNaan extends CreateRecord
{
    protected static string $resource = NaanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {

        $data['shoulders'] = $data['shoulders'] ? $data['shoulders'] : null;

        /** Add trailing slash to nma */
        $data['nma'] = rtrim($data['nma'], '/').'/';

        return $data;
    }
}
