<?php

namespace App\Filament\Resources\ThemeBuilder\Templates\Schemas;

use App\Filament\Resources\ThemeBuilder\Support\BuilderDataField;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Theme\Models\Theme;

class ThemeTemplateForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('TemplateTabs')->tabs([
                Tab::make('Main')
                    ->schema([
                        Section::make('Template details')->schema([
                            Select::make('theme_id')
                                ->label('Theme')
                                ->options(fn (): array => Theme::query()->orderBy('name')->pluck('name', 'id')->all())
                                ->searchable()
                                ->preload()
                                ->nullable(),
                            TextInput::make('name')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state ?? ''))),
                            TextInput::make('slug')->required()->unique(ignoreRecord: true),
                            Select::make('type')
                                ->required()
                                ->options([
                                    'header' => 'Header',
                                    'footer' => 'Footer',
                                    'page' => 'Page',
                                    'landing' => 'Landing',
                                    'single' => 'Single',
                                    'archive' => 'Archive',
                                ]),
                            Select::make('status')
                                ->required()
                                ->options(['draft' => 'Draft', 'published' => 'Published'])
                                ->default('draft'),
                            Toggle::make('is_default')->label('Default template'),
                        ])->columns(2),
                    ]),
                Tab::make('Builder')
                    ->schema([
                        BuilderDataField::make(),
                    ]),
                Tab::make('Custom CSS')
                    ->schema([
                        Textarea::make('custom_css')
                            ->rows(12)
                            ->helperText('Optional CSS for this template. Keep it scoped when possible.')
                            ->columnSpanFull(),
                    ]),
            ])->columnSpanFull(),
        ]);
    }
}
