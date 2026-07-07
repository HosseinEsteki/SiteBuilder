<?php

namespace App\Filament\Resources\Settings\Schemas;

use App\Models\Organization;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('key')
                    ->label(trans('organization.key'))
                ->formatStateUsing(fn ($record) => $record->name_label),
                TextEntry::make('category')
                    ->label(trans('organization.category'))
                    ->formatStateUsing(fn ($record) => $record->category_label),
                TextInput::make('value')
                    ->label(trans('organization.value')),
            ]);
    }
}
