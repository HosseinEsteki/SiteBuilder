<?php

namespace App\Filament\Resources\Ecommerce\Categories\Tables;

use App\Filament\Components\Columns\AuthorColumn;
use App\Filament\Components\Columns\NameAndSlugColumns;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Entries\Product\ProductCountColumn;
use App\Filament\Components\Filters\AuthorFilter;
use App\Filament\Components\Filters\TimestampFilter;
use Ecommerce\Enums\EcommercePermission;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;

class CategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ...NameAndSlugColumns::make(),
                AuthorColumn::make(),
                ProductCountColumn::make(),
                ...TimestampColumns::make(),
            ])
            ->filters([
                AuthorFilter::make(EcommercePermission::Category),
                TimestampFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
