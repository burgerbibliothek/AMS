<?php

namespace App\Filament\Resources\Import\ImportsResource\Pages;

use App\Filament\Resources\Import\ImportsResource;
use App\Models\SuccessfullImportRow;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class ListImportsDetails extends ViewRecord
{
    protected static string $resource = ImportsResource::class;
    
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('file_name'),
                Infolists\Components\TextEntry::make('file_path'),
                Infolists\Components\TextEntry::make('total_rows'),
                Infolists\Components\TextEntry::make('successful_rows')
                    ->columnSpanFull(),
            ]);
    }

}
