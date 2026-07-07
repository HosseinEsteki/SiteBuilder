<?php

namespace App\Filament\Resources\Users\Tables;

use App\Filament\Components\Actions\AssignRoleBulkAction;
use App\Filament\Components\Columns\ImageColumn;
use App\Filament\Components\Columns\NameAndSlugColumns;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Filters\TimestampFilter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user'),
                NameAndSlugColumns::makeNameColumn(),
                TextColumn::make('roles.name')
                    ->label(trans('permissions.role'))
                    ->searchable()
                    ->sortable()
                    ->badge()
                    ->color('info'),
                TextColumn::make('email')
                    ->label(trans('Email'))
                    ->searchable(),
                TextColumn::make('article-count')
                    ->label(trans('blog::blog.articles.count'))
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('product-count')
                    ->label(trans('ecommerce::ecommerce.products.count'))
                    ->numeric()
                    ->toggleable(isToggledHiddenByDefault: true),
                ...TimestampColumns::make(),

            ])
            ->filters([
                SelectFilter::make('roles')
                    ->searchable()
                    ->relationship('roles', 'name')
                    ->label(trans('permissions.role'))
                    ->preload(),
                TimestampFilter::make(),
                TimestampFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    AssignRoleBulkAction::make()
                ]),
            ]);
    }
}
