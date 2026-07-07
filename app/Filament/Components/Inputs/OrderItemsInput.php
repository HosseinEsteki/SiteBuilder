<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\Repeater;
use Filament\Infolists\Components\TextEntry;

class OrderItemsInput
{
    public static function make()
    {
        return
            Repeater::make('items')
                ->label(trans('ecommerce::ecommerce.orders.items'))
                ->relationship('items')
                ->schema([
                    //TODO:: باید ی دستی به این بخش بکشم
//                        ImageEntry::make(Product::$thumbnailMedia)->when('product',),
                    TextEntry::make('product.name')->label(trans('ecommerce::ecommerce.products.name')),
                    TextEntry::make('product.sale_price')->label(trans('ecommerce::ecommerce.money.sale_price')),
                    TextEntry::make('quantity')->label(trans('ecommerce::ecommerce.orders.quantity')),
                ])->columnSpan('small');
    }
}
