<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Blog\Database\Seeders\BlogPermissionSeeder;
use Modules\Blog\Database\Seeders\BlogSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        $this->call([
            BlogSeeder::class,
            BlogPermissionSeeder::class,
        ]);
        /* در انتها ساخته بشه */
        $this->call([RoleSeeder::class]);

    }
}
