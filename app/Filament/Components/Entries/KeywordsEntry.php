<?php

namespace App\Filament\Components\Entries;

use Filament\Infolists\Components\TextEntry;

class KeywordsEntry
{
    public static function make()
    {
        return TextEntry::make('keywords')
            ->label(trans('public.keywords.label'))
            ->placeholder(trans('public.keywords.placeholder'))
            ->columnSpanFull()
            ->formatStateUsing(fn($state) => is_array($state)
                ? implode(', ', $state)
                : $state
            )
            ->badge()
            ->color('info');
    }
}
