<?php

namespace App\Filament\Resources\Import;

use App\Filament\Resources\Import\ImportsResource\Pages;
use App\Filament\Resources\Import\ImportsResource\RelationManagers;
use App\Models\Import;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class ImportsResource extends Resource
{
    protected static ?string $model = Import::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-end-on-rectangle';
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
                    ->sortable()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ArksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListImports::route('/'),
            'view' => Pages\ListImportsDetails::route('/view/{record}'),
        ];
    }
}
