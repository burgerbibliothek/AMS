<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\MinterResource\Pages;
use App\Filament\Resources\Settings\MinterResource\RelationManagers;
use App\Models\Minter as MinterModel;
use App\Rules\ArkCharacterRepetoire;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MinterResource extends Resource
{
    protected static ?string $model = MinterModel::class;
    protected static ?string $navigationIcon = 'heroicon-o-adjustments-horizontal';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Minter Settings';
    protected static ?string $label = 'Minter Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            TextInput::make('xdigits')
                ->label('Character Repetoire')
                ->helperText('Characters may be letters, digits, or any of these seven characters: =   ~   *   +   @   _   $')
                ->rules([new ArkCharacterRepetoire()])
                ->placeholder('0123456789bcdfghjkmnpqrstvwxz')
                ->required(),
            TextInput::make('length')
                ->label('Length')
                ->helperText('Length should not exceed the number of characters in order to calculate checkdigit.')
                ->numeric()
                ->inputMode('decimal')
                ->minValue(2)
                ->placeholder('2')
                ->required(),
            Checkbox::make('ncda')
                ->label('Add Noid Check Digit')
                ->helperText('NCDA (Noid Check Digit Algorithm) is an algorithm used to compute or validate NOID checksum char. It can be used to assert that an ID doesn\'t contains transcription error.')
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->label('Name')
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
            'index' => Pages\ListMinters::route('/'),
            'create' => Pages\CreateMinter::route('/create'),
            'edit' => Pages\EditMinter::route('/{record}/edit'),
        ];
    }
}
