<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Filament\Components\Inputs\EmailInput;
use App\Filament\Components\Inputs\ImageInput;
use App\Filament\Components\Inputs\NameInput;
use App\Filament\Components\Inputs\PasswordInput;
use App\Filament\Components\Inputs\UserRoleInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageInput::make('user'),
                NameInput::make(),
                EmailInput::make(),
                UserRoleInput::make(),
                ...PasswordInput::make(),
            ]);
    }
}
