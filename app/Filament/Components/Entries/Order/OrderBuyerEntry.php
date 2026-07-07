<?php

namespace App\Filament\Components\Entries\Order;

use Filament\Infolists\Components\TextEntry;

class OrderBuyerEntry
{
    public static function make()
    {
        return TextEntry::make('user.name')
            ->label(trans('ecommerce::ecommerce.orders.buyer'));
    }
}
