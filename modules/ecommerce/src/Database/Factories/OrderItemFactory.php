<?php

namespace Database\Factories\Ecommerce\Models;

use Ecommerce\Models\OrderItem;
use Ecommerce\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        $product = Product::inRandomOrder()->first() ?? Product::factory()->create();
        $quantity = $this->faker->numberBetween(1, 5);

        return [
            'order_id' => null, // در Seeder یا رابطه پر میشه
            'product_id' => $product->id,
            'quantity' => $quantity,
            'price' => $product->price ?? $this->faker->randomFloat(2, 10000, 500000),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
