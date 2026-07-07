<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;

class PasswordInput
{
    /**
     * @return array
     */
    public static function make()
    {
        return [
            TextInput::make('password')
                ->password()
                ->label(trans('validation.attributes.password'))
                ->required() // فقط در حالت ایجاد الزامی
                ->visible(fn ($get, $context) => $context === 'create' || $get('change_password')) // در حالت ویرایش فقط وقتی چک‌باکس فعال باشه نمایش داده میشه
                ->dehydrateStateUsing(fn ($state) => !empty($state) ? Hash::make($state) : null)
                ->dehydrated(fn ($state) => filled($state)), // فقط وقتی مقدار داده شده ذخیره بشه

            Checkbox::make('change_password')
                ->label(trans('public.password.edit'))
                ->reactive()
                ->hidden(fn ($context) => $context === 'create')
            ->columnSpanFull(),
        ];
    }
}
