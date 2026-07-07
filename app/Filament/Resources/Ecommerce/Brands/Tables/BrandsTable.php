<?php

namespace App\Filament\Resources\Ecommerce\Brands\Tables;

use App\Filament\Components\Columns\AuthorColumn;
use App\Filament\Components\Columns\ImageColumn;
use App\Filament\Components\Columns\NameAndSlugColumns;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Filters\AuthorFilter;
use App\Filament\Components\Filters\TimestampFilter;
use Ecommerce\Enums\EcommercePermission;
use Ecommerce\Models\Brand;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BrandsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make(Brand::$thumbnailMedia),

                ...NameAndSlugColumns::make(),
                TextColumn::make('description'),
                AuthorColumn::make(),
                ...TimestampColumns::make()
            ])
            ->filters([
                TimestampFilter::make(),
                AuthorFilter::make(EcommercePermission::Brand),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
