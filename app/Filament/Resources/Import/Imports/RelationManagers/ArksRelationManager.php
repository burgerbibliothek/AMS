<?php

namespace App\Filament\Resources\Import\Imports\RelationManagers;

use Filament\Tables\Columns\TextColumn;
use Filament\Actions\ExportAction;
use App\Filament\Exports\ImportExporter;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;


class ArksRelationManager extends RelationManager
{
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('ams.import_resource_successfull_title');
    }

    protected static string $relationship = 'successfullImportRows';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('ark')
                    ->label('ARK')
                    ->url(fn ($record): string => route('filament.admin.resources.arks.edit', ['record' => $record]))
                    ->searchable(),
                TextColumn::make('uri')
                    ->label('URI')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->sortable(),
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(ImportExporter::class)
                    ->label(__('ams.import_resource_export_list'))
            ]);
    }
}
