<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\TextInput;

class EmailInput
{
    public static function make()
    {
        return
            TextInput::make('email')
            ->label(trans('Email'))
            ->email()
            ->required();
    }
}
