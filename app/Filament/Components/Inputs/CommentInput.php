<?php

namespace App\Filament\Components\Inputs;

use Filament\Tables\Columns\TextColumn;

class CommentInput
{
    public static function make()
    {
        return TextColumn::make('comment')->label(trans('public.comments.show'))->limit(200);
}
}
