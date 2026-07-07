<?php

namespace App\Filament\Components\Entries\Order;

use App\Filament\FilamentComponentInterface;
use Filament\Infolists\Components\TextEntry;

class OrderPriceEntries implements FilamentComponentInterface
{
    public static function make()
    {
        return [TextEntry::make('original_total')
            ->label(trans('ecommerce::ecommerce.money.price'))
            ->numeric()
            ->default(0)
            ->prefix(trans('ecommerce::ecommerce.money.currency')),
            TextEntry::make('total_price')
                ->label(trans('ecommerce::ecommerce.money.sale_price'))
                ->numeric()
                ->default(0)
                ->prefix(trans('ecommerce::ecommerce.money.currency'))];
    }
}
