<?php

namespace App\Filament\Resources\Import\Imports\Pages;

use Filament\Schemas\Schema;
use Filament\Infolists;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\Import\Imports\ImportsResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ViewImports extends ListRecords
{
    protected static string $resource = ImportsResource::class;

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('file_name'),
                TextEntry::make('file_path'),
                TextEntry::make('total_rows'),
                TextEntry::make('successful_rows')
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
