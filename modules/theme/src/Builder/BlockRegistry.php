<?php

namespace Theme\Builder;

class BlockRegistry
{
    public function all(): array
    {
        return [
            'section' => [
                'type' => 'section',
                'label' => 'Section',
                'view' => 'theme::blocks.section',
                'settings' => [
                    'background_color' => '#ffffff',
                    'padding_top' => 64,
                    'padding_bottom' => 64,
                    'container_width' => 'lg',
                ],
                'rules' => [
                    'background_color' => 'nullable|string',
                    'padding_top' => 'nullable|integer|min:0|max:240',
                    'padding_bottom' => 'nullable|integer|min:0|max:240',
                    'container_width' => 'nullable|string',
                ],
            ],
            'container' => [
                'type' => 'container',
                'label' => 'Container',
                'view' => 'theme::blocks.container',
                'settings' => [
                    'width' => 'lg',
                ],
            ],
            'columns' => [
                'type' => 'columns',
                'label' => 'Columns',
                'view' => 'theme::blocks.columns',
                'settings' => [
                    'columns' => 2,
                    'gap' => 24,
                ],
            ],
            'heading' => [
                'type' => 'heading',
                'label' => 'Heading',
                'view' => 'theme::blocks.heading',
                'settings' => [
                    'text' => 'Heading',
                    'level' => 'h2',
                    'align' => 'left',
                ],
                'rules' => [
                    'text' => 'nullable|string',
                    'level' => 'nullable|in:h1,h2,h3,h4,h5,h6',
                    'align' => 'nullable|in:left,center,right',
                ],
            ],
            'text' => [
                'type' => 'text',
                'label' => 'Text',
                'view' => 'theme::blocks.text',
                'settings' => [
                    'text' => 'Add your text here.',
                    'align' => 'left',
                ],
            ],
            'image' => [
                'type' => 'image',
                'label' => 'Image',
                'view' => 'theme::blocks.image',
                'settings' => [
                    'src' => '',
                    'alt' => '',
                    'caption' => '',
                ],
            ],
            'button' => [
                'type' => 'button',
                'label' => 'Button',
                'view' => 'theme::blocks.button',
                'settings' => [
                    'text' => 'Learn more',
                    'url' => '#',
                    'align' => 'left',
                    'style' => 'primary',
                ],
            ],
            'spacer' => [
                'type' => 'spacer',
                'label' => 'Spacer',
                'view' => 'theme::blocks.spacer',
                'settings' => [
                    'height' => 32,
                ],
            ],
            'hero' => [
                'type' => 'hero',
                'label' => 'Hero',
                'view' => 'theme::blocks.hero',
                'settings' => [
                    'eyebrow' => '',
                    'title' => 'Welcome to SiteBuilder',
                    'subtitle' => '',
                    'button_text' => '',
                    'button_url' => '#',
                    'background_color' => '#f8fafc',
                ],
            ],
            'card' => [
                'type' => 'card',
                'label' => 'Card',
                'view' => 'theme::blocks.card',
                'settings' => [
                    'title' => 'Card title',
                    'text' => 'Card content',
                    'url' => '',
                ],
            ],
            'html' => [
                'type' => 'html',
                'label' => 'HTML',
                'view' => 'theme::blocks.html',
                'settings' => [
                    'html' => '',
                ],
                'rules' => [
                    'html' => 'nullable|string',
                ],
            ],
            'hero_slider' => ['type' => 'hero_slider', 'label' => 'Hero Slider', 'view' => 'theme::blocks.hero-slider', 'settings' => ['height' => 520, 'overlay' => 35, 'slides' => []]],
            'promotion_banner_grid' => ['type' => 'promotion_banner_grid', 'label' => 'Promotion Banners', 'view' => 'theme::blocks.promotion-banner-grid', 'settings' => ['columns' => 2, 'banners' => []]],
            'product_carousel' => ['type' => 'product_carousel', 'label' => 'Product Carousel', 'view' => 'theme::blocks.product-carousel', 'settings' => ['limit' => 8]],
            'featured_products' => ['type' => 'featured_products', 'label' => 'Featured Products', 'view' => 'theme::blocks.product-carousel', 'settings' => ['limit' => 8]],
            'discounted_products' => ['type' => 'discounted_products', 'label' => 'Discounted Products', 'view' => 'theme::blocks.product-carousel', 'settings' => ['limit' => 8]],
            'category_product_section' => ['type' => 'category_product_section', 'label' => 'Category Products', 'view' => 'theme::blocks.product-carousel', 'settings' => ['limit' => 8]],
            'category_grid' => ['type' => 'category_grid', 'label' => 'Category Grid', 'view' => 'theme::blocks.category-grid', 'settings' => ['limit' => 8, 'columns' => 4]],
            'brand_carousel' => ['type' => 'brand_carousel', 'label' => 'Brand Carousel', 'view' => 'theme::blocks.brand-carousel', 'settings' => ['limit' => 12]],
            'blog_posts' => ['type' => 'blog_posts', 'label' => 'Blog Posts', 'view' => 'theme::blocks.posts', 'settings' => ['limit' => 4]],
            'blog_archive_grid' => ['type' => 'blog_archive_grid', 'label' => 'Blog archive grid', 'view' => 'theme::blocks.blog-archive-grid', 'settings' => ['heading' => 'مجله', 'description' => '', 'show_excerpt' => true, 'show_category' => true, 'show_date' => true, 'show_image' => true, 'columns' => 3, 'image_ratio' => '16/9', 'articles_per_page' => 12]],
            'article_header' => ['type' => 'article_header', 'label' => 'Article header', 'view' => 'theme::blocks.article-header', 'settings' => ['show_category' => true, 'show_date' => true, 'show_author' => true, 'show_image' => true]],
            'article_content' => ['type' => 'article_content', 'label' => 'Article content', 'view' => 'theme::blocks.article-content', 'settings' => []],
            'related_articles' => ['type' => 'related_articles', 'label' => 'Related articles', 'view' => 'theme::blocks.related-articles', 'settings' => ['heading' => 'مقاله‌های مرتبط', 'show_excerpt' => false, 'show_category' => true, 'show_date' => true, 'show_image' => true, 'columns' => 3, 'image_ratio' => '16/9', 'limit' => 3]],
            'announcement_bar' => ['type' => 'announcement_bar', 'label' => 'Announcement Bar', 'view' => 'theme::blocks.announcement-bar', 'settings' => ['enabled' => true, 'text' => '', 'url' => '', 'background_color' => '#111827', 'text_color' => '#ffffff']],
            'site_logo' => ['type' => 'site_logo', 'label' => 'Site Logo', 'view' => 'theme::blocks.site-logo', 'settings' => ['desktop_logo' => '', 'mobile_logo' => '', 'width' => 160]],
            'category_menu' => ['type' => 'category_menu', 'label' => 'Category Menu', 'view' => 'theme::blocks.category-menu', 'settings' => ['limit' => 8]],
            'footer_brand' => ['type' => 'footer_brand', 'label' => 'Footer Brand', 'view' => 'theme::blocks.footer-brand', 'settings' => ['name' => '', 'description' => '', 'logo' => '']],
            'copyright' => ['type' => 'copyright', 'label' => 'Copyright', 'view' => 'theme::blocks.copyright', 'settings' => ['text' => 'SiteBuilder']],
            'product_breadcrumbs' => ['type' => 'product_breadcrumbs', 'label' => 'Product Breadcrumbs', 'view' => 'theme::blocks.product-breadcrumbs', 'settings' => ['show_category' => true]],
            'product_gallery' => ['type' => 'product_gallery', 'label' => 'Product Gallery', 'view' => 'theme::blocks.product-gallery', 'settings' => ['layout' => 'vertical', 'show_thumbnails' => true]],
            'product_summary' => ['type' => 'product_summary', 'label' => 'Product Summary', 'view' => 'theme::blocks.product-summary', 'settings' => ['show_brand' => true, 'show_category' => true, 'show_stock' => true]],
            'product_price' => ['type' => 'product_price', 'label' => 'Product Price', 'view' => 'theme::blocks.product-price', 'settings' => ['show_price' => true]],
            'purchase_panel' => ['type' => 'purchase_panel', 'label' => 'Purchase Panel', 'view' => 'theme::blocks.purchase-panel', 'settings' => ['show_stock' => true, 'button_text' => 'افزودن به سبد خرید']],
            'product_description' => ['type' => 'product_description', 'label' => 'Product Description', 'view' => 'theme::blocks.product-description', 'settings' => ['title' => 'توضیحات محصول']],
            'product_specifications' => ['type' => 'product_specifications', 'label' => 'Product Specifications', 'view' => 'theme::blocks.product-specifications', 'settings' => ['title' => 'مشخصات محصول', 'show_empty' => false]],
            'product_meta' => ['type' => 'product_meta', 'label' => 'Product Meta', 'view' => 'theme::blocks.product-meta', 'settings' => ['title' => 'اطلاعات محصول']],
            'related_products' => ['type' => 'related_products', 'label' => 'Related Products', 'view' => 'theme::blocks.related-products', 'settings' => ['title' => 'محصولات مرتبط', 'limit' => 4, 'variant' => 'default']],
            'service_features' => ['type' => 'service_features', 'label' => 'Service Features', 'view' => 'theme::blocks.service-features', 'settings' => ['enabled' => true, 'features' => []]],
            'archive_breadcrumbs' => ['type' => 'archive_breadcrumbs', 'label' => 'Archive breadcrumbs', 'view' => 'theme::blocks.archive-breadcrumbs', 'settings' => []],
            'archive_header' => ['type' => 'archive_header', 'label' => 'Archive header', 'view' => 'theme::blocks.archive-header', 'settings' => ['title' => 'فروشگاه', 'description' => '', 'show_description' => true, 'show_result_count' => true, 'banner_image' => '']],
            'archive_category_navigation' => ['type' => 'archive_category_navigation', 'label' => 'Category navigation', 'view' => 'theme::blocks.archive-category-navigation', 'settings' => ['title' => 'دسته‌بندی‌ها', 'limit' => 12, 'columns' => 4, 'show_image' => true, 'show_count' => true]],
            'product_filters' => ['type' => 'product_filters', 'label' => 'Product filters', 'view' => 'theme::blocks.product-filters', 'settings' => ['enabled' => true]],
            'archive_toolbar' => ['type' => 'archive_toolbar', 'label' => 'Archive sorting', 'view' => 'theme::blocks.archive-toolbar', 'settings' => ['show_sorting' => true, 'show_result_count' => true]],
            'active_filters' => ['type' => 'active_filters', 'label' => 'Active filters', 'view' => 'theme::blocks.active-filters', 'settings' => []],
            'archive_product_grid' => ['type' => 'archive_product_grid', 'label' => 'Product grid', 'view' => 'theme::blocks.archive-product-grid', 'settings' => ['variant' => 'default', 'desktop_columns' => 4, 'tablet_columns' => 3, 'mobile_columns' => 2, 'show_image' => true, 'show_brand' => true, 'show_discount' => true, 'show_stock' => true, 'show_button' => false]],
            'archive_pagination' => ['type' => 'archive_pagination', 'label' => 'Pagination', 'view' => 'theme::blocks.archive-pagination', 'settings' => ['enabled' => true]],
            'archive_empty_state' => ['type' => 'archive_empty_state', 'label' => 'Empty state', 'view' => 'theme::blocks.archive-empty-state', 'settings' => ['title' => 'محصولی یافت نشد', 'description' => 'فیلترها را تغییر دهید یا دوباره تلاش کنید.', 'show_reset' => true]],
            'search_breadcrumbs' => ['type' => 'search_breadcrumbs', 'label' => 'Search breadcrumbs', 'view' => 'theme::blocks.search-breadcrumbs', 'settings' => []],
            'search_header' => ['type' => 'search_header', 'label' => 'Search header', 'view' => 'theme::blocks.search-header', 'settings' => ['title' => 'نتایج جستجو', 'description' => '', 'show_header' => true, 'show_result_count' => true]],
            'search_form' => ['type' => 'search_form', 'label' => 'Search form', 'view' => 'theme::blocks.search-form', 'settings' => ['enabled' => true, 'label' => 'جستجوی محصولات', 'placeholder' => 'نام محصول را وارد کنید']],
            'search_empty_state' => ['type' => 'search_empty_state', 'label' => 'Search empty state', 'view' => 'theme::blocks.search-empty-state', 'settings' => ['empty_title' => 'چه محصولی می‌خواهید؟', 'empty_description' => 'نام یا مشخصات محصول را در کادر جستجو وارد کنید.', 'not_found_title' => 'محصولی یافت نشد', 'not_found_description' => 'عبارت دیگری را امتحان کنید یا فیلترها را پاک کنید.', 'show_shop_action' => true]],
        ];
    }

    public function get(string $type): ?array
    {
        return $this->all()[$type] ?? null;
    }
}
