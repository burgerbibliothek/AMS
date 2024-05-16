<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\NaanResource\Pages;
use App\Filament\Resources\Settings\NaanResource\RelationManagers;
use App\Models\Naan as NaanModel;
use App\Models\Minter;
use App\Rules\UniqueShoulder;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NaanResource extends Resource
{
    protected static ?string $model = NaanModel::class;
    protected static ?string $slug = 'naan';
    protected static ?string $navigationLabel = 'NAANs';
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $label = 'NAAN';
    protected static ?string $pluralLabel = 'NAANs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Base')
                    ->schema([
                        TextInput::make('naan')
                            ->unique(ignoreRecord: true)
                            ->label('NAAN')
                            ->required(),
                        TextInput::make('description')
                            ->label('Description')
                            ->required(),
                    ]),
                Section::make('Minter')
                    ->schema([
                        Select::make('minter_settings_id')
                            ->label('Minter Settings')
                            ->options(Minter::all()->pluck('name', 'id'))
                            ->required(),
                    ]),
                Section::make('Shoulders')
                    ->schema([
                        Repeater::make('shoulders')
                            ->schema([
                                TextInput::make('shoulder')
                                    ->required()
                                    ->filled()
                                    ->rules([new UniqueShoulder('test')]),
                                TextInput::make('description')
                                    ->filled()
                                    ->required(),
                            ])
                            ->reorderable(false)
                            ->collapsed()
                            ->itemLabel(fn (array $state): ?string => $state['description'].' ('.$state['shoulder'].')' ?? null)
                    ])
                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('naan')
                ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('description')
                ->searchable()
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
            'index' => Pages\ListNaans::route('/'),
            'create' => Pages\CreateNaan::route('/create'),
            'edit' => Pages\EditNaan::route('/{record}/edit'),
        ];
    }
}
