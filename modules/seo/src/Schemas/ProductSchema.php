<?php

namespace Seo\Schemas;

use Spatie\SchemaOrg\Schema;

class ProductSchema
{
    public static function generate($product): string
    {
        return Schema::product()
            ->name($product->name)
            ->description($product->description)
            ->image($product->image_url ?? asset('default-product.jpg'))
            ->sku($product->sku ?? 'N/A')
            ->offers(
                Schema::offer()
                    ->price($product->price)
                    ->priceCurrency('USD')
                    ->availability('https://schema.org/InStock')
                    ->url(route('products.show', $product))
            )
            ->toScript();
    }
}
