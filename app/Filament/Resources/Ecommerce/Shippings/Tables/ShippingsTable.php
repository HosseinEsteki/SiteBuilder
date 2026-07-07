<?php

namespace App\Filament\Resources\Ecommerce\Shippings\Tables;

use App\Filament\Components\Actions\ActiveBulkAction;
use App\Filament\Components\Columns\ActiveColumn;
use App\Filament\Components\Columns\AuthorColumn;
use App\Filament\Components\Columns\NameAndSlugColumns;
use App\Filament\Components\Columns\TimestampColumns;
use App\Filament\Components\Filters\ActiveFilter;
use App\Filament\Components\Filters\AuthorFilter;
use App\Filament\Components\Filters\TimestampFilter;
use Ecommerce\Enums\EcommercePermission;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ShippingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                NameAndSlugColumns::makeNameColumn(),
                AuthorColumn::make(),
                ActiveColumn::make(),
                TextColumn::make('cost')->label(trans('ecommerce::ecommerce.money.cost'))->toggleable(),
                TextColumn::make('description')->label(trans('public.description'))->toggleable(),
                ...TimestampColumns::make(),
            ])
            ->filters([
                ActiveFilter::make(),
                AuthorFilter::make(EcommercePermission::Shipping),
                TimestampFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ActiveBulkAction::make(),
                ]),
            ]);
    }
}
