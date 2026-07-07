<?php

namespace Database\Factories\Ecommerce\Models;

use Ecommerce\Models\Coupon;
use Ecommerce\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition()
    {
        return [
            'code' => strtoupper($this->faker->unique()->bothify('COUPON-####')),
            'discount_id' => Discount::factory(), // اتصال به تخفیف
            'usage_limit' => $this->faker->numberBetween(5, 50),
            'used_count' => 0,
        ];
    }
}

