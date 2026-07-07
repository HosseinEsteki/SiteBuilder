<?php

namespace App\Filament\Components\Entries;

use Filament\Infolists\Components\TextEntry;

class ContentEntry
{
    public static function make()
    {
        return TextEntry::make('show_content')
            ->label(trans('public.content'))
            ->html() // چون خروجی renderContent HTML هست
            ->columnSpanFull();
    }
}
