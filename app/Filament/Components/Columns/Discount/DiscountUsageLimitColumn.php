<?php

namespace App\Filament\Components\Columns\Discount;

use App\Filament\FilamentComponentInterface;
use Filament\Tables\Columns\TextColumn;

class DiscountUsageLimitColumn implements FilamentComponentInterface
{
    public static function make()
    {
        return TextColumn::make('usage_limit')
            ->label(trans('ecommerce::ecommerce.discount.usage_limit'))
            ->numeric()
            ->searchable()
            ->sortable()
            ->toggleable();
}
}
