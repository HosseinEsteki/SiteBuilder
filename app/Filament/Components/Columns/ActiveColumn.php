<?php

namespace App\Filament\Components\Columns;

use App\Filament\FilamentComponentInterface;
use Filament\Tables\Columns\IconColumn;

class ActiveColumn implements FilamentComponentInterface
{
public static function make()
{
    return IconColumn::make('active')
        ->label(trans('ecommerce::ecommerce.active.label'))
        ->boolean()
        ->toggleable();
}
}
