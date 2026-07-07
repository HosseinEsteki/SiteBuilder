<?php
namespace Blog\Database\Seeders;

use Blog\Enums\BlogPermission;
use Illuminate\Database\Seeder;
use App\Models\Authorize\Permission;

class BlogPermissionSeeder extends Seeder
{
    public function run(): void
    {
        // لیست دسترسی‌ها
        $permissions = BlogPermission::getPermissionNames();

        // ایجاد دسترسی‌ها
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web','module'=>'blog']);
        }
    }
}
