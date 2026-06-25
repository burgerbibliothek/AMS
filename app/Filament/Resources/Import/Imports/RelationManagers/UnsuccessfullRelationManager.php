<?php

namespace App\Filament\Resources\Import\Imports\RelationManagers;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ExportAction;
use App\Filament\Exports\UnsuccessfullImportExporter;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;


class UnsuccessfullRelationManager extends RelationManager
{
    
    protected static string $relationship = 'unsuccessfullImportRows';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('ams.import_resource_unsuccessfull_title');
    }
    
    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('data')
                    ->label(__('ams.import_resource_unsuccessfull_table_data'))
                    ->sortable(),
                TextColumn::make('validation_error')
                    ->label(__('ams.import_resource_unsuccessfull_table_error'))
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label(__('ams.import_resource_unsuccessfull_table_created_at'))
                    ->sortable(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(UnsuccessfullImportExporter::class)
                    ->label(__('ams.import_resource_export_list'))
            ]);
    }
}
