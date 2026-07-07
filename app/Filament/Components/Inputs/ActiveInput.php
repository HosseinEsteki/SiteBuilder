<?php

namespace App\Filament\Components\Inputs;

use App\Filament\FilamentComponentInterface;
use Filament\Forms\Components\Toggle;

class ActiveInput implements FilamentComponentInterface
{
    public static function make()
    {
        return Toggle::make('active')
            ->label(trans('ecommerce::ecommerce.active.label'))
            ->default(true)
            ->columnSpanFull()
//            ->extraFieldWrapperAttributes([
//                'class' => 'toggle-input',
//            ])
            ;
    }
}
