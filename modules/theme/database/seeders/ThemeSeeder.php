<?php

namespace Theme\Database\Seeders;

use Illuminate\Database\Seeder;
use LogicException;
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

        $this->template($theme, 'persian-commerce-header', 'Persian Commerce Header', 'header', [
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

        $homepage = $this->template($theme, 'persian-commerce-homepage', 'Persian Commerce Homepage', 'homepage', $homeBlocks);
        $this->template($theme, 'persian-commerce-product', 'Persian Commerce Product', 'product', [
            ['type' => 'product_breadcrumbs', 'settings' => ['show_category' => true]],
            ['type' => 'product_gallery', 'settings' => ['layout' => 'vertical', 'show_thumbnails' => true]],
            ['type' => 'product_summary', 'settings' => ['show_brand' => true, 'show_category' => true, 'show_stock' => true]],
            ['type' => 'product_price', 'settings' => ['show_price' => true]],
            ['type' => 'purchase_panel', 'settings' => ['show_stock' => true, 'button_text' => 'افزودن به سبد خرید']],
            ['type' => 'product_description', 'settings' => ['title' => 'توضیحات محصول']],
            ['type' => 'product_specifications', 'settings' => ['title' => 'مشخصات محصول', 'show_empty' => false]],
            ['type' => 'product_meta', 'settings' => ['title' => 'اطلاعات محصول']],
            ['type' => 'related_products', 'settings' => ['title' => 'محصولات مرتبط', 'limit' => 4, 'variant' => 'default']],
            ['type' => 'service_features', 'settings' => ['enabled' => true, 'features' => [
                ['icon' => '✓', 'title' => 'ضمانت اصالت کالا', 'description' => 'خرید مطمئن از فروشگاه'],
                ['icon' => '↺', 'title' => 'پشتیبانی خرید', 'description' => 'پاسخ‌گویی پیش و پس از خرید'],
            ]]],
        ]);
        $archiveBlocks = [
            ['type' => 'product_archive_header', 'settings' => ['show_description' => true, 'show_image' => true, 'show_result_count' => true, 'show_breadcrumbs' => true]],
            ['type' => 'archive_category_navigation', 'settings' => ['title' => 'دسته‌بندی محصولات', 'limit' => 12, 'columns' => 4]],
            ['type' => 'product_filters', 'settings' => ['enabled' => true]], ['type' => 'archive_toolbar', 'settings' => ['show_sorting' => true, 'show_result_count' => true]],
            ['type' => 'active_filters', 'settings' => []], ['type' => 'product_listing_grid', 'settings' => ['variant' => 'default', 'desktop_columns' => 4, 'tablet_columns' => 3, 'mobile_columns' => 2, 'show_button' => false, 'empty_title' => 'محصولی یافت نشد']],
            ['type' => 'service_features', 'settings' => ['enabled' => false, 'features' => []]],
        ];
        $this->template($theme, 'persian-commerce-product-archive', 'Product Archive', 'product_archive', $archiveBlocks);
        $this->template($theme, 'persian-commerce-product-category', 'Product Category', 'product_category', $archiveBlocks);
        $this->template($theme, 'persian-commerce-search-results', 'Persian Commerce Search Results', 'search_results', [
            ['type' => 'product_archive_header', 'settings' => ['show_description' => false, 'show_image' => false, 'show_result_count' => true, 'show_breadcrumbs' => true, 'variant' => 'compact']],
            ['type' => 'search_form', 'settings' => ['enabled' => true]],
            ['type' => 'product_filters', 'settings' => ['enabled' => true]],
            ['type' => 'archive_toolbar', 'settings' => ['show_sorting' => true, 'show_result_count' => true]],
            ['type' => 'active_filters', 'settings' => []],
            ['type' => 'product_listing_grid', 'settings' => ['variant' => 'default', 'desktop_columns' => 4, 'tablet_columns' => 3, 'mobile_columns' => 2, 'empty_title' => 'محصولی یافت نشد', 'empty_description' => 'عبارت دیگری را امتحان کنید.']],
            ['type' => 'service_features', 'settings' => ['enabled' => false, 'features' => []]],
        ]);
        $this->template($theme, 'persian-commerce-blog-archive', 'Blog Archive', 'blog_archive', [
            ['type' => 'blog_archive_grid', 'settings' => ['heading' => 'مجله', 'columns' => 3, 'image_ratio' => '16/9', 'articles_per_page' => 12]],
        ]);
        $this->template($theme, 'persian-commerce-article', 'Article', 'article', [
            ['type' => 'article_header', 'settings' => []],
            ['type' => 'article_content', 'settings' => []],
            ['type' => 'related_articles', 'settings' => ['limit' => 3]],
        ]);

        $foreignPage = ThemePage::query()->where('slug', 'home')->where('theme_id', '!=', $theme->id)->exists();
        throw_if($foreignPage, LogicException::class, 'The home page slug is already assigned to another theme.');

        ThemePage::query()->updateOrCreate(['theme_id' => $theme->id, 'slug' => 'home'], [
            'template_id' => $homepage->id, 'title' => 'خانه',
            'excerpt' => 'صفحه اصلی فروشگاه فارسی', 'builder_data' => $homeBlocks,
            'meta_title' => 'فروشگاه فارسی', 'meta_description' => 'صفحه اصلی فروشگاه فارسی',
            'status' => 'published', 'published_at' => now(),
        ]);
    }

    private function template(Theme $theme, string $slug, string $name, string $type, array $blocks): ThemeTemplate
    {
        $foreignTemplate = ThemeTemplate::query()->where('slug', $slug)->where('theme_id', '!=', $theme->id)->exists();
        throw_if($foreignTemplate, LogicException::class, "Template [{$slug}] is already assigned to another theme.");

        ThemeTemplate::query()
            ->where('theme_id', $theme->id)
            ->where('type', $type)
            ->where('slug', '!=', $slug)
            ->update(['is_default' => false]);

        return ThemeTemplate::query()->updateOrCreate(['theme_id' => $theme->id, 'slug' => $slug], [
            'name' => $name, 'type' => $type,
            'builder_data' => $blocks, 'status' => 'published', 'is_default' => true,
        ]);
    }
}
