<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\TextInput;

class StockInput
{
    public static function make()
    {
        return TextInput::make('stock')
            ->label(trans('ecommerce::ecommerce.products.stock'))
            ->numeric()
            ->minValue(0)
            ->visible(fn($get) => !$get('is_variable'));
    }
}
