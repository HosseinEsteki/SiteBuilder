<?php

namespace App\Filament\Components\Entries\Product;

use Filament\Infolists\Components\TextEntry;

class PriceEntries
{

    public static function make()
    {
        return [TextEntry::make('price')
            ->label(trans('ecommerce::ecommerce.money.price'))
            ->prefix(trans('ecommerce::ecommerce.money.currency'))
            ->visible(fn($record) => !$record->is_variable),
            TextEntry::make('sale_price')
                ->label(trans('ecommerce::ecommerce.money.sale_price'))
                ->prefix(trans('ecommerce::ecommerce.money.currency'))
            ,
            ];
    }
}
