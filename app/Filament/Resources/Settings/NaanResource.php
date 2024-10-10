<?php

namespace App\Filament\Resources\Settings;

use App\Filament\Resources\Settings\NaanResource\Pages;
use App\Models\Naan as NaanModel;
use App\Models\Minter as MinterModel;
use App\Rules\UniqueShoulder;
use Filament\Forms\Form;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NaanResource extends Resource
{
    protected static ?string $model = NaanModel::class;
    protected static ?string $slug = 'settings/naans';
    protected static ?string $navigationLabel = 'NAANs';
    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $label = 'NAAN';
    protected static ?string $pluralLabel = 'NAANs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make(__('ams.naan_resource_section_minter'))
                    ->schema([
                        TextInput::make('naan')
                            ->label(__('ams.naan_resource_naan'))
                            ->unique(ignoreRecord: true)
                            ->required(),
                        TextInput::make('nma')
                            ->label(__('ams.naan_resource_nma'))
                            ->activeUrl()
                            ->required(),
                        TextInput::make('description')
                            ->label(__('ams.naan_resource_desc'))
                            ->required(),
                        Select::make('minter_settings_id')
                            ->label(__('ams.naan_resource_minter'))
                            ->options(MinterModel::all()->pluck('name', 'id'))
                            ->required(),
                    ]),
                Section::make(__('ams.naan_resource_shoulders'))
                    ->schema([
                        Repeater::make('shoulders')
                            ->schema([
                                TextInput::make('shoulder')
                                    ->label(__('ams.naan_resource_shoulder'))
                                    ->required()
                                    ->filled()
                                    ->rules([new UniqueShoulder]),
                                TextInput::make('description')
                                    ->label(__('ams.naan_resource_desc'))
                                    ->filled()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->reorderable(false)
                            ->collapsed()
                            ->addActionLabel('Create Shoulder')
                            ->itemLabel(fn (array $state): ?string => $state['description'].' ('.$state['shoulder'].')' ?? null)
                            ->defaultItems(0)
                ])                    
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('naan')
                    ->label(__('ams.naan_resource_naan_list'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->label(__('ams.naan_resource_desc'))
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNaans::route('/'),
            'create' => Pages\CreateNaan::route('/create'),
            'edit' => Pages\EditNaan::route('/edit/{record}'),
        ];
    }
    
}
