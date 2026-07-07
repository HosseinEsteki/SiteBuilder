<?php

namespace App\Filament\Components\Filters;

use Filament\Tables\Filters\SelectFilter;

class BrandFilter
{
    public static function make()
    {
        return SelectFilter::make('brand_id')
            ->label(trans('ecommerce::ecommerce.brand.label'))
            ->relationship('brand', 'name')
            ->searchable()
            ->preload();
    }
}
