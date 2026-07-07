<?php

namespace App\Filament\Components\Entries\Order;

use Filament\Forms\Components\Repeater;
use Filament\Infolists\Components\TextEntry;

class OrderItemsEntry
{
    public static function make()
    {
        return
            Repeater::make('items')
                ->label(trans('ecommerce::ecommerce.orders.items'))
                ->relationship('items')
//                ->hasCreateItem(false)
                ->schema([
                    //TODO:: باید ی دستی به این بخش بکشم
//                        ImageEntry::make(Product::$thumbnailMedia)->when('product',),
                    TextEntry::make('product.name')->label(trans('ecommerce::ecommerce.products.name')),
                    TextEntry::make('product.sale_price')->label(trans('ecommerce::ecommerce.money.sale_price')),
                    TextEntry::make('quantity')->label(trans('ecommerce::ecommerce.orders.quantity')),
                ])->columnSpan('small');
    }
}
