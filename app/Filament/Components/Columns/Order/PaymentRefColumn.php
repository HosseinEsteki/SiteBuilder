<?php

namespace App\Filament\Components\Columns\Order;

use Filament\Tables\Columns\TextColumn;

class PaymentRefColumn
{
    public static function make()
    {
        return TextColumn::make('payment_ref')
            ->searchable()
            ->label(trans('ecommerce::ecommerce.orders.payment_ref'));
}
}
