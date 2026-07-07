<?php

namespace Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Ecommerce\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::factory()->count(20)->create();
    }
}
