<?php

namespace App\Filament\Components\Actions;

use Filament\Actions\BulkAction;
use Filament\Forms\Components\Toggle;
use Illuminate\Support\Collection;

class ActiveBulkAction
{
    public static function make()
    {
        return BulkAction::make('changeActive')
            ->label(trans('ecommerce::ecommerce.active.change'))
            ->schema([
                Toggle::make('active')
                    ->label(trans('ecommerce::ecommerce.active.label'))
                ->default(true)
            ])
            ->action(function (Collection $records, array $data) {
                foreach ($records as $discount) {
                    if($discount->end_date<\now()||$discount->used_count>$discount->usage_limit)
                        $discount->update(['active' => false]);
                    else
                        $discount->update(['active' => $data['active']]);
                }
            });
    }
}
