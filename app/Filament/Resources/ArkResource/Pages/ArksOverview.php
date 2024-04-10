<?php

namespace App\Filament\Resources\ArkResource\Pages;

use App\Filament\Resources\ArkResource;
use App\Filament\Resources\Settings\NaanResource;
use Filament\Resources\Pages\Page;
use App\Models\Naan;

class ArksOverview extends Page
{
    protected static ?string $title = 'Overview NAANs';
    protected static string $resource = ArkResource::class;
    protected static string $view = 'filament.resources.ark-resource.pages.arks-overview';
    /*
    protected function getHeaderWidgets(): array
    {
        return [
            NaanResource\Widgets\NaanOverview::class,
        ];
    }
    */
    


}
