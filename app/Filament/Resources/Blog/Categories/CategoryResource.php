<?php

namespace App\Filament\Resources\Blog\Categories;

use App\Filament\Resources\Blog\Categories\Pages\ListCategories;
use App\Filament\Resources\Blog\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Blog\Categories\Schemas\CategoryInfolist;
use App\Filament\Resources\Blog\Categories\Tables\CategoriesTable;
use Blog\Models\Category;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

    protected static string|null|\UnitEnum $navigationGroup = 'مدیریت وبلاگ';

    protected static ?string $recordTitleAttribute = 'category-blog';

    protected static ?string $pluralLabel = 'دسته‌بندی‌ها';

    protected static ?string $modelLabel = 'دسته‌بندی';

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }


    public static function infolist(Schema $schema): Schema
    {
        return CategoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
        ];
    }
}
