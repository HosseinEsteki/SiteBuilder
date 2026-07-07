<?php

namespace App\Filament\Resources\Ecommerce\Discounts;

use App\Filament\Resources\Ecommerce\Discounts\Pages\CreateDiscount;
use App\Filament\Resources\Ecommerce\Discounts\Pages\EditDiscount;
use App\Filament\Resources\Ecommerce\Discounts\Pages\ListDiscounts;
use App\Filament\Resources\Ecommerce\Discounts\Schemas\DiscountForm;
use App\Filament\Resources\Ecommerce\Discounts\Schemas\DiscountInfolist;
use App\Filament\Resources\Ecommerce\Discounts\Tables\DiscountsTable;
use Ecommerce\Models\Discount;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class DiscountResource extends Resource
{
    protected static ?string $model = Discount::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'ecommerce-discount';
    protected static string|null|\UnitEnum $navigationGroup='فروشگاه';
    protected static ?string $label = 'کدتخفیف';
    protected static ?string $pluralLabel = 'کدهای تخفیف';

    public static function form(Schema $schema): Schema
    {
        return DiscountForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DiscountInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DiscountsTable::configure($table);
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
            'index' => ListDiscounts::route('/'),
        ];
    }
}
