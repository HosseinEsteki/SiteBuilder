<?php

namespace App\Filament\Components\Entries;

use Filament\Infolists\Components\TextEntry;

class DescriptionEntry
{

    public static function make()
    {
        return TextEntry::make('description')
            ->placeholder('-')
            ->label(trans('public.description'))
            ->columnSpanFull();
    }
}
