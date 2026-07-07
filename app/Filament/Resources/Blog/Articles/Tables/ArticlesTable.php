<?php

namespace App\Filament\Resources\Blog\Articles\Tables;

use App\Filament\Components\Columns\AuthorColumn;
use App\Filament\Components\Columns\CategoryColumn;
use App\Filament\Components\Columns\KeywordsColumn;
use App\Filament\Components\Columns\NameAndSlugColumns;
use App\Filament\Components\Columns\PostStatusColumn;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Filters\AuthorFilter;
use App\Filament\Components\Filters\CategoryFilter;
use App\Filament\Components\Filters\KeywordsFilter;
use App\Filament\Components\Filters\PostStatusFilter;
use App\Filament\Components\Filters\TimestampFilter;
use Blog\Enums\BlogPermission;
use Blog\Models\Article;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class ArticlesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ...NameAndSlugColumns::make(),
                CategoryColumn::make(),
                KeywordsColumn::make(),
                AuthorColumn::make(),
                PostStatusColumn::make(),
                ...TimestampColumns::make(),
            ])
            ->filters([
                KeywordsFilter::make(new Article),
                TimestampFilter::make(),
                PostStatusFilter::make(),
                CategoryFilter::make(),
                AuthorFilter::make(BlogPermission::Article),

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
