<?php

namespace App\Filament\Resources\Blog\Articles\Pages;

use App\Filament\Resources\Blog\Articles\ArticleResource;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
