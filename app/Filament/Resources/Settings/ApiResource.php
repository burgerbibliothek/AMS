<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\ApiResource\Pages;
use App\Models\Api;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ApiResource extends Resource
{
    protected static ?string $model = Api::class;

    protected static ?string $navigationIcon = 'heroicon-o-wifi';

    protected static ?string $slug = 'settings/api';

    protected static ?string $navigationLabel = 'API';

    protected static ?string $label = 'API';

    public static function getNavigationGroup(): ?string
    {
        return __('ams.navigation_settings');
    }

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
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListApis::route('/'),
            'create' => Pages\CreateApi::route('/create'),
            'edit' => Pages\EditApi::route('/{record}/edit'),
        ];
    }
}
