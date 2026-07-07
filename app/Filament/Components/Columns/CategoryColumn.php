<?php

namespace App\Filament\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class CategoryColumn
{
    public static function make()
    {
        return TextColumn::make('category.name')
            ->label(trans('public.category'))
            ->toggleable(isToggledHiddenByDefault: true)
            ->searchable();
    }
}
