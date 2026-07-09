<?php

namespace App\Filament\Resources\ThemeBuilder\Themes\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ThemeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('ThemeTabs')->tabs([
                Tab::make('Main')
                    ->schema([
                        Section::make('Theme details')->schema([
                            TextInput::make('name')
                                ->required()
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state ?? ''))),
                            TextInput::make('slug')->required()->unique(ignoreRecord: true),
                            Textarea::make('description')->rows(4)->columnSpanFull(),
                            Toggle::make('is_active')->label('Active theme')->helperText('Use the Activate action to ensure only one theme is active.'),
                        ])->columns(2),
                    ]),
                Tab::make('Settings')
                    ->schema([
                        KeyValue::make('settings')
                            ->label('Settings JSON')
                            ->helperText('Simple key/value settings for this theme. Advanced schema can be added later.')
                            ->columnSpanFull(),
                    ]),
            ])->columnSpanFull(),
        ]);
    }
}
