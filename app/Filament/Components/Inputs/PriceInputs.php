<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\TextInput;

class PriceInputs
{
    public static function make()
    {
        return [
            TextInput::make('price')
                ->required()
                ->numeric()
                ->minValue(0)
                ->label(trans('ecommerce::ecommerce.money.price'))
                ->prefix(trans('ecommerce::ecommerce.money.currency'))
                ->visible(fn($get) => !$get('is_variable')),
            TextInput::make('sale_price')
                ->numeric()
                ->minValue(0)
                ->label(trans('ecommerce::ecommerce.money.sale_price'))
                ->prefix(trans('ecommerce::ecommerce.money.currency'))
                ->visible(fn($get) => !$get('is_variable'))
        ];
    }
}
