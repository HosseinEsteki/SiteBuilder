<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\TagsInput;
use Illuminate\Database\Eloquent\Model;

class KeywordsInput
{
    public static function make(Model $model)
    {
        return TagsInput::make('keywords')
            ->label(trans('public.keywords.label'))
            ->placeholder(trans('public.keywords.placeholder'))
            ->suggestions(
                $model->pluck('keywords')
                    ->flatten()
                    ->unique()
                    ->values()
                    ->toArray()
            )
            ->required();
    }
}
