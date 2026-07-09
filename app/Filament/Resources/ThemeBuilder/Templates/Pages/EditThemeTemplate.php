<?php

namespace App\Filament\Resources\ThemeBuilder\Templates\Pages;

use App\Filament\Resources\ThemeBuilder\Templates\ThemeTemplateResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditThemeTemplate extends EditRecord
{
    protected static string $resource = ThemeTemplateResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
