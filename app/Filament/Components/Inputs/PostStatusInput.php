<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\Select;
use Public\Enums\PostStatus;

class PostStatusInput
{
    public static function make()
    {
        return Select::make('status')
            ->label(trans('public.status'))
            ->options(
                PostStatus::options()
            )
            ->default(fn ($context,$record) => $context === 'create'
                ? PostStatus::Draft->name
                : logger($record->name)
            )
            ->required();
    }
}
