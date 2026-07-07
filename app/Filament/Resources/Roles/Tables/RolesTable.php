<?php

namespace App\Filament\Resources\Roles\Tables;

use App\Filament\Components\Filters\TimestampFilter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(trans('permissions.role')),
                TextColumn::make('guard_name')->label(trans('permissions.Guard')),
                TextColumn::make('created_at')->label(trans('public.date.created_at'))->jalaliDateTime(),

            ])
            ->filters([
                TimestampFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
