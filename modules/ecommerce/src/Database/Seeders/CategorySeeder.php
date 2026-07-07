<?php

namespace Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Ecommerce\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::factory()->count(5)->create();
    }
}
