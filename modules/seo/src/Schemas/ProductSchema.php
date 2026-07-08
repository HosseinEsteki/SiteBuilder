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
            ->image($product->thumbnail_url ?: asset('default-product.jpg'))
            ->sku($product->sku ?? 'N/A')
            ->offers(
                Schema::offer()
                    ->price($product->sale_price ?? $product->price)
                    ->priceCurrency(config('money.defaultCurrency', 'IRR'))
                    ->availability('https://schema.org/InStock')
                    ->url(url('/ecommerce/products/'.$product->slug))
            )
            ->toScript();
    }
}
