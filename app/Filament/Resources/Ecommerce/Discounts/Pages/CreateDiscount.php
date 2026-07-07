<?php

namespace App\Filament\Resources\Ecommerce\Discounts\Pages;

use App\Filament\Resources\Ecommerce\Discounts\DiscountResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDiscount extends CreateRecord
{
    protected static string $resource = DiscountResource::class;
}
