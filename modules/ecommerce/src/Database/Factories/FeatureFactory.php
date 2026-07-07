<?php

namespace Database\Factories\Ecommerce\Models;

use Ecommerce\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FeatureFactory extends Factory
{
    protected $model = Feature::class;

    public function definition()
    {
        $name = $this->faker->unique()->randomElement([
            'Color', 'Size', 'Material', 'Style'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
