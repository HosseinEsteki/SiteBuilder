<?php

use Ecommerce\Models\Category;
use Public\Enums\PostStatus;
use Theme\Models\Theme;
use Theme\Services\TemplateResolver;

beforeEach(fn () => $this->seed());

test('persian commerce archive templates are seeded and resolve as defaults', function () {
    $theme = Theme::where('slug', 'persian-commerce')->firstOrFail();
    foreach (['product_archive', 'product_category'] as $type) {
        $template = app(TemplateResolver::class)->resolve($theme, $type);
        expect($template)->not->toBeNull()->and($template->theme_id)->toBe($theme->id)->and($template->is_default)->toBeTrue();
    }
});

test('shop and published category render shared product cards inside theme chrome', function () {
    $category = Category::published()->firstOrFail();
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
    $draft = $category->products()->firstOrFail();
    $draft->update(['status' => PostStatus::Draft->name, 'name' => 'DRAFT-HIDDEN-PRODUCT']);
    $this->get(route('theme.shop', ['category' => $category->slug, 'sort' => 'price_asc']))
        ->assertOk()->assertDontSee('DRAFT-HIDDEN-PRODUCT')->assertSee('name="sort"', false);
});

test('empty published category renders safely', function () {
    $category = Category::create(['name' => 'دسته خالی', 'slug' => 'empty-category', 'description' => null, 'is_published' => true]);
    $this->get(route('product-categories.show', $category))->assertOk()->assertSee('محصولی یافت نشد');
});
