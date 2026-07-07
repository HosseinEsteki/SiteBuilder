<?php

namespace Database\Factories\Ecommerce\Models;
use Ecommerce\Models\Feature;
use Ecommerce\Models\FeatureOption;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FeatureOptionFactory extends Factory
{
    protected $model = FeatureOption::class;

    public function definition()
    {
        $value = $this->faker->unique()->randomElement([
            'Red', 'Blue', 'Green', 'Black', 'White', 'XL', 'L', 'M'
        ]);

        return [
            'feature_id' => Feature::factory(),
            'value' => $value,
            'slug' => Str::slug($value),
        ];
    }
}

