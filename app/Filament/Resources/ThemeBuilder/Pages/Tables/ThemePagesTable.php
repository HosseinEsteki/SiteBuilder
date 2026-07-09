<?php

namespace App\Filament\Resources\ThemeBuilder\Pages\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Theme\Enums\ThemePermission;
use Theme\Models\ThemePage;

class ThemePagesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('slug')->searchable()->toggleable(),
                TextColumn::make('theme.name')->label('Theme')->sortable(),
                TextColumn::make('template.name')->label('Template')->toggleable(),
                TextColumn::make('status')->badge()->sortable(),
                TextColumn::make('published_at')->dateTime()->sortable(),
                TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->recordActions([
                Action::make('preview')
                    ->url(fn (ThemePage $record): string => route('theme.pages.preview', $record))
                    ->openUrlInNewTab(),
                Action::make('publish')
                    ->visible(fn (ThemePage $record): bool => $record->status !== 'published' && (auth()->user()?->can(ThemePermission::PagePublish->value) || false))
                    ->action(fn (ThemePage $record) => $record->update([
                        'status' => 'published',
                        'published_at' => $record->published_at ?? now(),
                    ])),
                Action::make('unpublish')
                    ->visible(fn (ThemePage $record): bool => $record->status === 'published' && (auth()->user()?->can(ThemePermission::PagePublish->value) || false))
                    ->action(fn (ThemePage $record) => $record->update(['status' => 'draft'])),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
