<?php

namespace App\Filament\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class AuthorColumn
{
    public static function make()
    {
        return TextColumn::make('author.name')
            ->toggleable(isToggledHiddenByDefault: true)
            ->label(trans('permissions.author'))
            ->sortable();
}
}
