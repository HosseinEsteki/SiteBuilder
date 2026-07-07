<?php

namespace App\Filament\Components\Entries\Order;

use App\Filament\FilamentComponentInterface;
use Filament\Infolists\Components\TextEntry;

class OrderPaymentRefEntry implements FilamentComponentInterface
{
public static function make()
{
    return TextEntry::make('payment_ref')
        ->label(trans('ecommerce::ecommerce.orders.payment_ref'));
}
}
