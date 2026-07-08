<?php

namespace Seo\Console\Commands;

use Blog\Models\Article;
use Ecommerce\Models\Category;
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
        $sitemap = Sitemap::create()
            ->add(Url::create(url('/'))->setPriority(1.0))
            ->add(Url::create(url('/blog/articles'))->setPriority(0.8))
            ->add(Url::create(url('/blog/categories'))->setPriority(0.7))
            ->add(Url::create(url('/ecommerce/products'))->setPriority(0.8))
            ->add(Url::create(url('/ecommerce/categories'))->setPriority(0.7));

        Article::query()->each(function (Article $article) use ($sitemap) {
            $sitemap->add(
                Url::create(url('/blog/articles/'.$article->slug))
                    ->setLastModificationDate($article->updated_at)
                    ->setPriority(0.9)
            );
        });

        Product::query()->each(function (Product $product) use ($sitemap) {
            $sitemap->add(
                Url::create(url('/ecommerce/products/'.$product->slug))
                    ->setLastModificationDate($product->updated_at)
                    ->setPriority(0.9)
            );
        });

        Category::query()->each(function (Category $category) use ($sitemap) {
            $sitemap->add(
                Url::create(url('/ecommerce/categories/'.$category->slug))
                    ->setLastModificationDate($category->updated_at)
                    ->setPriority(0.7)
            );
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully at public/sitemap.xml');
    }
}
