<?php

namespace Tests\Feature;

use ActivityLog\Facades\ActivityLog as ActivityLogFacade;
use ActivityLog\Models\ActivityLog;
use App\Models\User;
use Blog\Models\Article;
use Blog\Models\Category as BlogCategory;
use Ecommerce\Models\Order;
use Ecommerce\Models\Product;
use Email\Mail\OrderCreatedMail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Public\Enums\PostStatus;
use Seo\Schemas\ArticleSchema;
use Seo\Schemas\ProductSchema;
use Tests\TestCase;

class SeoEmailActivityLogTest extends TestCase
{
    use RefreshDatabase;

    public function test_seo_schemas_use_existing_public_urls(): void
    {
        $category = BlogCategory::create([
            'name' => 'News',
            'slug' => 'news',
            'description' => 'News category',
        ]);

        $article = Article::create([
            'name' => 'First Article',
            'slug' => 'first-article',
            'status' => PostStatus::Draft->name,
            'content' => ['blocks' => []],
            'category_id' => $category->id,
            'description' => 'Article description',
            'keywords' => ['laravel'],
        ]);

        $product = Product::factory()->create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'price' => 250000,
            'sale_price' => 200000,
        ]);

        $this->assertStringContainsString('/blog/articles/first-article', ArticleSchema::generate($article));
        $this->assertStringContainsString('/ecommerce/products/test-product', ProductSchema::generate($product));
    }

    public function test_order_created_email_is_queued_from_route(): void
    {
        Mail::fake();

        $user = User::factory()->create();
        Order::factory()->create(['user_id' => $user->id]);

        $this->post('/send-test-email')
            ->assertOk()
            ->assertJsonPath('message', 'Test email queued.');

        Mail::assertQueued(OrderCreatedMail::class);
    }

    public function test_activity_log_filters_and_stats_include_latest_logs(): void
    {
        ActivityLog::create([
            'model' => User::class,
            'action' => 'create',
            'model_id' => 10,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Feature Test',
        ]);

        ActivityLog::create([
            'model' => Order::class,
            'action' => 'update',
            'model_id' => 20,
            'ip_address' => '127.0.0.2',
            'user_agent' => 'Feature Test',
        ]);

        $logs = ActivityLogFacade::all([
            'model' => Order::class,
            'model_id' => 20,
            'limit' => 10,
        ]);

        $stats = ActivityLogFacade::stats();

        $this->assertCount(1, $logs);
        $this->assertSame(Order::class, $logs->first()->model);
        $this->assertSame(2, $stats['total']);
        $this->assertArrayHasKey('latest', $stats);
        $this->assertCount(2, $stats['latest']);
    }
}
