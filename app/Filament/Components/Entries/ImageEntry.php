<?php

namespace App\Filament\Components\Entries;

use Filament\Infolists\Components\SpatieMediaLibraryImageEntry;

class ImageEntry
{
    public static function make(string $collectionName)
    {

        return SpatieMediaLibraryImageEntry::make($collectionName)
            ->label(trans('public.image.thumbnail'))
            ->columnSpanFull();
    }

    public static function makeGallery(string $name)
    {
//        RepeatableEntry::make()
//            ->label(trans('public.image.gallery'))
//            ->schema([
//                \Filament\Infolists\Components\ImageEntry::make('value')
//                    ->square(), // اختیاری: نمایش مربعی
//            ]),
        return SpatieMediaLibraryImageEntry::make($name)
            ->label(trans('public.image.gallery'))
            ->columnSpanFull();
    }
}
