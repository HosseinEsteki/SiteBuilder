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
            ['type' => 'archive_breadcrumbs', 'settings' => []], ['type' => 'archive_header', 'settings' => ['title' => 'فروشگاه', 'show_description' => true, 'show_result_count' => true]],
            ['type' => 'archive_category_navigation', 'settings' => ['title' => 'دسته‌بندی محصولات', 'limit' => 12, 'columns' => 4]],
            ['type' => 'product_filters', 'settings' => ['enabled' => true]], ['type' => 'archive_toolbar', 'settings' => ['show_sorting' => true, 'show_result_count' => true]],
            ['type' => 'active_filters', 'settings' => []], ['type' => 'archive_product_grid', 'settings' => ['variant' => 'default', 'desktop_columns' => 4, 'tablet_columns' => 3, 'mobile_columns' => 2, 'show_button' => false]],
            ['type' => 'archive_empty_state', 'settings' => ['title' => 'محصولی یافت نشد', 'show_reset' => true]], ['type' => 'archive_pagination', 'settings' => ['enabled' => true]],
            ['type' => 'service_features', 'settings' => ['enabled' => false, 'features' => []]],
        ];
        $this->template($theme, 'persian-commerce-product-archive', 'Product Archive', 'product_archive', $archiveBlocks);
        $this->template($theme, 'persian-commerce-product-category', 'Product Category', 'product_category', $archiveBlocks);
        foreach (['blog_archive' => 'Blog Archive', 'article' => 'Article'] as $type => $name) $this->template($theme, 'persian-commerce-'.str_replace('_', '-', $type), $name, $type, []);

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
