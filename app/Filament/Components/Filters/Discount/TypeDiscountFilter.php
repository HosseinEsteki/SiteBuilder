<?php

namespace App\Filament\Components\Filters\Discount;

use Ecommerce\Enums\DiscountType;
use Filament\Tables\Filters\SelectFilter;

class TypeDiscountFilter
{
    public static function make()
    {
        return SelectFilter::make('type')
            ->label(trans('ecommerce::ecommerce.discount.type'))
            ->options(DiscountType::options());
    }
}
