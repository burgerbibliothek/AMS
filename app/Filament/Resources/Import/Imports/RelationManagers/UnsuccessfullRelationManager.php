<?php

namespace App\Filament\Resources\Import\Imports\RelationManagers;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ExportAction;
use App\Filament\Exports\UnsuccessfullImportExporter;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;


class UnsuccessfullRelationManager extends RelationManager
{
    protected static ?string $title = 'Unsuccessfull Rows';

    protected static string $relationship = 'unsuccessfullImportRows';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('data')
                    ->label('Data')
                    ->sortable(),
                TextColumn::make('validation_error')
                    ->label('Error Message')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->sortable(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(UnsuccessfullImportExporter::class)
                    ->label(__('ams.import_resource_export_list'))
            ]);
    }
}
