<?php

use Ecommerce\Models\Category;
use Ecommerce\Models\Product;
use Public\Enums\PostStatus;
use Theme\Models\Theme;
use Theme\Builder\BlockRegistry;
use Theme\Services\TemplateResolver;

beforeEach(fn () => $this->seed());

test('reusable product discovery blocks are registered with views', function () {
    foreach (['product_archive_header', 'product_listing_grid'] as $type) {
        $definition = app(BlockRegistry::class)->get($type);
        expect($definition)->not->toBeNull()->and(view()->exists($definition['view']))->toBeTrue();
    }
});

test('persian commerce archive templates are seeded and resolve as defaults', function () {
    $theme = Theme::where('slug', 'persian-commerce')->firstOrFail();
    foreach (['product_archive', 'product_category'] as $type) {
        $template = app(TemplateResolver::class)->resolve($theme, $type);
        expect($template)->not->toBeNull()->and($template->theme_id)->toBe($theme->id)->and($template->is_default)->toBeTrue()
            ->and(collect($template->builder_data)->pluck('type'))->toContain('product_archive_header', 'product_listing_grid');
    }
});

test('shop and published category render shared product cards inside theme chrome', function () {
    $category = Category::published()->firstOrFail();
    Product::factory()->create(['category_id' => $category->id, 'status' => PostStatus::Published->name]);
    $this->get(route('theme.shop'))->assertOk()->assertSee('data-product-card', false)->assertSee('<header', false)->assertSee('<footer', false);
    $this->get(route('product-categories.show', $category))->assertOk()->assertSee($category->name);
});

test('unpublished category is hidden', function () {
    $category = Category::published()->firstOrFail();
    $category->update(['is_published' => false]);
    $this->get(route('product-categories.show', $category))->assertNotFound();
});

test('archive excludes drafts and preserves filter query pagination', function () {
    $category = Category::published()->firstOrFail();
    $draft = Product::factory()->create(['category_id' => $category->id, 'status' => PostStatus::Draft->name, 'name' => 'DRAFT-HIDDEN-PRODUCT']);
    $this->get(route('theme.shop', ['category' => $category->slug, 'sort' => 'price_asc']))
        ->assertOk()->assertDontSee('DRAFT-HIDDEN-PRODUCT')->assertSee('name="sort"', false);
});

test('empty published category renders safely', function () {
    $category = Category::create(['name' => 'دسته خالی', 'slug' => 'empty-category', 'description' => null, 'is_published' => true]);
    $this->get(route('product-categories.show', $category))->assertOk()->assertSee('محصولی یافت نشد');
});

test('category excludes unrelated products and listing renders pagination', function () {
    $category = Category::published()->firstOrFail();
    $other = Category::published()->whereKeyNot($category->getKey())->firstOrFail();
    Product::factory()->count(13)->create(['category_id' => $category->id, 'status' => PostStatus::Published->name, 'brand_id' => null]);
    Product::factory()->create(['category_id' => $other->id, 'status' => PostStatus::Published->name, 'brand_id' => null, 'name' => 'UNRELATED-PRODUCT']);

    $this->get(route('product-categories.show', $category))->assertOk()
        ->assertDontSee('UNRELATED-PRODUCT')->assertSee('aria-label="صفحه‌بندی محصولات"', false);
});
