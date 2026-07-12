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

    public function resolve(string $type, array $settings = [], array $context = []): array
    {
        return match ($type) {
            'product_carousel', 'featured_products', 'latest_products', 'discounted_products', 'category_product_section' => $this->products->provide($settings),
            'category_grid', 'category_menu', 'mega_menu' => $this->categories->provide($settings),
            'brand_carousel' => $this->brands->provide($settings),
            'posts', 'blog_posts' => $this->posts->provide($settings),
            'blog_archive_grid' => $this->posts->archive($settings, $context),
            'article_header', 'article_content' => ['article' => $context['article'] ?? null],
            'related_articles' => $this->posts->related($settings, $context),
            'account_action', 'cart_action', 'mobile_header' => $this->header->provide($settings),
            'related_products' => isset($context['product']) ? $this->products->related($context['product'], $settings) : ['products' => collect()],
            'archive_breadcrumbs', 'archive_header', 'archive_toolbar', 'product_filters', 'active_filters', 'archive_product_grid', 'archive_pagination', 'archive_empty_state' => $context,
            'search_breadcrumbs', 'search_header', 'search_form', 'search_empty_state' => $context,
            'archive_category_navigation' => ['categories' => $context['categories'] ?? collect(), 'currentCategory' => $context['currentCategory'] ?? null],
            default => [],
        };
    }
}
