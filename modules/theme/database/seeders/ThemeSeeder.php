<?php

namespace Theme\Database\Seeders;

use Illuminate\Database\Seeder;
use Theme\Models\Theme;
use Theme\Models\ThemePage;
use Theme\Models\ThemeTemplate;

class ThemeSeeder extends Seeder
{
    public function run(): void
    {
        Theme::query()->update(['is_active' => false]);

        $theme = Theme::query()->updateOrCreate(['slug' => 'persian-commerce'], [
            'name' => 'Persian Commerce',
            'description' => 'RTL Persian commerce theme.',
            'is_active' => true,
            'settings' => ['direction' => 'rtl', 'primary_color' => '#ef4444', 'content_width' => '1280px'],
        ]);

        $header = $this->template($theme, 'persian-commerce-header', 'Persian Commerce Header', 'header', [
            ['type' => 'announcement_bar', 'settings' => ['text' => 'ارسال رایگان برای سفارش‌های منتخب']],
            ['type' => 'site_logo', 'settings' => []],
            ['type' => 'category_menu', 'settings' => []],
        ]);
        $this->template($theme, 'persian-commerce-footer', 'Persian Commerce Footer', 'footer', [
            ['type' => 'footer_brand', 'settings' => ['description' => 'فروشگاه فارسی']],
            ['type' => 'copyright', 'settings' => []],
        ]);

        $homeBlocks = [
            ['type' => 'hero_slider', 'settings' => ['height' => 520, 'overlay' => 35, 'slides' => [['title' => 'خرید هوشمند', 'subtitle' => 'بهترین کالاها در یک فروشگاه', 'button' => 'مشاهده محصولات', 'url' => '/shop']]]],
            ['type' => 'promotion_banner_grid', 'settings' => ['columns' => 2, 'banners' => [['title' => 'پیشنهاد ویژه', 'url' => '/shop']]]],
            ['type' => 'featured_products', 'settings' => ['title' => 'محصولات ویژه', 'limit' => 8]],
            ['type' => 'discounted_products', 'settings' => ['title' => 'تخفیف‌ها', 'limit' => 8]],
            ['type' => 'category_grid', 'settings' => ['title' => 'دسته‌بندی‌ها', 'limit' => 8]],
            ['type' => 'brand_carousel', 'settings' => ['title' => 'برندها', 'limit' => 12]],
            ['type' => 'blog_posts', 'settings' => ['title' => 'تازه‌های وبلاگ', 'limit' => 4]],
        ];

        $this->template($theme, 'persian-commerce-homepage', 'Persian Commerce Homepage', 'homepage', $homeBlocks);
        foreach ([
            'product' => 'Product', 'product_archive' => 'Product Archive',
            'product_category' => 'Product Category', 'blog_archive' => 'Blog Archive', 'article' => 'Article',
        ] as $type => $name) {
            $this->template($theme, 'persian-commerce-'.str_replace('_', '-', $type), $name, $type, []);
        }

        ThemePage::query()->updateOrCreate(['slug' => 'home'], [
            'theme_id' => $theme->id, 'template_id' => $header->id, 'title' => 'خانه',
            'excerpt' => 'صفحه اصلی فروشگاه فارسی', 'builder_data' => $homeBlocks,
            'meta_title' => 'فروشگاه فارسی', 'meta_description' => 'صفحه اصلی فروشگاه فارسی',
            'status' => 'published', 'published_at' => now(),
        ]);
    }

    private function template(Theme $theme, string $slug, string $name, string $type, array $blocks): ThemeTemplate
    {
        return ThemeTemplate::query()->updateOrCreate(['slug' => $slug], [
            'theme_id' => $theme->id, 'name' => $name, 'type' => $type,
            'builder_data' => $blocks, 'status' => 'published', 'is_default' => true,
        ]);
    }
}
