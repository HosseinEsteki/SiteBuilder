<?php

namespace App\Filament\Components\Filters;

use Filament\Tables\Filters\SelectFilter;
use Public\Enums\PostStatus;

class PostStatusFilter
{
    public static function make()
    {
        return SelectFilter::make('status')->label(trans('public.postStatus.label'))
            ->options([
                PostStatus::Published->name => PostStatus::Published->value,
                PostStatus::Draft->name => PostStatus::Draft->value,
                PostStatus::Archived->name => PostStatus::Archived->value,
            ]);
    }
}
