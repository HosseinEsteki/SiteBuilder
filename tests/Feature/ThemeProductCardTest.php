<?php

use Ecommerce\Models\Product;

function commerceProduct(array $attributes = []): Product {
    return (new Product())->forceFill(array_merge(['id' => 10, 'name' => 'محصول آزمایشی', 'price' => 100000, 'sale_price' => 80000, 'stock' => 3], $attributes));
}

it('renders product name price and cart action', function () {
    $html = view('theme::components.product-card', ['product' => commerceProduct()])->render();
    expect($html)->toContain('محصول آزمایشی')->toContain('80,000')->toContain('افزودن به سبد خرید');
});

it('renders discount percentage and old price', function () {
    $html = view('theme::components.product-card', ['product' => commerceProduct()])->render();
    expect($html)->toContain('20٪ تخفیف')->toContain('100,000');
});

it('disables cart action for unavailable products', function () {
    $html = view('theme::components.product-card', ['product' => commerceProduct(['stock' => 0])])->render();
    expect($html)->toContain('ناموجود')->toContain('disabled');
});

it('falls back when a product image is absent', function () {
    $html = view('theme::components.product-card', ['product' => commerceProduct()])->render();
    expect($html)->toContain('data-placeholder-image')->toContain('تصویر محصول موجود نیست');
});
