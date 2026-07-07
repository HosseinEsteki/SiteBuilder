<?php

namespace Seo\Console\Commands;

use Blog\Models\Article;
use Blog\Models\Category;
use Ecommerce\Models\Product;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'seo:generate-sitemap';
    protected $description = 'Generate the sitemap.xml file';

    public function handle(): void
    {
        $sitemap = Sitemap::create();

        // صفحات استاتیک
        $sitemap->add(Url::create(route('home'))->setPriority(1.0));
        $sitemap->add(Url::create(route('about'))->setPriority(0.8));
        $sitemap->add(Url::create(route('contact'))->setPriority(0.8));

        // مقالات داینامیک
        Article::all()->each(function ($article) use ($sitemap) {
            $sitemap->add(
                Url::create(route('articles.show', $article))
                    ->setLastModificationDate($article->updated_at)
                    ->setPriority(0.9)
            );
        });

        // محصولات داینامیک
        Product::all()->each(function ($product) use ($sitemap) {
            $sitemap->add(
                Url::create(route('products.show', $product))
                    ->setLastModificationDate($product->updated_at)
                    ->setPriority(0.9)
            );
        });

        // دسته‌بندی‌ها
        Category::all()->each(function ($category) use ($sitemap) {
            $sitemap->add(
                Url::create(route('categories.show', $category))
                    ->setLastModificationDate($category->updated_at)
                    ->setPriority(0.7)
            );
        });

        // ذخیره فایل
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('✅ Sitemap generated successfully at public/sitemap.xml');
    }
}
