<?php

namespace App\Filament\Components\Actions;

use Ecommerce\Enums\OrderStatus;
use Filament\Actions\BulkAction;
use Filament\Forms\Components\Select;
use Illuminate\Support\Collection;

class ChangeOrderStatusBulkAction
{
    public static function make()
    {
        return BulkAction::make('changeStatus')
            ->label(trans('ecommerce::ecommerce.orders.status.changeStatus'))
            ->schema([
                Select::make('status')
                    ->label(trans('ecommerce::ecommerce.orders.status.label'))
                    ->options(OrderStatus::options())
                    ->required(),
            ])
            ->action(function (Collection $records, array $data) {
                foreach ($records as $order) {
                    $order->update(['status' => $data['status']]);
                }
            });
    }
}
