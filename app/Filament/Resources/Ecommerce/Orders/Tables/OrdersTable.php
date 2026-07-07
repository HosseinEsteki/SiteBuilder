<?php

namespace App\Filament\Resources\Ecommerce\Orders\Tables;

use App\Filament\Components\Actions\ChangeOrderStatusBulkAction;
use App\Filament\Components\Columns\Order\OrderBuyerColumn;
use App\Filament\Components\Columns\Order\OrderShippingColumns;
use App\Filament\Components\Columns\Order\OrderStatusColumn;
use App\Filament\Components\Columns\Order\PaymentRefColumn;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Filters\OrderBuyerFilter;
use App\Filament\Components\Filters\OrderStatusFilter;
use App\Filament\Components\Filters\TimestampFilter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                PaymentRefColumn::make(),
                OrderBuyerColumn::make(),
                OrderStatusColumn::make(),
                TextColumn::make('original_total')
                    ->numeric()
                    ->sortable()
                    ->numeric()->toggleable(isToggledHiddenByDefault: true)
                    ->label(trans('ecommerce::ecommerce.money.original_total')),

                TextColumn::make('discount')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(trans('ecommerce::ecommerce.money.discount')),
                TextColumn::make('total_price')
                    ->numeric()
                    ->sortable()
                    ->label(trans('ecommerce::ecommerce.money.total_price')),
                ...OrderShippingColumns::make(),

                ...TimestampColumns::make(),
            ])
            ->filters([
                TimestampFilter::make(),
                OrderStatusFilter::make(),
                OrderBuyerFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ChangeOrderStatusBulkAction::make(),
                ]),
            ]);
    }
}
