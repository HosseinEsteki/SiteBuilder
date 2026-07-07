<?php

namespace App\Filament\Resources\Roles\Schemas;

use App\Filament\Components\Inputs\PermissionsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(trans('permissions.role'))
                    ->required()
                    ->unique(ignoreRecord: true),

                TextInput::make('guard_name')
                    ->label(trans('permissions.Guard'))
                    ->default('web')
                    ->required(),
                PermissionsInput::make(),

            ]);
    }
}
