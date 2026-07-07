<?php

namespace App\Filament\Components\Inputs;

use App\Filament\FilamentComponentInterface;
use Ecommerce\Enums\OrderStatus;
use Filament\Forms\Components\Select;

class OrderStatusInput implements FilamentComponentInterface
{
    public static function make()
    {
        return Select::make('status')
            ->label(trans('ecommerce::ecommerce.orders.status.label'))
            ->options(OrderStatus::options())
            ->default(OrderStatus::Pending->value)
            ->required();
}
}
