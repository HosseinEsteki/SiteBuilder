<?php

namespace App\Filament\Components\Entries\Product;

use Filament\Infolists\Components\TextEntry;

class StockEntry
{
    public static function make()
    {
        return TextEntry::make('stock')
            ->label(trans('ecommerce::ecommerce.products.stock'))
            ->numeric();
}
}
