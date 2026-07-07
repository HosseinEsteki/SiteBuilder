<?php

namespace App\Filament\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class SubjectColumn
{
    public static function make()
    {
        return TextColumn::make('subject')->label(trans('public.comments.subject'));
    }
}
