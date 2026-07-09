<?php

namespace App\Filament\Resources\ThemeBuilder\Themes\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Theme\Enums\ThemePermission;
use Theme\Models\Theme;

class ThemesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('slug')->searchable()->toggleable(),
                IconColumn::make('is_active')->boolean()->label('Active'),
                TextColumn::make('templates_count')->counts('templates')->label('Templates'),
                TextColumn::make('pages_count')->counts('pages')->label('Pages'),
                TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->recordActions([
                Action::make('activate')
                    ->visible(fn (Theme $record): bool => ! $record->is_active && (auth()->user()?->can(ThemePermission::ThemeUpdate->value) || false))
                    ->requiresConfirmation()
                    ->action(function (Theme $record): void {
                        Theme::query()->whereKeyNot($record->getKey())->update(['is_active' => false]);
                        $record->update(['is_active' => true]);
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
