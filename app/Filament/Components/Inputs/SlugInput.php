<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\TextInput;

class SlugInput
{
    public static function make()
    {
        return
            TextInput::make('slug')->label(trans('public.slug'))
                ->required()
                ->unique();
    }
}
