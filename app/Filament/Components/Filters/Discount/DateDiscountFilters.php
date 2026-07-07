<?php

namespace App\Filament\Components\Filters\Discount;

use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Tables\Filters\Filter;

class DateDiscountFilters
{
    public static function make()
    {
        return [

            Filter::make('start_date')
                ->schema([
                    Section::make(trans('ecommerce::ecommerce.discount.filter.date.start_date'))
                        ->collapsed()
                        ->schema([
                            DatePicker::make('from')
                                ->label(trans('public.date.from'))
                                ->jalali()
                            ,

                            DatePicker::make('until')
                                ->label(trans('public.date.until'))
                                ->jalali(),
                        ])->columns(2),
                ])->query(function ($query, array $data) {
                    return $query
                        ->when($data['from'], fn($q, $date) => $q->whereDate('start_date', '>=', $date))
                        ->when($data['until'], fn($q, $date) => $q->whereDate('start_date', '<=', $date));
                }),
            Filter::make('end_date')
                ->schema([
                    Section::make(trans('ecommerce::ecommerce.discount.filter.date.end_date'))
                        ->collapsed()
                        ->schema([
                            DatePicker::make('from')
                                ->label(trans('public.date.from'))
                                ->jalali(),

                            DatePicker::make('until')
                                ->label(trans('public.date.until'))
                                ->jalali(),
                        ])->columns(2)
                ])->query(function ($query, array $data) {
                    return $query
                        ->when($data['from'], fn($q, $date) => $q->whereDate('end_date', '>=', $date))
                        ->when($data['until'], fn($q, $date) => $q->whereDate('end_date', '<=', $date));
                }),
        ];
    }
}
