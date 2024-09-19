<?php

namespace App\Filament\Resources\Ark;

use Burgerbibliothek\ArkManagementTools\Erc;
use App\Filament\Exports\ArkExporter;
use App\Filament\Resources\Ark\ArkResource\Pages;
use App\Filament\Resources\Ark\ArkResource\RelationManagers;
use App\Models\Ark as ArkModel;
use App\Models\Naan as NaanModel;
use App\Models\Status as StatusModel;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\ExportBulkAction;

class ArkResource extends Resource
{
    protected static ?string $model = ArkModel::class;
    protected static ?string $navigationIcon = 'heroicon-s-key';
    protected static ?string $navigationLabel = 'ARKs';
    protected static ?string $label = 'ARKs';
    protected static ?string $slug = 'arks';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Section::make(__('ams.ark_resource_section_basic'))
                    ->schema([
                        Select::make('naan')
                            ->label(__('ams.ark_resource_naan'))
                            ->options(NaanModel::all()->whereNotNull('minter_settings_id')->pluck('naan','naan'))
                            ->visible(fn (Get $get): bool => is_null($get('ark')))
                            ->rules(['exists:naans,naan'])
                            ->required()
                            ->live(),
                        Select::make('shoulder')
                            ->label(__('ams.ark_resource_shoulders'))
                            ->options(function (Get $get): array {
                                // Get shoulders of NAAN
                                $options = [];
                                if($get('naan')){
                                    $shoulders = NaanModel::where('naan', $get('naan'))->pluck('shoulders')->flatten(1);
                                    if($shoulders && !is_null($shoulders[0])){
                                        foreach($shoulders as $shoulder){
                                            $options[$shoulder['shoulder']] = $shoulder['shoulder'].' ('.$shoulder['description'].')';
                                        }
                                    }
                                }
                                return $options;
                            })
                            ->visible(fn (Get $get): bool => is_null($get('ark'))),                      
                        TextInput::make('ark')
                            ->label(__('ams.ark_resource_ark'))
                            ->unique(ignoreRecord: true)
                            ->disabled()
                            ->visible(fn (Get $get): bool => !is_null($get('ark'))),
                        TextInput::make('uri')
                            ->label(__('ams.ark_resource_uri'))
                            ->activeUrl()
                            ->required(),
                        Select::make('status_id')
                            ->label(__('ams.ark_resource_status'))
                            ->options(StatusModel::all()->pluck('label', 'id')),
                    ]),
                Section::make(__('ams.ark_resource_section_metadata'))
                    ->schema([
                        TextInput::make('who')
                            ->label(__('ams.ark_resource_erc_who'))
                            ->helperText(__('ams.ark_resource_erc_who_help')),
                        TextInput::make('what')
                            ->label(__('ams.ark_resource_erc_what'))
                            ->helperText(__('ams.ark_resource_erc_what_help')),
                        TextInput::make('when')
                            ->label(__('ams.ark_resource_erc_when'))
                            ->helperText(__('ams.ark_resource_erc_when_help')),
                        TextInput::make('where')
                            ->label(__('ams.ark_resource_erc_where'))
                            ->helperText(__('ams.ark_resource_erc_where_help')),
                ])
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ark')
                    ->label(__('ams.ark_resource_ark_list'))
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('uri')
                    ->label(__('ams.ark_resource_uri_list'))
                    ->searchable()
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->using(function (Model $record, array $data): Model {
                        $record->update($data);
             
                        return $record;
                    }),
            ])
            ->bulkActions([
                ExportBulkAction::make()
                    ->exporter(ArkExporter::class)
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListArks::route('/'),
            'edit' => Pages\EditArk::route('/edit/{record}'),
            'create' => Pages\CreateArk::route('/create'),
        ];
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ArkRevisionsRelationManager::class,
        ];
    }

    public static function desirializeMetadata($metadata)
    {
        dump($metadata);
        $erc = Erc::parseKernelMetadata($metadata);
        dump($erc);
        foreach($erc as $k => $v){
            $data[$k] = $v;
        }

        return $data;
    }

}