<?php

namespace App\Filament\Resources\Import\ImportsResource\Pages;

use App\Filament\Resources\Import\ImportsResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ViewImports extends ViewRecord
{
    protected static string $resource = ImportsResource::class;

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('file_name'),
                Infolists\Components\TextEntry::make('total_rows'),
                Infolists\Components\TextEntry::make('successful_rows')
                    ->columnSpanFull(),
            ]);
    }

}
