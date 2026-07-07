<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\Select;

class CategoryInput
{
    public static function make()
    {
        return Select::make('category_id')
            ->relationship('category', 'name')
            ->label(trans('public.category'))
            ->searchable()
            ->preload()
            ->required();
    }

}
