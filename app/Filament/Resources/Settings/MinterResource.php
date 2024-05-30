<?php

namespace App\Filament\Resources\Settings;

use App\AMS\Validator;
use App\Filament\Resources\Settings\MinterResource\Pages;
use App\Models\Minter as MinterModel;
use Closure;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;


class MinterResource extends Resource
{
    protected static ?string $model = MinterModel::class;
    protected static ?string $slug = 'settings/minters';
    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Minter';
    protected static ?string $label = 'Minter';

    
    /*
     * Remove duplicates from and sort string. 
     */
    public static function arkCharacterRepetoire($xdigits)
    {
        $xdigits = array_unique(str_split($xdigits));
        sort($xdigits);
        return implode('', $xdigits);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
                                fn (): Closure => function (string $attribute, $value, Closure $fail) {
                                    // Check if conttains only valid ARK characters.
                                    if(!Validator::validArkCharacterRepetoire($value)){
                                        $fail(__('ams.minter_resource_xdigits_error'));
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
                                    // Check if id-length does not exceed length of character repetoire.
                                    $xdigitsArr = array_unique(str_split($get('xdigits')));
                                    $xdigitsArrLength = count($xdigitsArr);
                                    
                                    if ($get('ncda') && $value > $xdigitsArrLength) {
                                        $fail(__('ams.minter_resource_lenght_error', ['number' => $xdigitsArrLength]));
                                    }
                                },
                            ])
                            ->required(),
                        Checkbox::make('ncda')
                            ->label(__('ams.minter_resource_ncda'))
                            ->helperText(__('ams.minter_resource_ncda_help'))
                    ])
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMinters::route('/'),
            'create' => Pages\CreateMinter::route('/create'),
            'edit' => Pages\EditMinter::route('/edit/{record}'),
        ];
    }
}
