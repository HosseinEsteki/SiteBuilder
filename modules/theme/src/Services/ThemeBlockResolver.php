<?php

namespace Theme\Services;

use Theme\DataProviders\BlogDataProvider;
use Theme\DataProviders\BrandDataProvider;
use Theme\DataProviders\CategoryDataProvider;
use Theme\DataProviders\HeaderDataProvider;
use Theme\DataProviders\ProductDataProvider;

class ThemeBlockResolver
{
    public function __construct(
        private readonly ProductDataProvider $products,
        private readonly CategoryDataProvider $categories,
        private readonly BrandDataProvider $brands,
        private readonly BlogDataProvider $posts,
        private readonly HeaderDataProvider $header,
    ) {
    }

    public function resolve(string $type, array $settings = []): array
    {
        return match ($type) {
            'product_carousel', 'featured_products', 'latest_products', 'discounted_products', 'category_product_section' => $this->products->provide($settings),
            'category_grid', 'category_menu', 'mega_menu' => $this->categories->provide($settings),
            'brand_carousel' => $this->brands->provide($settings),
            'posts', 'blog_posts' => $this->posts->provide($settings),
            'account_action', 'cart_action', 'mobile_header' => $this->header->provide($settings),
            default => [],
        };
    }
}
