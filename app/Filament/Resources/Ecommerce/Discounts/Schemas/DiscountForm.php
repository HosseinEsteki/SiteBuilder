<?php

namespace App\Filament\Resources\Ecommerce\Discounts\Schemas;

use App\Filament\Components\Inputs\ActiveInput;
use App\Filament\Components\Inputs\Discount\DiscountStartEndDateInputs;
use Ecommerce\Enums\DiscountType;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class DiscountForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(trans('ecommerce::ecommerce.discount.title'))
                    ->required(),
                Select::make('type')
                    ->label(trans('ecommerce::ecommerce.discount.type'))
                    ->options(DiscountType::options())
                    ->required(),
                Fieldset::make(trans('ecommerce::ecommerce.discount.conditions.label'))
                    ->schema([
                        //TODO: اینجا باید درست بشه
//                      {"min_total":137778,"min_items":3}
                        TextInput::make('conditions[min_total]')
                            ->label(trans('ecommerce::ecommerce.discount.conditions.min_total'))
                        ->prefix(trans('ecommerce::ecommerce.money.currency')),
                        TextInput::make('conditions[min_items]')
                            ->numeric()
                            ->label(trans('ecommerce::ecommerce.discount.conditions.min_items')),
                    ]),
                TextInput::make('value')
                    ->label(trans('ecommerce::ecommerce.discount.value'))
                    ->numeric(),
                ...DiscountStartEndDateInputs::make(),
                TextInput::make('usage_limit')
                    ->label(trans('ecommerce::ecommerce.discount.usage_limit'))
                    ->numeric(),
                ActiveInput::make(),
            ]);
    }
}
