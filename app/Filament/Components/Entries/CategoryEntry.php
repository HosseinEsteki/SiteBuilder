<?php

namespace App\Filament\Components\Entries;

use Filament\Infolists\Components\TextEntry;

class CategoryEntry
{

    public static function make()
    {
        return TextEntry::make('category.name')
            ->label(trans('public.category'));
    }
}
