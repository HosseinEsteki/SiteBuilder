<?php

namespace App\Filament\Components\Columns;

use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class ImageColumn
{
    public static function make($collectionName)
    {
        return SpatieMediaLibraryImageColumn::make($collectionName)
            ->label(trans('public.image.thumbnail'));
    }
}
