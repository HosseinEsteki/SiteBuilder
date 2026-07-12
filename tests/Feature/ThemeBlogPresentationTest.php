<?php

use Blog\Models\Article;
use Blog\Models\Category;
use Public\Enums\PostStatus;
use Theme\Builder\BlockRegistry;
use Theme\Database\Seeders\ThemeSeeder;
use Theme\Models\Theme;

beforeEach(fn () => app(ThemeSeeder::class)->run());

function blogCategoryId(): int
{
    return Category::query()->create(['name' => 'خبر', 'slug' => 'news-'.uniqid()])->id;
}

it('registers the blog presentation blocks', function () {
    expect(array_keys(app(BlockRegistry::class)->all()))->toContain('blog_archive_grid', 'article_header', 'article_content', 'related_articles');
});

it('seeds archive and article templates with their presentation blocks', function () {
    $theme = Theme::query()->active()->sole();
    expect(collect($theme->templates()->where('type', 'blog_archive')->sole()->builder_data)->pluck('type')->all())->toBe(['blog_archive_grid'])
        ->and(collect($theme->templates()->where('type', 'article')->sole()->builder_data)->pluck('type')->all())->toBe(['article_header', 'article_content', 'related_articles']);
});

it('renders published archive articles but not drafts', function () {
    $categoryId = blogCategoryId();
    Article::query()->create(['name' => 'مقاله منتشر شده', 'slug' => 'published', 'category_id' => $categoryId, 'content' => [], 'status' => PostStatus::Published->name]);
    Article::query()->create(['name' => 'مقاله پیش نویس', 'slug' => 'draft', 'category_id' => $categoryId, 'content' => [], 'status' => PostStatus::Draft->name]);
    $this->get(route('articles.index'))->assertOk()->assertSee('مقاله منتشر شده')->assertDontSee('مقاله پیش نویس');
});

it('renders article title and approved content without optional metadata', function () {
    $article = Article::query()->create(['name' => 'عنوان مقاله', 'slug' => 'article-title', 'category_id' => blogCategoryId(), 'content' => ['blocks' => [['type' => 'paragraph', 'data' => ['text' => 'متن مقاله']]]], 'status' => PostStatus::Published->name]);
    $this->get(route('articles.show', $article->slug))->assertOk()->assertSee('عنوان مقاله')->assertSee('متن مقاله');
});

it('renders an empty archive safely', function () {
    $this->get(route('articles.index'))->assertOk()->assertSee('هنوز مقاله‌ای منتشر نشده است');
});

it('keeps the article API response contract unchanged', function () {
    $article = Article::query()->create(['name' => 'API article', 'slug' => 'api-article', 'category_id' => blogCategoryId(), 'content' => [], 'status' => PostStatus::Published->name]);
    $this->getJson('/api/blog/articles/'.$article->slug)->assertOk()->assertExactJson([
        'id' => $article->id, 'name' => 'API article', 'slug' => 'api-article',
        'status' => PostStatus::Published->value, 'category_id' => $article->category_id,
    ]);
});
