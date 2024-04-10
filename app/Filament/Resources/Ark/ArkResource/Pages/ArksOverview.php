<?php

namespace App\Filament\Resources\Ark\ArkResource\Pages;

use App\Filament\Resources\Ark\ArkResource;
use App\Filament\Resources\Settings\NaanResource;
use Filament\Resources\Pages\Page;
use App\Models\Naan;
use Filament\Actions\Action;

class ArksOverview extends Page
{
    protected static ?string $title = 'Overview NAANs';
    protected static string $resource = ArkResource::class;
    protected static string $view = 'filament.resources.ark-resource.pages.arks-overview';
    
    
    


}
