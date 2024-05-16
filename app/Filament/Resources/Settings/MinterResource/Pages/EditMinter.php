<?php

namespace App\Filament\Resources\Settings\MinterResource\Pages;

use App\Filament\Resources\Settings\MinterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMinter extends EditRecord
{
    protected static string $resource = MinterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->modalHeading('Are you sure?')
                ->modalDescription('You won\'t be able to generate new ARKs for NAANs which have had this setting associated.')
                ->modalSubmitActionLabel('Yes, delete it'),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $xdigits = str_split($data['xdigits']);
        sort($xdigits);
        $xdigits = array_unique($xdigits);
        
        $data['xdigits'] = implode('', $xdigits);
                
        return $data;
    }
}
