<?php

use Illuminate\Support\Collection;

it('renders hero slider settings and responsive image', function () {
    $html = view('theme::blocks.hero-slider', ['settings' => ['height' => 520, 'overlay' => 35, 'slides' => [['title' => 'خرید هوشمند', 'subtitle' => 'بهترین کالاها', 'desktop_image' => 'hero.jpg', 'mobile_image' => 'hero-mobile.jpg', 'button' => 'مشاهده']]]])->render();
    expect($html)->toContain('--hero-height:520px')->toContain('--hero-overlay:0.35')->toContain('hero-mobile.jpg')->toContain('خرید هوشمند');
});

it('renders promotion banners with configured columns', function () {
    $html = view('theme::blocks.promotion-banner-grid', ['settings' => ['columns' => 2, 'banners' => [['title' => 'پیشنهاد ویژه', 'url' => '/offer']]]])->render();
    expect($html)->toContain('--promotion-columns:2')->toContain('پیشنهاد ویژه')->toContain('/offer');
});

it('renders empty dynamic homepage states', function () {
    $products = view('theme::blocks.product-carousel', ['definition' => ['type' => 'product_carousel'], 'settings' => [], 'products' => collect()])->render();
    $categories = view('theme::blocks.category-grid', ['settings' => [], 'categories' => collect()])->render();
    expect($products)->toContain('No products available.')->and($categories)->toContain('دسته‌بندی‌ای یافت نشد');
});

it('renders brand carousel without database queries in the view', function () {
    $html = view('theme::blocks.brand-carousel', ['settings' => ['title' => 'برندها'], 'brands' => new Collection()])->render();
    expect($html)->toContain('برندها')->toContain('برندی برای نمایش وجود ندارد');
});
