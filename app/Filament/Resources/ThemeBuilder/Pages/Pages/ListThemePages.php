<?php

namespace App\Filament\Resources\ThemeBuilder\Pages\Pages;

use App\Filament\Resources\ThemeBuilder\Pages\ThemePageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListThemePages extends ListRecords
{
    protected static string $resource = ThemePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
