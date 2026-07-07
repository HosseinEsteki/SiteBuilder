<?php

namespace App\Filament\Components\Inputs;

use Filament\Tables\Columns\TextColumn;
use Public\Enums\CommentStatus;

class CommentStatusInput
{
    public static function make()
    {
        return TextColumn::make('status')
            ->label(trans('public.comments.status.label'))
            ->formatStateUsing(fn($state) => CommentStatus::tryFrom($state)->label())
            ->badge()
            ->colors(CommentStatus::filamentColors());
    }
}
