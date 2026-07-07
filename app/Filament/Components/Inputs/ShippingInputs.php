<?php

namespace App\Filament\Components\Inputs;

use App\Filament\FilamentComponentInterface;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class ShippingInputs implements FilamentComponentInterface
{
    public static function make()
    {
        return [
            TextInput::make('shipping_user')
                ->label(trans('ecommerce::ecommerce.orders.shipping.receiver')),
            TextInput::make('total_shipping')
                ->numeric()
                ->label(trans('ecommerce::ecommerce.orders.shipping.total')),
            TextInput::make('shipping_code')
                ->label(trans('ecommerce::ecommerce.orders.shipping.code')),
            Textarea::make('shipping_address')
                ->label(trans('ecommerce::ecommerce.orders.shipping.address'))
            ->columnSpan(2),

        ];
    }
}
