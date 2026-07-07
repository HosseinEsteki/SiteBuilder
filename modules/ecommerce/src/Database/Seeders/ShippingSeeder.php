<?php

namespace Ecommerce\Database\Seeders;

use Ecommerce\Models\Shipping;
use Illuminate\Database\Seeder;

class ShippingSeeder extends Seeder
{
    public function run(): void
    {
        $shippings = [
            [
                'name' => 'پست پیشتاز',
                'active' => true,
                'cost' => 100000,
                'description' => 'ارسال با پست پیشتاز',
            ],[
                'name' => 'تیپاکس',
                'active' => true,
                'cost' => 0,
                'description' => 'پرداخت هزینه حمل و نقل در محل',
            ],[
                'name' => 'ارسال رایگان',
                'active' => false,
                'cost' => 0,
                'description' => 'ارسال رایگان',
            ],
        ];
        foreach ($shippings as $shipping) {
            Shipping::create($shipping);
        }
    }
}
