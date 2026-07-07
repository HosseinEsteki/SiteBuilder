<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\TextInput;

class NameInput
{
    public static function make()
    {
        return TextInput::make('name')
            ->label(trans('Name'))
            ->required();
    }
}
