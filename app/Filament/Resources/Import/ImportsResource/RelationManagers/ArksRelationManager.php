<?php

namespace App\Filament\Resources\Import\ImportsResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ArksRelationManager extends RelationManager
{
    protected static string $relationship = 'mintedArks';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ark')
            ->columns([
                Tables\Columns\TextColumn::make('ark'),
                Tables\Columns\TextColumn::make('uri'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
