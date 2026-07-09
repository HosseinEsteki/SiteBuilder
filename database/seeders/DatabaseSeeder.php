<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Blog\Database\Seeders\BlogPermissionSeeder;
use Blog\Database\Seeders\BlogSeeder;
use Ecommerce\Database\Seeders\EcommercePermissionSeeder;
use Illuminate\Database\Seeder;
use Ecommerce\Database\Seeders\EcommerceSeeder;
use Illuminate\Support\Facades\Auth;
use Theme\Database\Seeders\ThemePermissionSeeder;
use Theme\Database\Seeders\ThemeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Auth::loginUsingId(1);
        $this->call([
            OrganizationSeeder::class,
            BlogSeeder::class,
            EcommerceSeeder::class,
            ThemeSeeder::class,
        ]);
        /* در انتها ساخته بشه */
        $this->call([
            BlogPermissionSeeder::class,
            EcommercePermissionSeeder::class,
            ThemePermissionSeeder::class,
            RoleSeeder::class
        ]);

    }
}
