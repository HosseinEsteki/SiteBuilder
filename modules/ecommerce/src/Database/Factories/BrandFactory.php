<?php


namespace Database\Factories\Ecommerce\Models;

use Ecommerce\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'slug' => $this->faker->unique()->slug(),
            'description'=>$this->faker->text(),
        ];
    }
}
