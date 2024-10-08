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
            ->heading(__('ams.ark_resource_revision_title'))
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->sortable()
                    ->label(__('ams.ark_resource_revision_moddate')),
                Tables\Columns\TextColumn::make('revision')
                    ->html()
                    ->size(TextColumn\TextColumnSize::ExtraSmall)
                    ->label(__('ams.ark_resource_revision_data')),
            ]);
    }
}
