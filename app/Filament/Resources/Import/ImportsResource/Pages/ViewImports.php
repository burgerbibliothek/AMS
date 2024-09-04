<?php

namespace App\Filament\Resources\Import\ImportsResource\Pages;

use App\Filament\Resources\Import\ImportsResource;
use App\Models\SuccessfullImportRow;
use Filament\Resources\Pages\ListRecords;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ViewImports extends ListRecords
{
    protected static string $resource = ImportsResource::class;
    
    public function infolist(Infolist $infolist): Infolist
    {
        $result = SuccessfullImportRow::find($this->record['id'])->import->get();
        dump($result);
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('file_name'),
                Infolists\Components\TextEntry::make('file_path'),
                Infolists\Components\TextEntry::make('total_rows'),
                Infolists\Components\TextEntry::make('successful_rows')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title'),
                TextColumn::make('slug'),
                IconColumn::make('is_featured')
                    ->boolean(),
            ]);
    }
}
