<?php

namespace App\Filament\Resources\Ecommerce\Comments\Tables;

use App\Filament\Components\Actions\CommentStatusActions;
use App\Filament\Components\Columns\AuthorColumn;
use App\Filament\Components\Columns\SubjectColumn;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Filters\AuthorFilter;
use App\Filament\Components\Filters\CommentStatusFilter;
use App\Filament\Components\Inputs\CommentInput;
use App\Filament\Components\Inputs\CommentStatusInput;
use Ecommerce\Enums\EcommercePermission;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                AuthorColumn::make(),
                TextColumn::make('article.name')->label(trans('blog::blog.articles.show')),
                SubjectColumn::make(),
                CommentInput::make(),
                CommentStatusInput::make(),
                ...TimestampColumns::make()
            ])
            ->filters([
                CommentStatusFilter::make(),
                AuthorFilter::make(EcommercePermission::Comment),
            ])
            ->recordActions([
                ...CommentStatusActions::make(),
            ])
            ->toolbarActions([

            ]);
    }
}
