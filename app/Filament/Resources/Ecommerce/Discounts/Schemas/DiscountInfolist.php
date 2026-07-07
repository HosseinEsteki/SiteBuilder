<?php

namespace App\Filament\Resources\Ecommerce\Discounts\Schemas;

use Filament\Schemas\Schema;
use Filament\Tables\Table;

class DiscountInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                //TODO:: ایده ای که دارم اینه که اولش اطلاعات تخفیف نمایش داده بشه و بعدش لیست افرادی که از این کد استفاده کردن نمایش بدیم.
            ]);
    }
}
