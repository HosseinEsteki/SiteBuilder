<?php

namespace App\Filament\Resources\ThemeBuilder\Pages\Schemas;

use App\Filament\Resources\ThemeBuilder\Support\BuilderDataField;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Theme\Models\Theme;
use Theme\Models\ThemeTemplate;

class ThemePageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('PageTabs')->tabs([
                Tab::make('Main')
                    ->schema([
                        Section::make('Page details')->schema([
                            Select::make('theme_id')
                                ->label('Theme')
                                ->options(fn (): array => Theme::query()->orderBy('name')->pluck('name', 'id')->all())
                                ->searchable()
                                ->preload()
                                ->nullable(),
                            Select::make('template_id')
                                ->label('Template')
                                ->options(fn (): array => ThemeTemplate::query()->orderBy('name')->pluck('name', 'id')->all())
                                ->searchable()
                                ->preload()
                                ->nullable(),
                            TextInput::make('title')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state ?? ''))),
                            TextInput::make('slug')->required()->unique(ignoreRecord: true),
                            Select::make('status')
                                ->required()
                                ->options(['draft' => 'Draft', 'published' => 'Published'])
                                ->default('draft'),
                            DateTimePicker::make('published_at')->nullable(),
                            Textarea::make('excerpt')->rows(4)->columnSpanFull(),
                        ])->columns(2),
                    ]),
                Tab::make('Builder')
                    ->schema([
                        BuilderDataField::make(),
                    ]),
                Tab::make('SEO')
                    ->schema([
                        TextInput::make('meta_title')->maxLength(255)->helperText('Optional browser title and SEO title.'),
                        Textarea::make('meta_description')->rows(4)->helperText('Optional meta description.'),
                    ]),
                Tab::make('Custom CSS')
                    ->schema([
                        Textarea::make('custom_css')
                            ->rows(12)
                            ->helperText('Optional CSS for this page. Keep it scoped when possible.')
                            ->columnSpanFull(),
                    ]),
            ])->columnSpanFull(),
        ]);
    }
}
