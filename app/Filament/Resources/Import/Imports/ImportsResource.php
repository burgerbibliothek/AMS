<?php

namespace App\Filament\Resources\Import\Imports;

use App\Filament\Resources\Import\Imports\RelationManagers\ArksRelationManager;
use App\Filament\Resources\Import\Imports\Pages\ListImports;
use App\Filament\Resources\Import\Imports\Pages\ListImportsDetails;
use App\Filament\Resources\Import\ImportsResource\Pages;
use App\Filament\Resources\Import\ImportsResource\RelationManagers;
use App\Models\Import;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImportsResource extends Resource
{
    protected static ?string $model = Import::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-arrow-right-end-on-rectangle';

    protected static ?string $slug = 'imports';

    protected static ?string $navigationLabel = 'Imports';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('file_name')
                    ->sortable(),
                TextColumn::make('total_rows'),
                TextColumn::make('successful_rows'),
                TextColumn::make('created_at')
                    ->since()
                    ->sortable(),
            ])
            ->defaultSort('created_at', direction: 'desc');
    }

    public static function getRelations(): array
    {
        return [
            ArksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListImports::route('/'),
            'view' => ListImportsDetails::route('/view/{record}'),
        ];
    }
}
