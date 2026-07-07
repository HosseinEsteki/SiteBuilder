<?php

namespace App\Filament\Resources\Ecommerce\Orders\Schemas;

use App\Filament\Components\Entries\Order\OrderBuyerEntry;
use App\Filament\Components\Entries\Order\OrderDiscountEntry;
use App\Filament\Components\Entries\Order\OrderPaymentRefEntry;
use App\Filament\Components\Entries\Order\OrderPriceEntries;
use App\Filament\Components\Entries\TimestampEntries;
use App\Filament\Components\Inputs\DescriptionInput;
use App\Filament\Components\Inputs\OrderItemsInput;
use App\Filament\Components\Inputs\OrderStatusInput;
use App\Filament\Components\Inputs\ShippingInputs;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Schema;

class OrderForm
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
                                OrderStatusInput::make(),
                                ...OrderPriceEntries::make(),
                                OrderDiscountEntry::make(),
                                OrderPaymentRefEntry::make(),
                                DescriptionInput::make(),

                                ...TimestampEntries::make(),
                            ]),
                        Tabs\Tab::make(trans('public.tabs.shipping'))
                            ->schema([
                                ...ShippingInputs::make(),

                            ]),
                        Tabs\Tab::make(trans('public.tabs.orderItems'))
                            ->schema([
                                OrderItemsInput::make(),
                            ])->columnSpanFull(),
                    ]
                )->columnSpanFull()
                    ->columns(3)
            ]);
    }
}
