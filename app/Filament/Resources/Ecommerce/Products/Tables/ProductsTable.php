<?php

namespace App\Filament\Resources\Ecommerce\Products\Tables;

use App\Filament\Components\Columns\AuthorColumn;
use App\Filament\Components\Columns\CategoryColumn;
use App\Filament\Components\Columns\NameAndSlugColumns;
use App\Filament\Components\Columns\PostStatusColumn;
use App\Filament\Components\Columns\PriceColumn;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Filters\AuthorFilter;
use App\Filament\Components\Filters\BrandFilter;
use App\Filament\Components\Filters\PostStatusFilter;
use App\Filament\Components\Filters\TimestampFilter;
use Blog\Enums\BlogPermission;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ...NameAndSlugColumns::make(),
                PostStatusColumn::make(),
                PriceColumn::make(),
                AuthorColumn::make(),
                TextColumn::make('stock')
                    ->label(trans('ecommerce::ecommerce.products.stock'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),
                CategoryColumn::make(),
                TextColumn::make('brand.name')
                    ->label(trans('ecommerce::ecommerce.brand.label'))
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                ...TimestampColumns::make(),

            ])
            ->filters([
                PostStatusFilter::make(),
                AuthorFilter::make(BlogPermission::Article),
                BrandFilter::make(),
                TimestampFilter::make(),
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
