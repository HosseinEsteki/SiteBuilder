<?php

namespace App\Filament\Components\Inputs;

use Filament\Forms\Components\Select;

class BrandInput
{
    public static function make()
    {
        return Select::make('brand_id')
            ->label(trans('ecommerce::ecommerce.brand.label'))
            ->relationship('brand', 'name')
            ->searchable()
            ->preload()
            ->createOptionForm([
                NameInput::make(),
                SlugInput::make(),
                DescriptionInput::make(),
            ])
            ->createOptionAction(fn($action) => $action->modalHeading(trans('ecommerce::ecommerce.brand.create')))
                ->required();
    }
}
