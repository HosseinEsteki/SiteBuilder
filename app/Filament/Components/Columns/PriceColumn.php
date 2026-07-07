<?php

namespace App\Filament\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class PriceColumn
{
    public static function make()
    {
        return TextColumn::make('price')
            ->label(trans('public.money.price'))
            ->sortable()
            ->sortable();
    }
}
