<?php

use Ecommerce\Models\Product;
use Public\Enums\PostStatus;
use Theme\Models\Theme;
use Theme\Services\TemplateResolver;

beforeEach(fn () => $this->seed());

test('search route and seeded theme template render through theme chrome', function () {
    $theme = Theme::where('slug', 'persian-commerce')->firstOrFail();
    $template = app(TemplateResolver::class)->resolve($theme, 'search_results');

    expect($template)->not->toBeNull()->and($template->theme_id)->toBe($theme->id)->and($template->is_default)->toBeTrue();
    $this->get(route('theme.product-search'))->assertOk()->assertSee('data-theme-template="search_results"', false)
        ->assertSee('<header', false)->assertSee('<footer', false)->assertSee('چه محصولی می‌خواهید؟');
});

test('search shows published match through shared card and excludes draft', function () {
    $published = Product::factory()->create(['name' => 'SEARCHABLE-PUBLISHED', 'slug' => 'searchable-published', 'status' => PostStatus::Published->name, 'category_id' => null, 'brand_id' => null]);
    $draft = $published->replicate();
    $draft->name = 'PRIVATE-SEARCH-NEEDLE'; $draft->slug = 'private-search-needle'; $draft->status = PostStatus::Draft->name; $draft->save();

    $this->get(route('theme.product-search', ['q' => $published->name]))->assertOk()->assertSee($published->name)->assertSee('data-product-card', false);
    $this->get(route('theme.product-search', ['q' => 'PRIVATE-SEARCH-NEEDLE']))->assertOk()->assertDontSee('PRIVATE-SEARCH-NEEDLE')->assertSee('محصولی یافت نشد');
});

test('search escapes query and preserves query across sorting and filtering', function () {
    $value = '<script>alert(1)</script>';
    $this->get(route('theme.product-search', ['q' => $value, 'sort' => 'price_asc', 'availability' => 'in_stock']))
        ->assertOk()->assertDontSee($value, false)->assertSee(e($value), false)
        ->assertSee('name="q"', false)->assertSee('name="sort"', false)->assertSee('name="availability"', false);
});

test('theme seeding search template is idempotent', function () {
    $this->seed(Theme\Database\Seeders\ThemeSeeder::class);
    expect(Theme::where('slug', 'persian-commerce')->firstOrFail()->templates()->where('type', 'search_results')->count())->toBe(1);
});
