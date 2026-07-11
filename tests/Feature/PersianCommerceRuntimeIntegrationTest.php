<?php

use Blog\Models\Article;
use Blog\Models\Category as BlogCategory;
use Ecommerce\Models\Category;
use Public\Enums\PostStatus;
use Theme\Builder\BlockRegistry;
use Theme\Database\Seeders\ThemeSeeder;
use Theme\Models\Theme;
use Theme\Models\ThemePage;
use Theme\Models\ThemeTemplate;

beforeEach(fn () => app(ThemeSeeder::class)->run());

it('seeds a complete same-theme Persian Commerce runtime idempotently', function () {
    $theme = Theme::query()->active()->sole();
    $types = ['header', 'footer', 'homepage', 'product', 'product_archive', 'product_category', 'blog_archive', 'article'];

    expect($theme->slug)->toBe('persian-commerce')
        ->and($theme->templates()->published()->whereIn('type', $types)->pluck('type')->all())->toContain(...$types)
        ->and(ThemeTemplate::query()->whereIn('type', $types)->where('theme_id', '!=', $theme->id)->exists())->toBeFalse()
        ->and(ThemePage::query()->published()->where('theme_id', $theme->id)->where('slug', 'home')->exists())->toBeTrue();

    $counts = [$theme->templates()->count(), $theme->pages()->count()];
    app(ThemeSeeder::class)->run();
    expect([$theme->templates()->count(), $theme->pages()->count()])->toBe($counts);
});

it('registers every recovered homepage commerce block', function () {
    $registered = array_keys(app(BlockRegistry::class)->all());
    expect($registered)->toContain(
        'hero_slider', 'promotion_banner_grid', 'product_carousel', 'featured_products',
        'discounted_products', 'category_product_section', 'category_grid', 'brand_carousel', 'blog_posts',
    );
});

it('renders the fresh seeded homepage with header content and footer', function () {
    $this->get('/')->assertOk()
        ->assertSee('data-theme-region="header"', false)
        ->assertSee('data-theme-block="hero_slider"', false)
        ->assertSee('data-theme-region="footer"', false);
});

it('resolves category and published article routes without exposing drafts', function () {
    $category = Category::query()->create(['name' => 'Published category', 'slug' => 'published-category']);
    $blogCategory = BlogCategory::query()->create(['name' => 'News', 'slug' => 'news']);
    $published = Article::query()->create(['name' => 'Published article', 'slug' => 'published-article', 'category_id' => $blogCategory->id, 'content' => [], 'status' => PostStatus::Published->name]);
    $draft = Article::query()->create(['name' => 'Draft article', 'slug' => 'draft-article', 'category_id' => $blogCategory->id, 'content' => [], 'status' => PostStatus::Draft->name]);

    $this->get(route('product-categories.show', $category))->assertOk();
    $this->get(route('articles.show', $published->slug))->assertOk();
    $this->get(route('articles.show', $draft->slug))->assertNotFound();
});
