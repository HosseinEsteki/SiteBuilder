<?php

namespace Database\Factories\Ecommerce\Models;

use Ecommerce\Models\Product;
use Ecommerce\Models\Category;
use Ecommerce\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->words(3, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . Str::random(5),

            // خروجی EditorJS در ستون content ذخیره می‌شود
            'content' => [
                'time' => now()->timestamp,
                'blocks' => [
                    [
                        'id' => Str::random(10),
                        'type' => 'paragraph',
                        'data' => [
                            'text' => $this->faker->sentence(10),
                        ],
                    ],
                ],
                'version' => '2.30.6',
            ],

            // اگر محصول ساده باشد
            'price' => $this->faker->randomFloat(2, 10000, 500000),
            'stock' => $this->faker->numberBetween(0, 100),

            // محصول متغیر یا ساده
            'is_variable' => $this->faker->boolean(30), // 30% احتمال متغیر بودن

            // ارتباط با دسته و برند
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * حالت محصول متغیر
     */
    public function variable(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_variable' => true,
            'price' => null,
            'stock' => null,
        ]);
    }

    /**
     * حالت محصول ساده
     */
    public function simple(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_variable' => false,
        ]);
    }
}
