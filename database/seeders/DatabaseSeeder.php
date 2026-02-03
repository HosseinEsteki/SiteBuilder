<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Blog\Database\Seeders\BlogPermissionSeeder;
use Blog\Database\Seeders\BlogSeeder;
use Ecommerce\Database\Seeders\EcommercePermissionSeeder;
use Illuminate\Database\Seeder;
use Ecommerce\Database\Seeders\EcommerceSeeder;

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
            EcommerceSeeder::class,
        ]);
        /* در انتها ساخته بشه */
        $this->call([
            BlogPermissionSeeder::class,
            EcommercePermissionSeeder::class,
            RoleSeeder::class
        ]);

    }
}
