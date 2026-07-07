<?php

namespace App\Filament\Components\Filters;

use Filament\Tables\Filters\SelectFilter;

class CategoryFilter
{
    public static function make()
    {
        return SelectFilter::make('category_id')
            ->label(trans('public.category'))
            ->relationship('category', 'name')
            ->searchable()
            ->preload();
    }
}
