<?php

namespace Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;

class EcommerceSeeder extends Seeder
{

    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            BrandSeeder::class,
            FeatureSeeder::class,
            ProductSeeder::class,
            VariantSeeder::class,
            CartSeeder::class,
            OrderSeeder::class,
            DiscountSeeder::class,
            CouponSeeder::class,
            ShippingSeeder::class,
        ]);
    }
}
