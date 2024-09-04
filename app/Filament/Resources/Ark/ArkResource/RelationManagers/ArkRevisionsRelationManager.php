<?php

namespace App\Filament\Resources\Import\ImportsResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;


class ArkRevisionsRelationManager extends RelationManager
{
    protected static string $relationship = 'ark_revisions';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('revision')
                    ->html()
                    ->label('Revision'),
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label('Modification Date')
            ]);
    }
}
