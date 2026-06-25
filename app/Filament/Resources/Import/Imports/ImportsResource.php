<?php

namespace App\Filament\Resources\Import\Imports;


use App\Filament\Resources\Import\Imports\Pages\ListImports;
use App\Filament\Resources\Import\Imports\Pages\ListImportsDetails;
use App\Filament\Resources\Import\Imports\Pages\ViewFailedImportRows;
use App\Filament\Resources\Import\Imports\RelationManagers\ArksRelationManager;
use App\Filament\Resources\Import\Imports\RelationManagers\UnsuccessfullRelationManager;
use App\Models\Import;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Actions\DeleteBulkAction;
use Filament\Resources\Pages\Page;
use Filament\Pages\Enums\SubNavigationPosition;

class ImportsResource extends Resource
{
    protected static ?string $model = Import::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-arrow-right-end-on-rectangle';

    protected static ?string $slug = 'imports';

    protected static ?string $navigationLabel = 'Imports';

    public static function table(Table $table): Table
    {
        return $table
            ->toolbarActions([
                DeleteBulkAction::make(),
            ])
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

    public static function getWidgets(): array
    {
        return [
            FailedImportRows::class,
        ];
    }

    public static function getRelations(): array
    {
        return [
            ArksRelationManager::class,
            UnsuccessfullRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListImports::route('/'),
            'view' => ListImportsDetails::route('/view/{record}'),
            'view-failed' => ViewFailedImportRows::route('/failed/{record}')
        ];
    }



}
