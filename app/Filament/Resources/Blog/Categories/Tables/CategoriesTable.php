<?php

namespace App\Filament\Resources\Blog\Categories\Tables;

use App\Filament\Components\Columns\AuthorColumn;
use App\Filament\Components\Columns\NameAndSlugColumns;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Filters\AuthorFilter;
use Blog\Enums\BlogPermission;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ...NameAndSlugColumns::make(),
                AuthorColumn::make(),
                TextColumn::make('articles_count')->label(trans('blog::blog.articles.count'))
                    ->numeric()
                    ->toggleable(),
                ...TimestampColumns::make(),
            ])
            ->filters([
                AuthorFilter::make(BlogPermission::Category),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
