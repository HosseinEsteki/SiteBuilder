<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\Textarea;

class DescriptionInput
{
    public static function make()
    {
        return Textarea::make('description')
            ->columnSpanFull()
            ->label(trans('public.description'));
    }
}
