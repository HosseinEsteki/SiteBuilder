<?php

namespace App\Filament\Components\Entries;

use Filament\Infolists\Components\TextEntry;

class AuthorEntry
{

    public static function make()
    {
        return TextEntry::make('author.name')
            ->label(trans('permissions.author'))
            ->placeholder('-');
    }
}
