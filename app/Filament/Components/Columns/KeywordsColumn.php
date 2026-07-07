<?php

namespace App\Filament\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class KeywordsColumn
{
    public static function make()
    {
        return TextColumn::make('keywords')
            ->label(trans('public.keywords.label'))
            ->placeholder(trans('public.keywords.placeholder'))
            ->badge()->color('info')
            ->toggleable(isToggledHiddenByDefault: true);
}
}
