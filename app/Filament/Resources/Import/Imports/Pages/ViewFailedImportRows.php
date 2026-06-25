<?php

namespace App\Filament\Resources\Import\Imports\Pages;

use App\Filament\Resources\Import\Imports\ImportsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewFailedImportRows extends ViewRecord
{
    protected static string $resource = ImportsResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => FailedImportRow::query())
            ->columns([
                TextColumn::make('import_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    //
                ]),
            ]);
    }

}
