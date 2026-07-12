<?php

namespace App\Filament\Resources\ThemeBuilder\Support;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class BuilderDataField
{
    public static function make(string $name = 'builder_data'): Builder
    {
        return Builder::make($name)
            ->label('Builder blocks')
            ->helperText('Add MVP content blocks. Public rendering uses the ThemeRenderer, not hardcoded HTML.')
            ->blocks([
                Block::make('section')
                    ->label('Section')
                    ->schema([
                        TextInput::make('background_color')->helperText('Section background color, for example #ffffff.'),
                        TextInput::make('padding_top')->numeric()->helperText('Top spacing in pixels.'),
                        TextInput::make('padding_bottom')->numeric()->helperText('Bottom spacing in pixels.'),
                        Select::make('container_width')
                            ->options(['sm' => 'Small', 'md' => 'Medium', 'lg' => 'Large', 'xl' => 'Extra large'])
                            ->default('lg')
                            ->helperText('Conceptual content width for this section.'),
                    ])->columns(2),
                Block::make('heading')
                    ->label('Heading')
                    ->schema([
                        TextInput::make('text')->required()->helperText('Main heading text.'),
                        Select::make('level')
                            ->options(['h1' => 'H1', 'h2' => 'H2', 'h3' => 'H3', 'h4' => 'H4', 'h5' => 'H5', 'h6' => 'H6'])
                            ->default('h2')
                            ->helperText('Semantic heading level.'),
                        Select::make('align')
                            ->options(['left' => 'Left', 'center' => 'Center', 'right' => 'Right'])
                            ->default('left')
                            ->helperText('Text alignment.'),
                    ])->columns(3),
                Block::make('text')
                    ->label('Text')
                    ->schema([
                        Textarea::make('text')->rows(5)->helperText('Plain text content. It is escaped by the renderer.'),
                        Select::make('align')
                            ->options(['left' => 'Left', 'center' => 'Center', 'right' => 'Right'])
                            ->default('left'),
                    ]),
                Block::make('image')
                    ->label('Image')
                    ->schema([
                        TextInput::make('src')->url()->helperText('Image URL for the MVP renderer.'),
                        TextInput::make('alt')->helperText('Accessible alternative text.'),
                        TextInput::make('caption')->helperText('Optional visible caption.'),
                    ]),
                Block::make('button')
                    ->label('Button')
                    ->schema([
                        TextInput::make('text')->default('Learn more')->helperText('Button label.'),
                        TextInput::make('url')->default('#')->helperText('Button destination URL.'),
                        Select::make('align')
                            ->options(['left' => 'Left', 'center' => 'Center', 'right' => 'Right'])
                            ->default('left'),
                        Select::make('style')
                            ->options(['primary' => 'Primary', 'secondary' => 'Secondary'])
                            ->default('primary'),
                    ])->columns(2),
                Block::make('spacer')
                    ->label('Spacer')
                    ->schema([
                        TextInput::make('height')->numeric()->default(32)->helperText('Vertical spacing in pixels.'),
                    ]),
                Block::make('hero')
                    ->label('Hero')
                    ->schema([
                        TextInput::make('eyebrow')->helperText('Small optional intro text.'),
                        TextInput::make('title')->default('Welcome to SiteBuilder')->helperText('Hero title.'),
                        Textarea::make('subtitle')->rows(3)->helperText('Supporting hero text.'),
                        TextInput::make('button_text')->helperText('Optional CTA label.'),
                        TextInput::make('button_url')->default('#')->helperText('Optional CTA URL.'),
                        TextInput::make('background_color')->default('#f8fafc')->helperText('Hero background color.'),
                    ])->columns(2),
                Block::make('card')
                    ->label('Card')
                    ->schema([
                        TextInput::make('title')->helperText('Card title.'),
                        Textarea::make('text')->rows(4)->helperText('Card body text.'),
                        TextInput::make('url')->helperText('Optional card link URL.'),
                    ]),
                Block::make('html')
                    ->label('HTML')
                    ->schema([
                        CodeEditor::make('html')
                            ->helperText('Raw HTML is rendered as-is. Use only with trusted admin-authored content.'),
                    ]),
                Block::make('product_breadcrumbs')->label('Product breadcrumbs')->schema([
                    Toggle::make('show_category')->default(true),
                ]),
                Block::make('product_gallery')->label('Product gallery')->schema([
                    Select::make('image_ratio')->options(['1/1' => 'Square', '4/3' => 'Landscape', '3/4' => 'Portrait'])->default('1/1'),
                    Select::make('image_fit')->options(['contain' => 'Contain', 'cover' => 'Cover'])->default('contain'),
                    Toggle::make('show_thumbnails')->default(true), Toggle::make('show_discount_badge')->default(true),
                ])->columns(4),
                Block::make('product_summary')->label('Product summary')->schema([
                    Toggle::make('show_brand')->default(true), Toggle::make('show_category')->default(true), Toggle::make('show_sku')->default(true),
                    Toggle::make('show_short_description')->default(true), Toggle::make('show_stock')->default(true),
                ])->columns(3),
                Block::make('product_price')->label('Product price')->schema([
                    Toggle::make('show_price')->default(true),
                ]),
                Block::make('purchase_panel')->label('Purchase panel')->schema([
                    TextInput::make('button_text')->default('افزودن به سبد خرید'), Toggle::make('show_stock')->default(true),
                ])->columns(2),
                Block::make('product_description')->label('Product description')->schema([
                    TextInput::make('title')->default('توضیحات محصول'),
                ]),
                Block::make('product_specifications')->label('Product specifications')->schema([
                    TextInput::make('title')->default('مشخصات محصول'), Toggle::make('show_empty')->default(false),
                ])->columns(2),
                Block::make('product_meta')->label('Product meta')->schema([
                    TextInput::make('title')->default('اطلاعات محصول'),
                ]),
                Block::make('related_products')->label('Related products')->schema([
                    TextInput::make('title')->default('محصولات مرتبط'),
                    TextInput::make('limit')->numeric()->minValue(1)->maxValue(12)->default(4),
                    Select::make('variant')->options(['default' => 'Default', 'compact' => 'Compact', 'horizontal' => 'Horizontal'])->default('default'),
                ])->columns(3),
                Block::make('service_features')->label('Service features')->schema([
                    Toggle::make('enabled')->default(true)->helperText('Show or hide configured service features.'),
                ]),
                Block::make('product_archive_header')->label('Product archive header')->schema([
                    Toggle::make('show_description')->default(true), Toggle::make('show_image')->default(true),
                    Toggle::make('show_result_count')->default(true), Toggle::make('show_breadcrumbs')->default(true),
                    Select::make('alignment')->options(['right' => 'Right', 'center' => 'Center', 'left' => 'Left'])->default('right'),
                    Select::make('variant')->options(['default' => 'Default', 'compact' => 'Compact'])->default('default'),
                ])->columns(3),
                Block::make('product_listing_grid')->label('Product listing grid')->schema([
                    Select::make('variant')->options(['default' => 'Default', 'compact' => 'Compact', 'horizontal' => 'Horizontal'])->default('default'),
                    TextInput::make('desktop_columns')->numeric()->minValue(1)->maxValue(6)->default(4),
                    TextInput::make('tablet_columns')->numeric()->minValue(1)->maxValue(4)->default(3),
                    TextInput::make('mobile_columns')->numeric()->minValue(1)->maxValue(2)->default(2),
                    Toggle::make('show_brand')->default(true), Toggle::make('show_discount')->default(true),
                    Toggle::make('show_stock')->default(true), Toggle::make('show_button')->default(false),
                    Toggle::make('show_result_count')->default(false), TextInput::make('empty_title')->default('محصولی یافت نشد'),
                    Textarea::make('empty_description'),
                ])->columns(3),
                Block::make('search_breadcrumbs')->label('Search breadcrumbs')->schema([]),
                Block::make('search_header')->label('Search header')->schema([
                    TextInput::make('title')->default('نتایج جستجو'), Textarea::make('description'),
                    Toggle::make('show_header')->default(true), Toggle::make('show_result_count')->default(true),
                ])->columns(2),
                Block::make('search_form')->label('Search form')->schema([
                    Toggle::make('enabled')->default(true), TextInput::make('label')->default('جستجوی محصولات'), TextInput::make('placeholder'),
                ])->columns(3),
                Block::make('product_filters')->label('Product filters')->schema([Toggle::make('enabled')->default(true)]),
                Block::make('archive_toolbar')->label('Search sorting')->schema([
                    Toggle::make('show_sorting')->default(true), Toggle::make('show_result_count')->default(true),
                ])->columns(2),
                Block::make('active_filters')->label('Active filters')->schema([]),
                Block::make('archive_product_grid')->label('Search product grid')->schema([
                    Select::make('variant')->options(['default' => 'Default', 'compact' => 'Compact', 'horizontal' => 'Horizontal'])->default('default'),
                    TextInput::make('desktop_columns')->numeric()->minValue(1)->maxValue(6)->default(4),
                    TextInput::make('tablet_columns')->numeric()->minValue(1)->maxValue(4)->default(3),
                    TextInput::make('mobile_columns')->numeric()->minValue(1)->maxValue(2)->default(2),
                    Toggle::make('show_image')->default(true), Toggle::make('show_brand')->default(true),
                    Toggle::make('show_discount')->default(true), Toggle::make('show_stock')->default(true), Toggle::make('show_button')->default(false),
                ])->columns(3),
                Block::make('archive_pagination')->label('Pagination')->schema([Toggle::make('enabled')->default(true)]),
                Block::make('search_empty_state')->label('Search empty state')->schema([
                    TextInput::make('empty_title'), Textarea::make('empty_description'), TextInput::make('not_found_title'),
                    Textarea::make('not_found_description'), Toggle::make('show_shop_action')->default(true),
                ])->columns(2),
                Block::make('blog_archive_grid')->label('Blog archive grid')->schema([
                    TextInput::make('heading')->default('مجله'), Textarea::make('description'),
                    Toggle::make('show_excerpt')->default(true), Toggle::make('show_category')->default(true),
                    Toggle::make('show_date')->default(true), Toggle::make('show_image')->default(true),
                    TextInput::make('columns')->numeric()->minValue(1)->maxValue(4)->default(3),
                    Select::make('image_ratio')->options(['16/9' => '16:9', '4/3' => '4:3', '1/1' => '1:1'])->default('16/9'),
                    TextInput::make('articles_per_page')->numeric()->minValue(1)->maxValue(24)->default(12),
                ])->columns(3),
                Block::make('article_header')->label('Article header')->schema([
                    Toggle::make('show_category')->default(true), Toggle::make('show_date')->default(true),
                    Toggle::make('show_author')->default(true), Toggle::make('show_image')->default(true),
                ])->columns(4),
                Block::make('article_content')->label('Article content')->schema([]),
                Block::make('related_articles')->label('Related articles')->schema([
                    TextInput::make('heading')->default('مقاله‌های مرتبط'), TextInput::make('limit')->numeric()->minValue(1)->maxValue(8)->default(3),
                    TextInput::make('columns')->numeric()->minValue(1)->maxValue(4)->default(3),
                    Select::make('image_ratio')->options(['16/9' => '16:9', '4/3' => '4:3', '1/1' => '1:1'])->default('16/9'),
                    Toggle::make('show_excerpt')->default(false), Toggle::make('show_category')->default(true),
                    Toggle::make('show_date')->default(true), Toggle::make('show_image')->default(true),
                ])->columns(4),
            ])
            ->collapsible()
            ->cloneable()
            ->reorderable()
            ->columnSpanFull();
    }
}
