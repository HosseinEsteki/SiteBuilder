<?php

namespace App\Filament\Components\Columns\Discount;

use App\Filament\FilamentComponentInterface;
use Filament\Tables\Columns\TextColumn;

class DiscountUsedCountColumn implements FilamentComponentInterface
{
    public static function make()
    {
        return TextColumn::make('used_count')
            ->label(trans('ecommerce::ecommerce.discount.used_count'))
            ->numeric()
            ->sortable()
            ->toggleable();
    }
}
