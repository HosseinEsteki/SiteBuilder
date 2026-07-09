<?php

namespace Theme\Database\Seeders;

use App\Models\Authorize\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Theme\Enums\ThemePermission;

class ThemePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        foreach (ThemePermission::getPermissionNames() as $permission) {
            Permission::query()->firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
                'module' => 'theme',
            ]);
        }

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
