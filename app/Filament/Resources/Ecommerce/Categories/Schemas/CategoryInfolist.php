<?php

namespace App\Filament\Resources\Ecommerce\Categories\Schemas;

use App\Filament\Components\Entries\AuthorEntry;
use App\Filament\Components\Entries\DescriptionEntry;
use App\Filament\Components\Entries\ImageEntry;
use App\Filament\Components\Entries\NameAndSlugEntries;
use App\Filament\Components\Entries\TimestampEntries;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('ecommerce.category'),
                ...NameAndSlugEntries::make(),
                DescriptionEntry::make(),
                AuthorEntry::make(),
                ...TimestampEntries::make()
            ]);
    }
}
