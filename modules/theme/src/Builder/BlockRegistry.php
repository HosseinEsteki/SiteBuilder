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
        ];
    }

    public function get(string $type): ?array
    {
        return $this->all()[$type] ?? null;
    }
}
