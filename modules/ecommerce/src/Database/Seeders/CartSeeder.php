<?php

namespace Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Ecommerce\Models\Cart;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        Cart::factory()
            ->hasItems(3)
            ->create([
                'user_id' => 1,
            ]);
    }
}
