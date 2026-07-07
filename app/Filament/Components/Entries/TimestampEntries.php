<?php

namespace App\Filament\Components\Entries;

use Filament\Infolists\Components\TextEntry;

class TimestampEntries
{
    public static function make()
    {
        return [
            TextEntry::make('created_at_ago')->label(trans('public.date.created_at_ago')),
            TextEntry::make('created_at')
                ->label(trans('public.date.created_at'))
                ->jalaliDateTime()
                ->placeholder('-'),

            TextEntry::make('updated_at')
                ->label(trans('public.date.updated_at'))
                ->jalaliDateTime()
                ->placeholder('-'),
        ];
    }
}
