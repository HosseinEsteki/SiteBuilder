<?php

namespace App\Filament\Resources\Ecommerce\Shippings\Schemas;

use App\Filament\Components\Inputs\ActiveInput;
use App\Filament\Components\Inputs\DescriptionInput;
use App\Filament\Components\Inputs\NameInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ShippingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                NameInput::make(),
                TextInput::make('cost')
                    ->label(trans('ecommerce::ecommerce.money.cost'))
                    ->numeric()
                    ->required(),
                DescriptionInput::make(),
                ActiveInput::make(),
            ]);
    }
}
