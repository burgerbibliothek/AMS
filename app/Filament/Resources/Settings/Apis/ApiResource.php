<?php

namespace App\Filament\Resources\Settings\Apis;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Settings\Apis\Pages\ListApis;
use App\Filament\Resources\Settings\Apis\Pages\CreateApi;
use App\Filament\Resources\Settings\Apis\Pages\EditApi;
use App\Filament\Resources\Settings\ApiResource\Pages;
use App\Models\Api;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ApiResource extends Resource
{
    protected static ?string $model = Api::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-wifi';

    protected static ?string $slug = 'settings/api';

    protected static ?string $navigationLabel = 'API';

    protected static ?string $label = 'API';

    public static function getNavigationGroup(): ?string
    {
        return __('ams.navigation_settings');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            'index' => ListApis::route('/'),
            'create' => CreateApi::route('/create'),
            'edit' => EditApi::route('/{record}/edit'),
        ];
    }
}
