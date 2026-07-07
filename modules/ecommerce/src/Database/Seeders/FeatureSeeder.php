<?php

namespace Ecommerce\Database\Seeders;
use Illuminate\Database\Seeder;
use Ecommerce\Models\Feature;
use Ecommerce\Models\FeatureOption;
use Illuminate\Support\Str;

class FeatureSeeder extends Seeder
{
    public function run(): void
    {
        // تعریف ویژگی‌ها و مقدارهایشان
        $featuresData = [
            'رنگ' => ['قرمز', 'آبی', 'سبز', 'مشکی', 'سفید'],
            'سایز' => ['XS', 'S', 'M', 'L', 'XL'],
            'گارانتی' => ['1 ماه', '3 ماه', '6 ماه', '12 ماه'],
        ];

        foreach ($featuresData as $featureName => $options) {
            // ساخت Feature
            $feature = Feature::create([
                'name' => $featureName,
                'slug' => Str::slug($featureName),
            ]);

            // ساخت FeatureOptionها
            foreach ($options as $optionValue) {
                FeatureOption::create([
                    'feature_id' => $feature->id,
                    'value' => $optionValue,
                    'slug' => Str::slug($optionValue),
                ]);
            }
        }
    }
}
