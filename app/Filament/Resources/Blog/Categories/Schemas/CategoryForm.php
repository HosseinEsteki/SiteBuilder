<?php

namespace App\Filament\Resources\Blog\Categories\Schemas;

use App\Filament\Components\Inputs\KeywordsInput;
use App\Filament\Components\Inputs\NameInput;
use App\Filament\Components\Inputs\SlugInput;
use Blog\Models\Category;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                NameInput::make(),
                SlugInput::make(),
                Textarea::make('description')->label(trans('public.description'))
                    ->default(null)
                    ->columnSpanFull(),
                KeywordsInput::make(new Category),

            ]);
    }
}
