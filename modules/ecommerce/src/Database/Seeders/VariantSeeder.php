<?php

namespace Ecommerce\Database\Seeders;

use Illuminate\Database\Seeder;
use Ecommerce\Models\Product;
use Ecommerce\Models\ProductVariant;

class VariantSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::where('is_variable', true)->get();

        foreach ($products as $product) {
            for ($i = 0; $i < 3; $i++) {
                $variant = ProductVariant::factory()->create([
                    'product_id' => $product->id,
                ]);

                if ($product->featureOptions->count() > 0) {
                    $variant->options()->sync(
                        $product->featureOptions->random(2)->pluck('id')
                    );
                }
            }
        }
    }
}
