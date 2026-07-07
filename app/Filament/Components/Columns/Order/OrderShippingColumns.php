<?php

namespace App\Filament\Components\Columns\Order;

use App\Filament\FilamentComponentInterface;
use Filament\Tables\Columns\TextColumn;

class OrderShippingColumns implements FilamentComponentInterface
{
    public static function make()
    {
        return [
            TextColumn::make('shipping_user')
                ->toggleable(isToggledHiddenByDefault: true)
                ->label(trans('ecommerce::ecommerce.orders.shipping.receiver')),
            TextColumn::make('total_shipping')
                ->toggleable()
                ->numeric()
                ->label(trans('ecommerce::ecommerce.orders.shipping.total')),
            TextColumn::make('shipping_address')
                ->toggleable(isToggledHiddenByDefault: true)
                ->label(trans('ecommerce::ecommerce.orders.shipping.address')),
            TextColumn::make('shipping_code')
                ->toggleable(isToggledHiddenByDefault: true)
                ->label(trans('ecommerce::ecommerce.orders.shipping.code')),
        ];
    }
}
