<?php

namespace App\Filament\Components\Inputs\Discount;

use Filament\Forms\Components\DatePicker;

class DiscountStartEndDateInputs
{
    public static function make()
    {
        return [
            DatePicker::make('start_date')
            ->label(trans('ecommerce::ecommerce.discount.start_date'))
            ->jalali(),
            DatePicker::make('end_date')
                ->label(trans('ecommerce::ecommerce.discount.end_date'))
                ->jalali()
        ];
}
}
