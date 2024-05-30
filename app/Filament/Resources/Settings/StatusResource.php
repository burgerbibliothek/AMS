<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\StatusResource\Pages;
use App\Filament\Resources\Settings\StatusResource\RelationManagers;
use App\Models\Status as StatusModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusResource extends Resource
{
    protected static ?string $model = StatusModel::class;
    protected static ?string $slug = 'settings/http-status-codes';
    protected static ?string $navigationLabel = 'HTTP-Status-Codes';
    protected static ?string $navigationIcon = 'heroicon-o-cloud';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $label = 'HTTP-Status-Code';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('ams.status_resource_section'))
                    ->schema([
                        TextInput::make('code')
                            ->label(__('ams.status_resource_code'))
                            ->helperText(__('ams.status_resource_code_help'))
                            ->rules(['Integer','min:100','max:599'])
                            ->unique()
                            ->required(),
                        TextInput::make('message')
                            ->label(__('ams.status_resource_message'))
                            ->helperText(__('ams.status_resource_message_help'))
                            ->required(),
                    ])
                ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->searchable()
                    ->sortable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListStatuses::route('/'),
            'create' => Pages\CreateStatus::route('/create'),
            'edit' => Pages\EditStatus::route('/edit/{record}'),
        ];
    }
}
