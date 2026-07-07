<?php

namespace App\Filament\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class NameAndSlugColumns
{
    public static function make(): array
    {
        return [
            self::makeNameColumn(),
            self::makeSlugColumn(),
        ];
    }

    public static function makeNameColumn()
    {
        return TextColumn::make('name')
            ->label(trans('name'))
            ->sortable()
            ->searchable();
    }

    public static function makeSlugColumn()
    {
        return TextColumn::make('slug')
            ->label(trans('public.slug'))
            ->sortable()
            ->searchable();
    }
}
