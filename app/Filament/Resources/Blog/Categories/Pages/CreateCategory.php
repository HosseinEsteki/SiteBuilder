<?php

namespace App\Filament\Resources\Blog\Categories\Pages;

use App\Filament\Resources\Blog\Categories\CategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;
}
