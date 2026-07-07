<?php

namespace Database\Factories\Ecommerce\Models;

use App\Models\User;
use Ecommerce\Enums\OrderStatus;
use Ecommerce\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $status = $this->faker->randomElement(OrderStatus::values());
        $paymentRef = $this->faker->regexify('[A-Z0-9]{6}');
        if ($status == OrderStatus::Pending->value)
            $paymentRef = null;
        $originalTotal = $this->faker->numberBetween(200000, 2000000);
        $discount = $this->faker->numberBetween(0, 50000);
        $totalShipping = $this->faker->optional(weight: .8, default: 0)->numberBetween(0, 50000);
        $totalPrice = $originalTotal - $discount + $totalShipping;
        $user = User::factory();
        return [
            'user_id' => $user,
            'status' => $status,
            'original_total' => $originalTotal,
            'total_price' => $totalPrice,
            'discount' => $discount,
            'payment_ref' => $paymentRef,
            'total_shipping' => $totalShipping,
            'shipping_user' => $this->faker->name(),
            'shipping_address' => $this->faker->optional()->address,
            'shipping_code' => $this->faker->optional(.3)->regexify('[A-Z0-9]{12}'),
            'description' => $this->faker->optional()->realText,
            'created_at' => $this->faker->dateTimeBetween(now()->subMonths(3), now()),
        ];
    }

    public function paid(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => OrderStatus::Paid->value,
        ]);
    }

    public function cancelled(): static
    {
        return $this->state(fn(array $attributes) => [
            'status' => OrderStatus::Cancelled->value,
        ]);
    }
}
