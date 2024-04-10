<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\StatusResource\Pages;
use App\Filament\Resources\Settings\StatusResource\RelationManagers;
use App\Models\Status as StatusModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatusResource extends Resource
{
    protected static ?string $model = StatusModel::class;
    protected static ?string $slug = 'status';
    protected static ?string $navigationLabel = 'HTTP-Status-Codes';
    protected static ?string $navigationIcon = 'heroicon-o-cloud';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $label = 'HTTP-Status-Code';
    // protected static ?string $navigationGroup  = 'Custom Page Title';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->unique()
                    ->required()
                    ->rules(['integer'])
                    ->label('Code'),
                Forms\Components\TextInput::make('message')
                    ->required()
                    ->label('Message'),
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
            'edit' => Pages\EditStatus::route('/{record}/edit'),
        ];
    }
}
