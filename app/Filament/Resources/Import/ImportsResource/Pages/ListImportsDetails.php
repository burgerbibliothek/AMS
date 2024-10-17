<?php

namespace App\Filament\Resources\Import\ImportsResource\Pages;

use App\Filament\Resources\Import\ImportsResource;
use App\Models\SuccessfullImportRow;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Pages\ListRecords;
use Filament\Infolists;
use Filament\Infolists\Infolist;

use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Split;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Infolists\Components\Grid;

class ListImportsDetails extends ViewRecord
{
    protected static string $resource = ImportsResource::class;
    
    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make([
                    Grid::make([
                        'default' => 1,
                        'sm' => 2,
                        'md' => 4,
                        'lg' => 4,
                        'xl' => 4,
                        '2xl' => 4,
                    ])->schema([
                        TextEntry::make('total_rows')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('successful_rows')
                            ->weight(FontWeight::Bold),
                        TextEntry::make('created_at')
                            ->dateTime('d.m.Y H:i:s')
                            ->weight(FontWeight::Bold),
                            TextEntry::make('completed_at')
                            ->dateTime('d.m.Y H:i:s')
                            ->weight(FontWeight::Bold),
                    ])
                ]),

                /*
                Infolists\Components\TextEntry::make('file_name'),
                Infolists\Components\TextEntry::make('file_path'),
                Infolists\Components\TextEntry::make('total_rows'),
                Infolists\Components\TextEntry::make('successful_rows')
                    ->columnSpanFull(),
                    */
            ]);
    }
    

}
