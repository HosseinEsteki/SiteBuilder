<?php

namespace App\Filament\Components\Entries\Order;

use App\Filament\FilamentComponentInterface;
use Filament\Infolists\Components\TextEntry;

class OrderDiscountEntry implements FilamentComponentInterface
{
    public static function make()
    {
        return TextEntry::make('discount')
            ->prefix(trans('ecommerce::ecommerce.money.currency'))
            ->label(trans('ecommerce::ecommerce.money.discount'))
            ->numeric()
            ->default(0);
}
}
