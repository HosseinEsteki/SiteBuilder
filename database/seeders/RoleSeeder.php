<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = Role::create(['name' => 'super-admin']);
        Role::query()->firstOrCreate(['name' => 'admin']);
        Role::query()->firstOrCreate(['name' => 'editor']);
        Role::query()->firstOrCreate(['name' => 'seller']);
        Role::query()->firstOrCreate(['name' => 'customer']);
        $superAdmin->givePermissionTo(Permission::all());


    }
}
