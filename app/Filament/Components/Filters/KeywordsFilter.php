<?php

namespace App\Filament\Components\Filters;

use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Model;

class KeywordsFilter
{
    public static function make(Model $model)
    {
        $options = $model->query()
            ->select('keywords')
            ->get()
            ->pluck('keywords')
            ->flatten()
            ->unique()
            ->mapWithKeys(fn($item) => [$item => $item])
            ->whereNotNull()
            ->toArray();
        if (empty($options)) {
            return SelectFilter::make('keywords')
                ->label(trans('public.keywords.label'))
                ->placeholder(trans('public.keywords.placeholder'));
        }
        return SelectFilter::make('keywords')
            ->label(trans('public.keywords.label'))
            ->placeholder(trans('public.keywords.placeholder'))
            ->options(
                $options
            )
            ->searchable()
            ->multiple()
                ->query(function ($query, array $data) {
                    return $query->when(
                        $data['values'] ?? null,
                        fn($q, $values) => $q->where(function ($q) use ($values) {
                            foreach ($values as $value) {
                                $q->orWhereJsonContains('keywords', $value);
                            }
                        })
                    );
                })
            ;
    }
}
