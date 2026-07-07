<?php

namespace App\Filament\Components\Columns;

use Filament\Infolists\Components\TextEntry;
use Public\Enums\PostStatus;

class PostStatusEntry
{
    public static function make()
    {
        return TextEntry::make('status')
            ->label(trans('public.postStatus.label'))
            ->badge()->colors(PostStatus::filamentColors())
            ->formatStateUsing(fn($state)=>PostStatus::tryFrom($state)->label())
            ;
    }
}
