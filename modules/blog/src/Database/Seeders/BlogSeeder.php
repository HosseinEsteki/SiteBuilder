<?php

namespace Blog\Database\Seeders;

use Blog\Models\Article;
use Blog\Models\Category;
use Blog\Models\Comment;
use Cviebrock\EloquentSluggable\Tests\Models\Post;
use Illuminate\Database\Seeder;
use Public\Enums\PostStatus;
use Spatie\Tags\Tag;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // ایجاد دسته‌بندی‌ها
        $categories = [
            ['name' => 'کفش اسپرت', 'slug' => 'اسپرت', 'keywords' => ['کفش بچگانه', 'کفش پا کوتاه'], 'description' => 'این کفشای اسپرت خیلی خوبن'],
            ['name' => 'کفش کتان', 'slug' => 'کتان', 'keywords' => ['کفش بچگانه کتان', 'کفش پاگنده'], 'description' => 'خبر از کفشای  درجه یک نداری'],
            ['name' => 'کفش سالن', 'slug' => 'سالن', 'keywords' => ['کفش بچگانه سالن', 'کفش پاکوچول'], 'description' => 'این کفشا مال چمن نیستن عزیز جان'],
        ];

        foreach ($categories as $cat) {
            Category::firstOrCreate($cat);
        }

        // ایجاد تگ‌ها
        $tags = ['Framework', 'Backend', 'Clean Code', 'Deployment'];
        foreach ($tags as $tagName) {
            Tag::findOrCreate($tagName);
        }

        // ایجاد مقالات نمونه
        $articles = [
            [
                'name' => 'شروع کار با Laravel 12',
                'content' => ['این مقاله به معرفی ویژگی‌های جدید لاراول 12 می‌پردازد...'],
                'slug' => 'getting-started-laravel-12',
                'category_id' => Category::query()->first()->id,
                'description' => 'میدونستی لاراول چقدر خفنه؟',
                'keywords' => ['asp.net', 'laravel', 'symfony'],
                'status' => PostStatus::Published->name,
                'tags' => ['Laravel', 'Framework'],
            ],
            [
                'name' => 'بهترین روش‌های کدنویسی در PHP',
                'content' => json_encode('در این مقاله به اصول Clean Code در PHP اشاره می‌کنیم...'),
                'description' => 'صلا این پی اچ پی که میگن چیه؟',
                'keywords' => ['php', 'laravel', 'symfony'],
                'slug' => 'php-clean-code',
                'category_id' => Category::query()->latest()->first()->id,
                'status' => PostStatus::Archived->name,
                'tags' => ['PHP', 'Clean Code'],
            ],
        ];

        foreach ($articles as $articleData) {
            $article = Article::firstOrCreate(
                ['slug' => $articleData['slug']],
                $articleData
            );

            // اتصال تگ‌ها به مقاله
            if (! empty($articleData['tags'])) {
                $article->attachTags($articleData['tags']);
            }
        }

        // ایجاد کامنت نمونه
        $article = Article::where('slug', 'getting-started-laravel-12')->first();
        if ($article) {
            Comment::firstOrCreate([
                'article_id' => $article->id,
                'subject'=>'محشره',
                'comment' => 'خیلی مقاله خوبی بود! ممنون.',
            ]);
        }
    }
}
