<?php

namespace Ecommerce\Database\Seeders;

use Ecommerce\Enums\EcommercePermission;
use Illuminate\Database\Seeder;
use App\Models\Authorize\Permission;

class EcommercePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = EcommercePermission::getPermissionNames();
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web','module'=>'ecommerce']);
        }
    }
}
