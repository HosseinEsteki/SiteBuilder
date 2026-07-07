<?php

namespace App\Filament\Components\Columns\Order;

use Ecommerce\Enums\OrderStatus;
use Filament\Tables\Columns\TextColumn;

class OrderStatusColumn
{
    public static function make()
    {
        return TextColumn::make('status')
            ->label(trans('ecommerce::ecommerce.orders.status.label'))
            ->badge()->colors(OrderStatus::filamentColors())
            ->formatStateUsing(fn($state) => OrderStatus::showState($state));
    }
}
