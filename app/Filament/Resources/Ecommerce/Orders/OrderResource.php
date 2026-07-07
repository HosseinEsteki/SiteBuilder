<?php

namespace App\Filament\Resources\Ecommerce\Orders;

use App\Filament\Resources\Ecommerce\Orders\Pages\EditOrder;
use App\Filament\Resources\Ecommerce\Orders\Pages\ListOrders;
use App\Filament\Resources\Ecommerce\Orders\Pages\ViewOrder;
use App\Filament\Resources\Ecommerce\Orders\Schemas\OrderForm;
use App\Filament\Resources\Ecommerce\Orders\Schemas\OrderInfolist;
use App\Filament\Resources\Ecommerce\Orders\Tables\OrdersTable;
use BackedEnum;
use Ecommerce\Models\Order;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;
    protected static string|null|\UnitEnum $navigationGroup = 'فروشگاه';

    protected static ?string $pluralLabel = 'سفارشات';

    protected static ?string $modelLabel = 'سفارش';

    protected static ?string $recordTitleAttribute = 'ecommerce-orders';

    public static function form(Schema $schema): Schema
    {
        return OrderForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return OrderInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OrdersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
//            OrderItemResource::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOrders::route('/'),
            'view' => ViewOrder::route('/{record}'),
            'edit' => EditOrder::route('/{record}/edit'),
        ];
    }
}
