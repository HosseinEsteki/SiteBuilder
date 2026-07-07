<?php

namespace App\Filament\Components\Filters;

use Filament\Tables\Filters\SelectFilter;

class ActiveFilter
{
    public static function make()
    {
        return SelectFilter::make('active')
            ->label(trans('ecommerce::ecommerce.active.label'))
            ->options([
                true => trans('ecommerce::ecommerce.active.true'),
                false => trans('ecommerce::ecommerce.active.false'),
            ]);
}
}
