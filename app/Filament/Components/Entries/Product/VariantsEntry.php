<?php

namespace App\Filament\Components\Entries\Product;

use App\Filament\Components\Entries\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;

class VariantsEntry
{
    public static function make()
    {
        return RepeatableEntry::make('variants')
            ->label(trans('ecommerce::ecommerce.variants.list'))
            ->schema([
                Section::make(fn($variant) => trans('ecommerce::ecommerce.variants.show'))
                    ->collapsible() // هر واریانت جداگانه باز/بسته میشه
                    ->schema([
                        ImageEntry::make('thumbnail_url'),
                        SKUEntry::make(),
                        ...PriceEntries::make(),
                        StockEntry::make(),
                        RepeatableEntry::make('options')
                            ->label(trans('public.options'))
                            ->schema([
                                TextEntry::make('value')->label(trans('public.value')),
                            ]),
                    ]),
            ]);
}
}
