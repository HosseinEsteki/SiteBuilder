<?php

namespace App\Filament\Components\Columns\Order;

use Filament\Tables\Columns\TextColumn;

class OrderBuyerColumn
{
    public static function make()
    {
        return TextColumn::make('user.name')
            ->searchable()->label(trans('ecommerce::ecommerce.orders.buyer'));
    }
}
