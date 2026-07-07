<?php

namespace App\Filament\Components\Entries\Order;

use App\Filament\FilamentComponentInterface;
use Ecommerce\Enums\OrderStatus;
use Filament\Infolists\Components\TextEntry;

class OrderStatusEntry implements FilamentComponentInterface
{
public static function make()
{
    return TextEntry::make('status')
        ->label(trans('ecommerce::ecommerce.orders.status.label'))
        ->badge()->colors(OrderStatus::filamentColors())
        ->formatStateUsing(fn($state) => OrderStatus::showState($state));
}
}
