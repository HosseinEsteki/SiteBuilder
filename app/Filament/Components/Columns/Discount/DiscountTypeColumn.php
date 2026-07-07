<?php

namespace App\Filament\Components\Columns\Discount;

use App\Filament\FilamentComponentInterface;
use Ecommerce\Enums\DiscountType;
use Filament\Tables\Columns\TextColumn;

class DiscountTypeColumn implements FilamentComponentInterface
{
public static function make()
{
    return TextColumn::make('type')
        ->label(trans('ecommerce::ecommerce.discount.type'))
        ->badge()->colors(DiscountType::filamentColors())
        ->formatStateUsing(fn($state)=>DiscountType::getLabel($state))
        ->toggleable();
}
}
