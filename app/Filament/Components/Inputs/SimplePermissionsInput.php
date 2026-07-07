<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\CheckboxList;
use Filament\Schemas\Components\Fieldset;

class SimplePermissionsInput
{
    public static function make()
    {
        return Fieldset::make('دسترسی‌ها')
            ->schema([
                CheckboxList::make('permissions')
                    ->relationship('permissions', 'name')
                    ->getOptionLabelFromRecordUsing(fn($record) => $record->label)
                    ->label(trans('permissions.permissions'))
                    ->columns(4)
                    ->columnSpanFull()
            ])
            ->columns(2)
            ->columnSpanFull();
    }
}
