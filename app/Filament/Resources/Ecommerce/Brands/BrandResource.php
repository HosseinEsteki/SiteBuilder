<?php

namespace App\Filament\Resources\Ecommerce\Brands;

use App\Filament\Resources\Ecommerce\Brands\Pages\ListBrands;
use App\Filament\Resources\Ecommerce\Brands\Schemas\BrandForm;
use App\Filament\Resources\Ecommerce\Brands\Tables\BrandsTable;
use Ecommerce\Models\Brand;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BrandResource extends Resource
{
    protected static ?string $model = Brand::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static ?string $recordTitleAttribute = 'ecommerce-brand';
    protected static string|null|\UnitEnum $navigationGroup='فروشگاه';
    protected static ?string $label = 'برند';
    protected static ?string $pluralLabel = 'برندها';

    public static function form(Schema $schema): Schema
    {
        return BrandForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BrandsTable::configure($table);
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
            'index' => ListBrands::route('/'),
        ];
    }
}
