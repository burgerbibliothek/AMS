<?php

namespace App\Filament\Resources\Ark\Arks\RelationManagers;

use App\Filament\Resources\Ark\Arks\Pages\EditArk;
use App\Models\ArkRevision;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Enums\TextSize;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ArkRevisionsRelationManager extends RelationManager
{
    protected static string $relationship = 'ark_revisions';

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('ams.ark_resource_revision_title'))
            ->columns([
                TextColumn::make('created_at')
                    ->sortable()
                    ->label(__('ams.ark_resource_revision_moddate')),
                TextColumn::make('revision')
                    ->html()
                    ->size(TextSize::ExtraSmall)
                    ->label(__('ams.ark_resource_revision_data')),
            ])
            ->recordActions([
                Action::make('restore')
                    ->label(__('ams.ark_resource_revision_restore'))
                    ->icon('heroicon-o-arrow-uturn-left')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->modalHeading(__('ams.ark_resource_revision_restore_heading'))
                    ->modalDescription(__('ams.ark_resource_revision_restore_desc'))
                    ->modalSubmitActionLabel(__('ams.ark_resource_revision_restore_submit'))
                    ->action(function (ArkRevision $record, $livewire) {
                        if (! $record->restore()) {
                            Notification::make()
                                ->title(__('ams.ark_resource_revision_restore_nochange'))
                                ->warning()
                                ->send();

                            return;
                        }

                        Notification::make()
                            ->title(__('ams.ark_resource_revision_restore_success'))
                            ->success()
                            ->send();

                        /** Reload the edit page so the form shows the restored values. */
                        $livewire->redirect(EditArk::getUrl(['record' => $livewire->getOwnerRecord()]));
                    }),
            ]);
    }
}
