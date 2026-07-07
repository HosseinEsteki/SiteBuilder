<?php

namespace App\Filament\Components\Entries\Order;

use App\Filament\FilamentComponentInterface;
use Filament\Infolists\Components\TextEntry;

class ShippingEntries implements FilamentComponentInterface
{
    public static function make()
    {
        return [
            TextEntry::make('shipping_user')
                ->label(trans('ecommerce::ecommerce.orders.shipping.receiver')),
            TextEntry::make('total_shipping')->numeric()->label(trans('ecommerce::ecommerce.orders.shipping.total')),
            TextEntry::make('shipping_address')->label(trans('ecommerce::ecommerce.orders.shipping.address')),
            TextEntry::make('shipping_code')->label(trans('ecommerce::ecommerce.orders.shipping.code')),
        ];
    }
}
