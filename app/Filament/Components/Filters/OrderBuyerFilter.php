<?php

namespace App\Filament\Components\Filters;

use App\Models\User;
use Filament\Tables\Filters\SelectFilter;

class OrderBuyerFilter
{
    public static function make()
    {

        return SelectFilter::make('user_id')
            ->label(trans('ecommerce::ecommerce.orders.buyer'))
            ->options(
                User::query()->whereHas('orders')->pluck('name','id')->toArray()
            )
            ->searchable()
            ->preload();
}
}
