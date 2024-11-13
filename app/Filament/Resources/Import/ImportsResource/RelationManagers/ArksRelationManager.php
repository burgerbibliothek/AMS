<?php

namespace App\Filament\Resources\Import\ImportsResource\RelationManagers;

use App\Filament\Exports\ImportExporter;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ExportAction;
use Filament\Tables\Actions\ExportBulkAction;

class ArksRelationManager extends RelationManager
{
    protected static ?string $title = 'Imported / Minted ARKs';
    protected static string $relationship = 'successfullImportRows';

    public function table(Table $table): Table
    {
                
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ark')
                    ->label('ARK')
                    ->searchable(),
                Tables\Columns\TextColumn::make('uri')
                    ->label('URI')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(ImportExporter::class)
                    ->label('Export List')
            ]);
    }
}
