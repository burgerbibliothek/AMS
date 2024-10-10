<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\MetadataResource\Pages;
use App\Filament\Resources\Settings\MetadataResource\RelationManagers;
use App\Models\Metadata;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Tabs;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MetadataResource extends Resource
{
    protected static ?string $model = Metadata::class;
    protected static ?string $slug = 'settings/metadata';
    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Metadata';
    protected static ?string $label = 'Metadata';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
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
            'index' => Pages\ListMetadata::route('/'),
            'create' => Pages\CreateMetadata::route('/create'),
            'edit' => Pages\EditMetadata::route('/{record}/edit'),
        ];
    }
}
