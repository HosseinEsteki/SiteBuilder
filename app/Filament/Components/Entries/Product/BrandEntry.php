<?php

namespace App\Filament\Components\Entries\Product;

use Filament\Infolists\Components\TextEntry;

class BrandEntry
{
    public static function make()
    {
        return TextEntry::make('brand.name')
            ->label(trans('ecommerce::ecommerce.brand.label'));
}
}
