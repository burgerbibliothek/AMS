<?php

namespace App\Filament\Resources\Ark;

use App\AMS\ARK;
use App\Filament\Imports\ARKImporter;
use App\Filament\Resources\Ark\ArkResource\Pages;
use App\Models\Ark as ArkModel;
use App\Models\Status;
use App\Models\Naan;
use App\Models\Shoulder;
use App\Rules\ExistingNaan;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ArkResource extends Resource
{
    protected static ?string $model = ArkModel::class;
    protected static ?string $navigationIcon = 'heroicon-s-key';
    protected static ?string $navigationLabel = 'ARKs';
    protected static ?string $label = 'ARKs';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('naan')
                    ->label('NAAN')
                    ->options(Naan::all()->pluck('naan','naan'))
                    ->visible(fn (Get $get): bool => is_null($get('ark')))
                    ->rules([new ExistingNaan()])
                    ->required(),
                TextInput::make('ark')
                    ->unique(ignoreRecord: true)
                    ->disabled()
                    ->visible(fn (Get $get): bool => !is_null($get('ark')))
                    ->label('ARK'),
                TextInput::make('uri')
                    ->label('URI')
                    ->activeUrl()
                    ->required(),
                Select::make('status_id')
                    ->label('HTTP-Status')
                    ->options(Status::all()->pluck('label', 'id')),
                /*
                Section::make('Metadata')
                    ->schema([
                        Repeater::make('members')
                        ->schema([
                            TextInput::make('name')->required(),
                            Select::make('role')
                                ->options([
                                    'member' => 'Member',
                                    'administrator' => 'Administrator',
                                    'owner' => 'Owner',
                                ])
                            ->required(),
                        ]),
                    ])
                */
                
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ark')
                ->searchable()
                ->sortable()
                ->label('ARK'),
                Tables\Columns\TextColumn::make('uri')
                ->searchable()
                ->label('URI')
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListArks::route('/'),
            'edit' => Pages\EditArk::route('/edit/{record}'),
            'create' => Pages\CreateArk::route('/create'),
        ];
    }

}
