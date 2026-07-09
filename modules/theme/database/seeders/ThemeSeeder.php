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
        $theme = Theme::query()->updateOrCreate(
            ['slug' => 'default-theme'],
            [
                'name' => 'Default Theme',
                'description' => 'Default starter theme for SiteBuilder pages.',
                'is_active' => true,
                'settings' => [
                    'primary_color' => '#f59e0b',
                    'content_width' => '1200px',
                ],
            ],
        );

        $header = ThemeTemplate::query()->updateOrCreate(
            ['slug' => 'default-header'],
            [
                'theme_id' => $theme->id,
                'name' => 'Default Header',
                'type' => 'header',
                'builder_data' => [
                    [
                        'type' => 'heading',
                        'settings' => [
                            'text' => 'SiteBuilder',
                            'level' => 'h2',
                            'align' => 'center',
                        ],
                    ],
                ],
                'status' => 'published',
                'is_default' => true,
            ],
        );

        ThemeTemplate::query()->updateOrCreate(
            ['slug' => 'default-footer'],
            [
                'theme_id' => $theme->id,
                'name' => 'Default Footer',
                'type' => 'footer',
                'builder_data' => [
                    [
                        'type' => 'text',
                        'settings' => [
                            'text' => 'Powered by SiteBuilder',
                            'align' => 'center',
                        ],
                    ],
                ],
                'status' => 'published',
                'is_default' => true,
            ],
        );

        ThemePage::query()->updateOrCreate(
            ['slug' => 'home'],
            [
                'theme_id' => $theme->id,
                'template_id' => $header->id,
                'title' => 'Home',
                'excerpt' => 'Default homepage for SiteBuilder.',
                'builder_data' => [
                    [
                        'type' => 'hero',
                        'settings' => [
                            'eyebrow' => 'Laravel modular site builder',
                            'title' => 'Welcome to SiteBuilder',
                            'subtitle' => 'A clean starting point for building custom pages, content, and commerce experiences.',
                            'button_text' => 'Explore pages',
                            'button_url' => '/pages/about',
                            'background_color' => '#f8fafc',
                        ],
                    ],
                    [
                        'type' => 'text',
                        'settings' => [
                            'text' => 'Use the Theme Builder module to compose pages from reusable JSON blocks rendered safely on the server.',
                            'align' => 'center',
                        ],
                    ],
                    [
                        'type' => 'button',
                        'settings' => [
                            'text' => 'Open admin',
                            'url' => '/admin',
                            'align' => 'center',
                            'style' => 'primary',
                        ],
                    ],
                    [
                        'type' => 'card',
                        'settings' => [
                            'title' => 'Modular content',
                            'text' => 'Blog, ecommerce, SEO, email, activity log, and theme builder modules can evolve independently.',
                            'url' => '/pages/about',
                        ],
                    ],
                    [
                        'type' => 'card',
                        'settings' => [
                            'title' => 'Server rendering',
                            'text' => 'Builder JSON is rendered by Blade partials through ThemeRenderer.',
                            'url' => '/pages/landing-demo',
                        ],
                    ],
                ],
                'meta_title' => 'Home',
                'meta_description' => 'Default SiteBuilder home page.',
                'status' => 'published',
                'published_at' => now(),
            ],
        );

        ThemePage::query()->updateOrCreate(
            ['slug' => 'about'],
            [
                'theme_id' => $theme->id,
                'template_id' => $header->id,
                'title' => 'About',
                'excerpt' => 'Default about page for SiteBuilder.',
                'builder_data' => [
                    [
                        'type' => 'heading',
                        'settings' => [
                            'text' => 'About SiteBuilder',
                            'level' => 'h1',
                            'align' => 'center',
                        ],
                    ],
                    [
                        'type' => 'text',
                        'settings' => [
                            'text' => 'SiteBuilder is a modular Laravel application intended to work like a customized WordPress-style platform.',
                            'align' => 'center',
                        ],
                    ],
                ],
                'meta_title' => 'About',
                'meta_description' => 'Default SiteBuilder about page.',
                'status' => 'draft',
            ],
        );

        ThemePage::query()->updateOrCreate(
            ['slug' => 'landing-demo'],
            [
                'theme_id' => $theme->id,
                'template_id' => $header->id,
                'title' => 'Landing Demo',
                'excerpt' => 'Sample landing page for the Theme Builder.',
                'builder_data' => [
                    [
                        'type' => 'hero',
                        'settings' => [
                            'eyebrow' => 'Demo landing',
                            'title' => 'Launch a custom Laravel site faster',
                            'subtitle' => 'This sample page demonstrates hero, text, button, spacer, and card blocks.',
                            'button_text' => 'Preview home',
                            'button_url' => '/pages/home',
                            'background_color' => '#fff7ed',
                        ],
                    ],
                    [
                        'type' => 'spacer',
                        'settings' => [
                            'height' => 32,
                        ],
                    ],
                    [
                        'type' => 'card',
                        'settings' => [
                            'title' => 'Editable JSON blocks',
                            'text' => 'Admins can manage blocks with Filament forms before a full drag-and-drop editor exists.',
                            'url' => '/admin/theme-builder/pages/theme-pages',
                        ],
                    ],
                ],
                'meta_title' => 'Landing Demo',
                'meta_description' => 'Sample Theme Builder landing page.',
                'status' => 'published',
                'published_at' => now(),
            ],
        );
    }
}
