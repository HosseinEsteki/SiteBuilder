<?php

use Theme\DataProviders\BlogDataProvider;
use Theme\DataProviders\BrandDataProvider;
use Theme\DataProviders\CategoryDataProvider;
use Theme\DataProviders\ProductDataProvider;
use Theme\Services\ThemeBlockResolver;

it('returns bounded product data', function () {
    $data = app(ProductDataProvider::class)->provide(['limit' => 2]);
    expect($data)->toHaveKey('products')->and($data['products']->count())->toBeLessThanOrEqual(2);
});

it('returns category brand and blog collections', function () {
    expect(app(CategoryDataProvider::class)->provide())->toHaveKey('categories')
        ->and(app(BrandDataProvider::class)->provide())->toHaveKey('brands')
        ->and(app(BlogDataProvider::class)->provide())->toHaveKey('posts');
});

it('maps dynamic blocks to their providers', function () {
    $resolver = app(ThemeBlockResolver::class);
    expect($resolver->resolve('product_carousel'))->toHaveKey('products')
        ->and($resolver->resolve('category_grid'))->toHaveKey('categories')
        ->and($resolver->resolve('unknown'))->toBe([]);
});
