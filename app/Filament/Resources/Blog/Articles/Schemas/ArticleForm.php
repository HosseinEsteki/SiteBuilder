<?php

namespace App\Filament\Resources\Blog\Articles\Schemas;

use App\Filament\Components\Inputs\CategoryInput;
use App\Filament\Components\Inputs\ContentInput;
use App\Filament\Components\Inputs\DescriptionInput;
use App\Filament\Components\Inputs\ImageInput;
use App\Filament\Components\Inputs\KeywordsInput;
use App\Filament\Components\Inputs\NameInput;
use App\Filament\Components\Inputs\PostStatusInput;
use App\Filament\Components\Inputs\SlugInput;
use Blog\Models\Article;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class ArticleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('ArticleTabs')->tabs([
                    Tab::make(trans('public.tabs.mainInformation'))
                        ->schema([
                            ImageInput::make('blog.article'),
                            NameInput::make(),
                            SlugInput::make(),
                            CategoryInput::make(),
                            PostStatusInput::make(),
                            KeywordsInput::make(new Article),
                            DescriptionInput::make(),
                        ])->columns(2),
                    Tab::make(trans('public.tabs.content'))
                        ->schema([
                            ContentInput::make(),
                        ]),
                ])->columnSpanFull(),
            ]);
    }
}
