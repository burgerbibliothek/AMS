<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\MinterResource\Pages;
use App\Filament\Resources\Settings\MinterResource\RelationManagers;
use App\Models\Minter as MinterModel;
use Filament\Forms;
use Filament\Forms\Form;
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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('xdigits')
                ->sortable(),
                Tables\Columns\TextColumn::make('length')
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
