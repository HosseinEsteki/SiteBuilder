<?php

namespace Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Ecommerce\Models\Discount;

class DiscountSeeder extends Seeder
{
    public function run(): void
    {
        Discount::factory()->count(3)->create();
    }
}
