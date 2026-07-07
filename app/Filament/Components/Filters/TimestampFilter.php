<?php

namespace App\Filament\Components\Filters;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Tables\Filters\Filter;

class TimestampFilter
{
    public static function make()
    {
        return Filter::make('created_at')
            ->schema([
                Section::make(trans('public.date.created_at'))
                    ->collapsed()
                    ->schema([
                        DatePicker::make('from')
                            ->label(trans('public.date.from'))
                            ->jalali(),

                        DatePicker::make('until')
                            ->label(trans('public.date.until'))
                            ->jalali(),
                    ])->columns(2)

            ])
            ->query(function ($query, array $data) {
                return $query
                    ->when($data['from'], fn($q, $date) => $q->whereDate('created_at', '>=', $date))
                    ->when($data['until'], fn($q, $date) => $q->whereDate('created_at', '<=', $date));
            });
    }
}
