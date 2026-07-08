<?php

namespace App\Filament\Components\Actions;

use Filament\Actions\BulkAction;
use Filament\Forms\Components\Select;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;

class AssignRoleBulkAction
{
    public static function make()
    {
        return BulkAction::make('assignRole')
            ->label(trans('permissions.assignRole'))
            ->schema([
                Select::make('role')
                    ->label(trans('permissions.role'))
                    ->options(Role::pluck('name', 'name'))
                    ->required(),
            ])
            ->action(function (Collection $records, array $data) {
                foreach ($records as $user) {
                    $user->syncRoles([$data['role']]);
                }
            });
    }
}
