<?php

namespace Database\Factories\Ecommerce\Models;


use DateInterval;
use Ecommerce\Enums\DiscountType;
use Ecommerce\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    protected $model = Discount::class;

    public function definition()
    {
        $type=$this->faker->randomElement(DiscountType::getValues());
        if($type==DiscountType::Percentage->value)
            $value=null;
        else
            $value=$this->faker->randomFloat(2, 5, 50); // درصد یا مبلغ
        $startDate=\Illuminate\Support\now()->subDays($this->faker->numberBetween(0, 30));
        $endDate=$startDate->addDays($this->faker->numberBetween(10,60));
        $active=true;
        if($endDate<\Illuminate\Support\now())
            $active=false;
        return [
            'title' => $this->faker->sentence(3),
            'type' => $type,
            'value' => $value,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'usage_limit' => $this->faker->numberBetween(10, 100),
            'used_count' => 0,
            'active' => $active,
            'conditions' => json_encode([
                'min_total' => $this->faker->numberBetween(100000, 500000),
                'min_items' => $this->faker->numberBetween(1, 5),
            ]),
        ];
    }
}
