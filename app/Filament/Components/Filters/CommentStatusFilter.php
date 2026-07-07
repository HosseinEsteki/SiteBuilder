<?php

namespace App\Filament\Components\Filters;

use Filament\Tables\Filters\SelectFilter;
use Public\Enums\CommentStatus;

class CommentStatusFilter
{
    public static function make()
    {
        return SelectFilter::make('status')
            ->label(trans('public.comments.status.label'))
            ->options(
                CommentStatus::options()
            );
}
}
