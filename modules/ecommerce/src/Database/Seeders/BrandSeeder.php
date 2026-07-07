<?php

namespace Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Ecommerce\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory()->count(3)->create();
    }
}
