<?php

namespace App\Filament\Resources\Ecommerce\Shippings\Pages;

use App\Filament\Resources\Ecommerce\Shippings\ShippingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListShippings extends ListRecords
{
    protected static string $resource = ShippingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
