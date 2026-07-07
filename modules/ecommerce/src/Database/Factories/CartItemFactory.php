<?php

namespace Database\Factories\Ecommerce\Models;

use Ecommerce\Models\CartItem;
use Ecommerce\Models\Cart;
use Ecommerce\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartItemFactory extends Factory
{
    protected $model = CartItem::class;

    public function definition(): array
    {
        return [
            'cart_id'    => Cart::factory(),
            'product_id' => Product::factory(),
            'quantity'   => $this->faker->numberBetween(1, 5),
        ];
    }
}
