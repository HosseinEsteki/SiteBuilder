<?php

namespace App\Filament\Resources\Ecommerce\Discounts\Tables;

use App\Filament\Components\Actions\ActiveBulkAction;
use App\Filament\Components\Columns\ActiveColumn;
use App\Filament\Components\Columns\AuthorColumn;
use App\Filament\Components\Columns\Discount\DiscountStartEndDateColumns;
use App\Filament\Components\Columns\Discount\DiscountTypeColumn;
use App\Filament\Components\Columns\Discount\DiscountUsageLimitColumn;
use App\Filament\Components\Columns\Discount\DiscountUsedCountColumn;
use App\Filament\Components\Columns\Discount\DiscountValueColumn;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Filters\ActiveFilter;
use App\Filament\Components\Filters\AuthorFilter;
use App\Filament\Components\Filters\Discount\DateDiscountFilters;
use App\Filament\Components\Filters\Discount\TypeDiscountFilter;
use App\Filament\Components\Filters\TimestampFilter;
use Ecommerce\Enums\EcommercePermission;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DiscountsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()->label(trans('ecommerce::ecommerce.discount.title')),
                AuthorColumn::make(),
                DiscountTypeColumn::make(),
                DiscountValueColumn::make(),
                ...DiscountStartEndDateColumns::make(),
                DiscountUsageLimitColumn::make(),
                DiscountUsedCountColumn::make(),
                ActiveColumn::make(),

                ...TimestampColumns::make(),
            ])
            ->filters([
                TypeDiscountFilter::make(),
                ActiveFilter::make(),
                ...DateDiscountFilters::make(),
                AuthorFilter::make(EcommercePermission::Discount),
                TimestampFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ActiveBulkAction::make(),
                ]),
            ]);
    }
}
