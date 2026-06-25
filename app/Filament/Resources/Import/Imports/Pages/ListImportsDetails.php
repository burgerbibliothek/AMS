<?php

namespace App\Filament\Resources\Import\Imports\Pages;

use Filament\Actions\DeleteAction;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use App\Filament\Resources\Import\Imports\ImportsResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Enums\FontWeight;

class ListImportsDetails extends ViewRecord
{
    protected static string $resource = ImportsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make()
                ->label(__('ams.button_delete'))
                ->modalHeading(__('ams.import_resource_dialog_delete_heading'))
                ->modalDescription(__('ams.import_resource_dialog_delete_desc'))
                ->modalSubmitActionLabel(__('ams.import_resource_dialog_delete_submit')),
        ];
    }
    
    public function infolist(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make([
                Grid::make([
                    'default' => 4
                ])->schema([
                    TextEntry::make('total_rows')
                        ->weight(FontWeight::Bold),
                    TextEntry::make('successful_rows')
                        ->weight(FontWeight::Bold),
                    TextEntry::make('created_at')
                        ->dateTime('d.m.Y H:i:s')
                        ->weight(FontWeight::Bold),
                    TextEntry::make('completed_at')
                        ->dateTime('d.m.Y H:i:s')
                        ->weight(FontWeight::Bold),
                ]),
            ]),
        ]);
    }
}
