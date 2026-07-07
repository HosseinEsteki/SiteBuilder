<?php

namespace App\Filament\Resources\Ecommerce\Comments\Pages;

use App\Filament\Resources\Blog\Comments\CommentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
