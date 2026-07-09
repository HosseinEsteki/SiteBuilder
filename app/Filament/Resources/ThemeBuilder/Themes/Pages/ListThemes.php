<?php

namespace App\Filament\Resources\ThemeBuilder\Themes\Pages;

use App\Filament\Resources\ThemeBuilder\Themes\ThemeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListThemes extends ListRecords
{
    protected static string $resource = ThemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
