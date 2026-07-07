<?php

namespace App\Filament\Components\Filters;

use Ecommerce\Enums\OrderStatus;
use Filament\Tables\Filters\SelectFilter;

class OrderStatusFilter
{
    public static function make()
    {
        return SelectFilter::make('status')
            ->label(trans('ecommerce::ecommerce.orders.status.label'))
            ->options(
                OrderStatus::options()
            );
    }
}
