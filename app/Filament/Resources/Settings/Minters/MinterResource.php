<?php

namespace App\Filament\Resources\Settings\Minters;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\Settings\Minters\Pages\ListMinters;
use App\Filament\Resources\Settings\Minters\Pages\CreateMinter;
use App\Filament\Resources\Settings\Minters\Pages\EditMinter;
use App\Models\Minter as MinterModel;
use Burgerbibliothek\ArkManagementTools\Validator;
use Closure;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Table;

class MinterResource extends Resource
{
    protected static ?string $model = MinterModel::class;

    protected static ?string $slug = 'settings/minters';

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-calculator';

    protected static ?string $navigationLabel = 'Minter';

    protected static ?string $label = 'Minter';

    public static function getNavigationGroup(): ?string
    {
        return __('ams.navigation_settings');
    }

    /** Remove duplicates from and sort string. */
    public static function arkCharacterRepetoire($xdigits)
    {
        $xdigits = array_unique(str_split($xdigits));
        sort($xdigits);

        return implode('', $xdigits);
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make(__('ams.minter_resource_section_minter'))
                    ->schema([
                        TextInput::make('name')
                            ->label(__('ams.minter_resource_name'))
                            ->helperText(__('ams.minter_resource_name_help'))
                            ->placeholder(__('ams.minter_resource_name_placeholder'))
                            ->required(),
                        TextInput::make('xdigits')
                            ->label(__('ams.minter_resource_xdigits'))
                            ->helperText(__('ams.minter_resource_xdigits_help'))
                            ->placeholder(__('ams.minter_resource_xdigits_placeholder'))
                            ->rules([
                                fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                    /** Check if conttains only valid ARK characters. */
                                    if (! Validator::followsArkCharacterRepetoire($value)) {
                                        $fail(__('ams.minter_resource_xdigits_error'));
                                    }

                                    $charRepetoireLen = count(array_unique(str_split($value)));
                                    // CheckZone has always a NAAN which is 5 characters long
                                    $idLen = (int)$get('length') + 6;

                                    if ($get('ncda') === true && $charRepetoireLen <= $idLen) {
                                        $fail(__('ams.minter_resource_xdigits_length_error', ['number' => $idLen]));
                                    }
                                },
                            ])
                            ->required(),
                        TextInput::make('length')
                            ->label(__('ams.minter_resource_length'))
                            ->helperText(__('ams.minter_resource_length_help'))
                            ->placeholder('2')
                            ->numeric()
                            ->inputMode('decimal')
                            ->minValue(2)
                            ->rules([
                                fn (Get $get): Closure => function (string $attribute, $value, Closure $fail) use ($get) {
                                    /** Check if id-length does not exceed length of character repetoire. */
                                    $xdigitsArr = array_unique(str_split($get('xdigits')));
                                    $xdigitsArrLength = count($xdigitsArr);

                                    if ($get('ncda') && $value >= $xdigitsArrLength) {
                                        $fail(__('ams.minter_resource_lenght_error', ['number' => $xdigitsArrLength]));
                                    }
                                },
                            ])
                            ->required(),
                        Checkbox::make('ncda')
                            ->label(__('ams.minter_resource_ncda'))
                            ->helperText(__('ams.minter_resource_ncda_help')),
                    ]),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label(__('ams.minter_resource_name'))
                    ->sortable(),
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
            'index' => ListMinters::route('/'),
            'create' => CreateMinter::route('/create'),
            'edit' => EditMinter::route('/edit/{record}'),
        ];
    }
}
