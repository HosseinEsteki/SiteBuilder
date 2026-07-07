<?php

namespace App\Filament\Components\Entries;

use Filament\Infolists\Components\TextEntry;

class NameAndSlugEntries
{
    public static function make($nameField='name', $slugField='slug'):array
    {
        return [
            TextEntry::make($nameField)->label(trans('name')),
            TextEntry::make($slugField)->label(trans('public.slug')),
        ];
    }
}
