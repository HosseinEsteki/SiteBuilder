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
        ];
    }

    public function get(string $type): ?array
    {
        return $this->all()[$type] ?? null;
    }
}
