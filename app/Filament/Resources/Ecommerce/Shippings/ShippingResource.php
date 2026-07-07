<?php

namespace App\Filament\Resources\Ecommerce\Shippings;

use App\Filament\Resources\Ecommerce\Shippings\Pages\ListShippings;
use App\Filament\Resources\Ecommerce\Shippings\Schemas\ShippingForm;
use App\Filament\Resources\Ecommerce\Shippings\Tables\ShippingsTable;
use BackedEnum;
use Ecommerce\Models\Shipping;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ShippingResource extends Resource
{
    protected static ?string $model = Shipping::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAtSymbol;
    protected static string|null|\UnitEnum $navigationGroup = 'فروشگاه';
    protected static ?string $pluralLabel = 'حمل‌و‌نقل';
    protected static ?string $modelLabel = 'حمل‌و‌نقل';
    protected static ?string $recordTitleAttribute = 'ecommerce-shipping';

    public static function form(Schema $schema): Schema
    {
        return ShippingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ShippingsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListShippings::route('/'),
        ];
    }
}
