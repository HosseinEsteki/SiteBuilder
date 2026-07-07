<?php

namespace App\Filament\Resources\Blog\Categories\Schemas;

use App\Filament\Components\Entries\AuthorEntry;
use App\Filament\Components\Entries\DescriptionEntry;
use App\Filament\Components\Entries\KeywordsEntry;
use App\Filament\Components\Entries\NameAndSlugEntries;
use App\Filament\Components\Entries\TimestampEntries;
use Filament\Schemas\Schema;

class CategoryInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ...NameAndSlugEntries::make(),
                DescriptionEntry::make(),
                KeywordsEntry::make(),
                AuthorEntry::make(),
                ...TimestampEntries::make(),
            ]);
    }
}
