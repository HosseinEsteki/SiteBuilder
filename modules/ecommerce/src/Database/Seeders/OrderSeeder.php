<?php

namespace Ecommerce\Database\Seeders;

use Ecommerce\Enums\OrderStatus;
use Illuminate\Database\Seeder;
use Ecommerce\Models\Order;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory(50)
            ->hasItems(3)
            ->create();
    }
}
