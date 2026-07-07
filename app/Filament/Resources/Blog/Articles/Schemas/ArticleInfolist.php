<?php

namespace App\Filament\Resources\Blog\Articles\Schemas;

use App\Filament\Components\Columns\PostStatusEntry;
use App\Filament\Components\Entries\CategoryEntry;
use App\Filament\Components\Entries\ContentEntry;
use App\Filament\Components\Entries\DescriptionEntry;
use App\Filament\Components\Entries\ImageEntry;
use App\Filament\Components\Entries\KeywordsEntry;
use App\Filament\Components\Entries\NameAndSlugEntries;
use App\Filament\Components\Entries\TimestampEntries;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;
use Public\Traits\HasPersianDate;

class ArticleInfolist
{
    use HasPersianDate;

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->schema([
                        Tabs\Tab::make(trans('public.information'))
                            ->schema([
                                ImageEntry::make('blog.article'),
                                ...NameAndSlugEntries::make(),
                                CategoryEntry::make(),
                                PostStatusEntry::make(),
                                DescriptionEntry::make(),
                                KeywordsEntry::make(),
                                ...TimestampEntries::make(),
                            ]),
                        Tabs\Tab::make(trans('public.content'))
                            ->schema([
                                ContentEntry::make(),
                            ])
                    ])->columnSpanFull()->columns(2)
            ]);
    }
}
