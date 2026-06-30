<?php

namespace App\Filament\Resources\Settings\Naans;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Settings\Naans\Pages\ListNaans;
use App\Filament\Resources\Settings\Naans\Pages\CreateNaan;
use App\Filament\Resources\Settings\Naans\Pages\EditNaan;
use App\Models\Minter as MinterModel;
use App\Models\Naan as NaanModel;
use App\Rules\UniqueShoulder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\Checkbox;

class NaanResource extends Resource
{
    protected static ?string $model = NaanModel::class;

    protected static ?string $slug = 'settings/naans';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-library';

    protected static ?string $label = 'NAAN';

    protected static ?string $pluralLabel = 'NAANs';

    public static function getNavigationGroup(): ?string
    {
        return __('ams.navigation_settings');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                        Select::make('minter_id')
                            ->label(__('ams.naan_resource_minter'))
                            ->options(MinterModel::all()->pluck('name', 'id'))
                            ->required(),
                        Checkbox::make('spt')
                            ->label(__('ams.naan_resource_spt'))
                            ->helperText(__('ams.naan_resource_spt_help')),
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
                            ->defaultItems(0),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('naan')
                    ->label(__('ams.naan_resource_naan_list'))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('description')
                    ->label(__('ams.naan_resource_desc'))
                    ->searchable(),
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

    public static function getPages(): array
    {
        return [
            'index' => ListNaans::route('/'),
            'create' => CreateNaan::route('/create'),
            'edit' => EditNaan::route('/edit/{record}'),
        ];
    }
}
