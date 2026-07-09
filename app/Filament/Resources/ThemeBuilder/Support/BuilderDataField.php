<?php

namespace App\Filament\Resources\ThemeBuilder\Support;

use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

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
            ])
            ->collapsible()
            ->cloneable()
            ->reorderable()
            ->columnSpanFull();
    }
}
