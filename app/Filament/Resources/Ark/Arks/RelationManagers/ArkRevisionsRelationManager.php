<?php

namespace App\Filament\Resources\Ark\Arks\RelationManagers;

use Filament\Support\Enums\TextSize;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArkRevisionsRelationManager extends RelationManager
{
    protected static string $relationship = 'ark_revisions';

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('ams.ark_resource_revision_title'))
            ->columns([
                TextColumn::make('created_at')
                    ->sortable()
                    ->label(__('ams.ark_resource_revision_moddate')),
                TextColumn::make('revision')
                    ->html()
                    ->size(TextSize::ExtraSmall)
                    ->label(__('ams.ark_resource_revision_data')),
            ]);
    }
}
