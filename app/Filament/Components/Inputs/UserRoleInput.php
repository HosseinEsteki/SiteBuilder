<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\Select;

class UserRoleInput
{
    public static function make()
    {
        return Select::make('roles')
            ->label(trans('Role'))
            ->relationship('roles', 'name')
            ->multiple()
            ->searchable()
            ->preload();
    }
}
