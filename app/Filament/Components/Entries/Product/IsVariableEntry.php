<?php

namespace App\Filament\Components\Entries\Product;

use Filament\Infolists\Components\TextEntry;

class IsVariableEntry
{
    public static function make()
    {
        return TextEntry::make('is_variable')
            ->label(trans('ecommerce::ecommerce.products.types.name'))
            ->formatStateUsing(fn($state) => $state ? trans('ecommerce::ecommerce.products.types.variable') : trans('ecommerce::ecommerce.products.types.simple'));

}
}
