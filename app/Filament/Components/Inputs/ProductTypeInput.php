<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\Select;

class ProductTypeInput
{
    public static function make()
    {
        return Select::make('is_variable')
            ->label(trans('ecommerce::ecommerce.products.types.name'))
            ->options([
                false => trans('ecommerce::ecommerce.products.types.simple'),
                true => trans('ecommerce::ecommerce.products.types.variable'),
            ])
            ->default(false)
            ->reactive();
    }
}
