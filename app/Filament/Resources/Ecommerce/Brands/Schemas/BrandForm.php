<?php

namespace App\Filament\Resources\Ecommerce\Brands\Schemas;

use App\Filament\Components\Inputs\ImageInput;
use App\Filament\Components\Inputs\NameInput;
use App\Filament\Components\Inputs\SlugInput;
use Ecommerce\Models\Brand;
use Filament\Schemas\Schema;

class BrandForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageInput::make(Brand::$thumbnailMedia),
                NameInput::make(),
                SlugInput::make(),
            ]);
    }
}
