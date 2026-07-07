<?php

namespace App\Filament\Resources\Ecommerce\Orders\Schemas;

use App\Filament\Components\Entries\Order\OrderBuyerEntry;
use App\Filament\Components\Entries\Order\OrderDiscountEntry;
use App\Filament\Components\Entries\Order\OrderItemsEntry;
use App\Filament\Components\Entries\Order\OrderPaymentRefEntry;
use App\Filament\Components\Entries\Order\OrderPriceEntries;
use App\Filament\Components\Entries\Order\OrderStatusEntry;
use App\Filament\Components\Entries\Order\ShippingEntries;
use App\Filament\Components\Entries\TimestampEntries;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class OrderInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make()->schema(
                    [
                        Tabs\Tab::make(trans('public.tabs.mainInformation'))
                            ->schema([
                                OrderBuyerEntry::make(),
                                OrderStatusEntry::make(),
                                ...OrderPriceEntries::make(),
                                OrderDiscountEntry::make(),
                                OrderPaymentRefEntry::make(),
                                ...TimestampEntries::make(),
                            ]),
                        Tabs\Tab::make(trans('public.tabs.orderItems'))
                            ->schema([
                                OrderItemsEntry::make(),
                            ])->columnSpanFull(),
                        Tabs\Tab::make(trans('public.tabs.shipping'))
                        ->schema([
                            ...ShippingEntries::make(),
                        ])
                    ]
                )->columnSpanFull()
                    ->columns(3)
            ]);
    }
}
