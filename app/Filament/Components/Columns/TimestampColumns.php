<?php


namespace App\Filament\Components\Columns;

use Filament\Tables\Columns\TextColumn;

class TimestampColumns
{
    public static function make(): array
    {
        return [
            TextColumn::make('created_at_ago')
                ->label(trans('public.date.created_at_ago'))
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('created_at')
                ->label(trans('public.date.created_at'))
                ->jalaliDateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            TextColumn::make('updated_at')
                ->label(trans('public.date.updated_at'))
                ->jalaliDateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
        ];
    }
}
