<?php

namespace App\Filament\Resources\ThemeBuilder\Templates\Pages;

use App\Filament\Resources\ThemeBuilder\Templates\ThemeTemplateResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListThemeTemplates extends ListRecords
{
    protected static string $resource = ThemeTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
