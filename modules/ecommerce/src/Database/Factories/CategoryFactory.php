<?php

namespace Database\Factories\Ecommerce\Models;

use Ecommerce\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name'        => $name=$this->faker->unique()->word(),
            'slug'        => Str::slug($name),
            'description' => $this->faker->sentence(),
            'keywords'    => $this->faker->shuffleArray(['این','اون','آن'])
        ];
    }
}
