<?php

namespace App\Filament\Resources\Settings\Statuses;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Settings\Statuses\Pages\ListStatuses;
use App\Filament\Resources\Settings\Statuses\Pages\CreateStatus;
use App\Filament\Resources\Settings\Statuses\Pages\EditStatus;
use App\Filament\Resources\Settings\StatusResource\Pages;
use App\Models\Status as StatusModel;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class StatusResource extends Resource
{
    protected static ?string $model = StatusModel::class;

    protected static ?string $slug = 'settings/http-status-codes';

    protected static ?string $navigationLabel = 'HTTP-Status-Codes';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cloud';

    protected static ?string $label = 'HTTP-Status-Code';

    public static function getNavigationGroup(): ?string
    {
        return __('ams.navigation_settings');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('ams.status_resource_section'))
                    ->schema([
                        TextInput::make('code')
                            ->label(__('ams.status_resource_code'))
                            ->helperText(__('ams.status_resource_code_help'))
                            ->rules(['Integer'])
                            ->in([400, 410, 451])
                            ->unique()
                            ->required(),
                        TextInput::make('message')
                            ->label(__('ams.status_resource_message'))
                            ->helperText(__('ams.status_resource_message_help'))
                            ->required(),
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->searchable()
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListStatuses::route('/'),
            'create' => CreateStatus::route('/create'),
            'edit' => EditStatus::route('/edit/{record}'),
        ];
    }
}
