<?php

namespace App\Filament\Resources\Import;

use App\Filament\Resources\Import\ImportsResource\Pages;
use App\Filament\Resources\Import\ImportsResource\RelationManagers;
use App\Models\Imports;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ImportsResource extends Resource
{
    protected static ?string $model = Imports::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-right-end-on-rectangle';
    protected static ?string $slug = 'imports';
    protected static ?string $navigationLabel = 'Imports';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('file_name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_rows'),
                Tables\Columns\TextColumn::make('successful_rows'),
                Tables\Columns\TextColumn::make('created_at')
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
            'edit' => Pages\ListImportsDetails::route('/import/{record}'),
        ];
    }
}
