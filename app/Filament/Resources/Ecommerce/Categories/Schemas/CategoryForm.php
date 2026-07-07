<?php

namespace App\Filament\Resources\Ecommerce\Categories\Schemas;

use App\Filament\Components\Inputs\KeywordsInput;
use Ecommerce\Models\Category;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryFileUpload::make('ecommerce.category')
                    ->required()
                    ->label(trans('public.picture'))
                    ->columnSpanFull(),
                TextInput::make('name')
                    ->label(trans('name'))
                    ->required(),
                TextInput::make('slug')
                    ->label(trans('public.slug'))
                    ->required(),
                KeywordsInput::make(new Category()),
                Textarea::make('description')
                    ->label(trans('public.description'))
                    ->columnSpanFull(),
            ]);
    }
}
