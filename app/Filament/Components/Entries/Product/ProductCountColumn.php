<?php

namespace App\Filament\Components\Entries\Product;

use Filament\Tables\Columns\TextColumn;

class ProductCountColumn
{
    public static function make()
    {
        return TextColumn::make('product_count')
            ->label(trans('ecommerce::ecommerce.products.count'))
            ->numeric()
            ->sortable()
            ->toggleable();
    }
}
