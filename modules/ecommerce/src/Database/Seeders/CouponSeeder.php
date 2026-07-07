<?php

namespace Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Ecommerce\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        Coupon::factory()->count(30)->create();
    }
}
