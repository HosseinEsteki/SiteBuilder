<?php

namespace App\Filament\Resources\ThemeBuilder\Templates\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Theme\Enums\ThemePermission;
use Theme\Models\ThemeTemplate;

class ThemeTemplatesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('slug')->searchable()->toggleable(),
                TextColumn::make('theme.name')->label('Theme')->sortable(),
                TextColumn::make('type')->badge()->sortable(),
                TextColumn::make('status')->badge()->sortable(),
                IconColumn::make('is_default')->boolean()->label('Default'),
                TextColumn::make('updated_at')->dateTime()->sortable(),
            ])
            ->recordActions([
                Action::make('publish')
                    ->visible(fn (ThemeTemplate $record): bool => $record->status !== 'published' && (auth()->user()?->can(ThemePermission::TemplateUpdate->value) || false))
                    ->action(fn (ThemeTemplate $record) => $record->update(['status' => 'published'])),
                Action::make('draft')
                    ->visible(fn (ThemeTemplate $record): bool => $record->status === 'published' && (auth()->user()?->can(ThemePermission::TemplateUpdate->value) || false))
                    ->action(fn (ThemeTemplate $record) => $record->update(['status' => 'draft'])),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
