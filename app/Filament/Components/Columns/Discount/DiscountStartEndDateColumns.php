<?php

namespace App\Filament\Components\Columns\Discount;

use App\Filament\FilamentComponentInterface;
use Filament\Tables\Columns\TextColumn;

class DiscountStartEndDateColumns implements FilamentComponentInterface
{
    public static function make()
    {
        return [TextColumn::make('start_date')
            ->label(trans('ecommerce::ecommerce.discount.start_date'))
            ->jalaliDateTime('d F, Y')
            ->sortable()
            ->toggleable(),
                TextColumn::make('end_date')
                    ->label(trans('ecommerce::ecommerce.discount.end_date'))
                    ->jalaliDateTime('d F, Y')
                    ->sortable()
                    ->toggleable()
        ];
}
}
