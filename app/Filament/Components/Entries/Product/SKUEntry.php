<?php

namespace App\Filament\Components\Entries\Product;

use Filament\Infolists\Components\TextEntry;

class SKUEntry
{
    public static function make()
    {
        return TextEntry::make('sku')->label('SKU');
}
}
