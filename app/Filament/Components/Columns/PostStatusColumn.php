<?php

namespace App\Filament\Components\Columns;

use Filament\Tables\Columns\TextColumn;
use Public\Enums\PostStatus;

class PostStatusColumn
{
    public static function make()
    {
        return
            TextColumn::make('status')->label(trans('public.postStatus.label'))->toggleable()
                ->badge()->colors(PostStatus::filamentColors())->default(PostStatus::Published->value)
                ->formatStateUsing(fn($state) => PostStatus::showState($state))
            ->toggleable(isToggledHiddenByDefault: true);
    }
}
