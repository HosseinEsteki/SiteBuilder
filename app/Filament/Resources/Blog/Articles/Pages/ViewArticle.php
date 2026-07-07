<?php

namespace App\Filament\Resources\Blog\Articles\Pages;

use App\Filament\Resources\Blog\Articles\ArticleResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewArticle extends ViewRecord
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
