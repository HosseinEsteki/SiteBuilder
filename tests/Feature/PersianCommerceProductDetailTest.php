<?php

use Ecommerce\Models\Product;
use Ecommerce\Models\Category;
use Public\Enums\PostStatus;
use Theme\Builder\BlockRegistry;
use Theme\Database\Seeders\ThemeSeeder;
use Theme\Models\Theme;
use Theme\Services\TemplateResolver;

beforeEach(fn () => app(ThemeSeeder::class)->run());

it('registers every supported product presentation block with an existing view', function () {
    $registry = app(BlockRegistry::class);

    foreach (['product_gallery', 'product_summary', 'product_description', 'product_specifications', 'related_products'] as $type) {
        $definition = $registry->get($type);

        expect($definition)->not->toBeNull()
            ->and(view()->exists($definition['view']))->toBeTrue();
    }
});

function detailProduct(array $attributes = []): Product
{
    $category = Category::query()->create(['name' => 'دسته آزمایشی', 'slug' => 'detail-category-'.str()->random(6)]);
    $product = new Product();
    $product->forceFill(array_merge([
        'name' => 'محصول جزئیات',
        'slug' => 'product-detail-fixture-'.str()->random(6),
        'content' => [],
        'status' => PostStatus::Published->name,
        'price' => 100000,
        'sale_price' => 80000,
        'stock' => 5,
        'is_variable' => false,
        'category_id' => $category->id,
    ], $attributes));
    $product->save();

    return $product;
}

it('seeds the published default product template idempotently', function () {
    $theme = Theme::query()->active()->sole();
    $template = app(TemplateResolver::class)->resolve($theme, 'product');

    expect($template)->not->toBeNull()
        ->and($template->theme_id)->toBe($theme->id)
        ->and($template->is_default)->toBeTrue()
        ->and(collect($template->builder_data)->pluck('type'))->toContain(
            'product_gallery',
            'product_summary',
            'product_description',
            'product_specifications',
            'related_products',
        );

    $count = $theme->templates()->where('type', 'product')->count();
    app(ThemeSeeder::class)->run();
    expect($theme->templates()->where('type', 'product')->count())->toBe($count);
});

it('renders a published product through the active theme with header and footer', function () {
    $product = detailProduct();

    $this->get(route('products.show', $product->slug))->assertOk()
        ->assertSee('data-theme-template="product"', false)
        ->assertSee('data-theme-region="header"', false)
        ->assertSee('data-theme-block="product_gallery"', false)
        ->assertSee('data-placeholder-image', false)
        ->assertSee('100,000')
        ->assertSee('80,000')
        ->assertSee('data-theme-region="footer"', false);
});

it('does not expose an unpublished product', function () {
    $product = detailProduct(['status' => PostStatus::Draft->name]);
    $this->get(route('products.show', $product->slug))->assertNotFound();
});

it('renders safely without optional relationships or related products', function () {
    $product = detailProduct(['brand_id' => null]);

    $this->get(route('products.show', $product->slug))->assertOk()
        ->assertSee('محصول مرتبطی یافت نشد')
        ->assertDontSee('data-product-id="'.$product->id.'" data-variant', false);
});

it('excludes the current product and renders related products with the shared card', function () {
    $product = detailProduct(['name' => 'محصول فعلی']);
    $related = detailProduct(['name' => 'محصول مرتبط']);

    $response = $this->get(route('products.show', $product->slug))->assertOk()
        ->assertSee('data-product-card', false)
        ->assertSee($related->name);

    expect(substr_count($response->getContent(), 'data-product-id="'.$product->id.'"'))->toBe(1);
});
