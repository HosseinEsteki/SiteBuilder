<?php

namespace App\Filament\Components\Columns\Discount;

use App\Filament\FilamentComponentInterface;
use Filament\Tables\Columns\TextColumn;

class DiscountValueColumn implements FilamentComponentInterface
{
    public static function make()
    {
        return
            TextColumn::make('value')
                ->label(trans('ecommerce::ecommerce.discount.value'))
                ->searchable()
                ->numeric()
                ->sortable()
                ->toggleable();
}
}
