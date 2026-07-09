<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $allPermissions = Permission::query()->pluck('name')->all();

        Role::query()->firstOrCreate(['name' => 'Super Admin'])
            ->syncPermissions($allPermissions);

        Role::query()->firstOrCreate(['name' => 'Editor'])
            ->syncPermissions([
                'theme.pages.view',
                'theme.pages.create',
                'theme.pages.update',
                'theme.pages.publish',
                'theme.templates.view',
            ]);

        Role::query()->firstOrCreate(['name' => 'Customer'])
            ->syncPermissions([]);

        Role::query()->firstOrCreate(['name' => 'مدیرکل'])
            ->syncPermissions($allPermissions);

        Role::query()->firstOrCreate(['name' => 'کاربر عمومی'])
            ->syncPermissions([]);
    }
}
