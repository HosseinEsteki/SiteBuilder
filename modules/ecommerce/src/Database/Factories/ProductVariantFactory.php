<?php

namespace Database\Factories\Ecommerce\Models;
use Ecommerce\Models\Product;
use Ecommerce\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition()
    {
        return [
            'product_id' => Product::factory()->state(['is_variable' => true]),
            'price' => $this->faker->numberBetween(100000, 500000),
            'sale_price' => null,
            'stock' => $this->faker->numberBetween(1, 50),
            'sku' => strtoupper($this->faker->bothify('SKU-####')),
            'image' => null,
            'discount_id' => null,
        ];
    }

    /**
     * بعد از ساخت Variant، مقدارهای ویژگی را وصل می‌کنیم
     */
    public function configure()
    {
        return $this->afterCreating(function (ProductVariant $variant) {
            $options = \Ecommerce\Models\FeatureOption::inRandomOrder()->take(1)->get();

            $variant->options()->sync($options->pluck('id'));
        });
    }
}
