<?php

namespace App\Filament\Resources\Ark\ArkResource\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class ArkRevisionsRelationManager extends RelationManager
{
    protected static string $relationship = 'ark_revisions';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label('Modification Date'),
                Tables\Columns\TextColumn::make('revision')
                    ->html()
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->label('Revision'),
            ]);
    }
}
