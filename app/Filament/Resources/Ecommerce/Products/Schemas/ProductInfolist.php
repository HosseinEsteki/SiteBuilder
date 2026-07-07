<?php

namespace App\Filament\Resources\Ecommerce\Products\Schemas;

use App\Filament\Components\Entries\CategoryEntry;
use App\Filament\Components\Entries\ContentEntry;
use App\Filament\Components\Entries\DescriptionEntry;
use App\Filament\Components\Entries\ImageEntry;
use App\Filament\Components\Entries\KeywordsEntry;
use App\Filament\Components\Entries\NameAndSlugEntries;
use App\Filament\Components\Entries\Product\BrandEntry;
use App\Filament\Components\Entries\Product\IsVariableEntry;
use App\Filament\Components\Entries\Product\PriceEntries;
use App\Filament\Components\Entries\Product\StockEntry;
use App\Filament\Components\Entries\Product\VariantsEntry;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()
                    ->schema([
                        Tabs\Tab::make(trans('public.tabs.mainInformation'))
                            ->schema([
                                //TODO: بخش تصاویر در نمایش گالری و تصویر شاخص مشکل داره
                                ImageEntry::make('thumbnail_url')->square(),
                                ImageEntry::makeGallery('gallery_urls'),
                                ...NameAndSlugEntries::make(),
                                KeywordsEntry::make(),
                                ...PriceEntries::make(),
                                StockEntry::make(),
                                IsVariableEntry::make(),
                                CategoryEntry::make(),
                                BrandEntry::make(),
                                DescriptionEntry::make(),
                            ]),

                        Tabs\Tab::make(trans('ecommerce::ecommerce.variants.index'))
                            ->schema([
                                VariantsEntry::make(),
                            ]),

                        Tabs\Tab::make(trans('public.content'))
                            ->schema([
                                ContentEntry::make()
                            ]),

                    ])->columns(3)
                    ->columnSpanFull()
            ]);


    }
}
