<?php

namespace App\Filament\Resources\ThemeBuilder\Themes\Pages;

use App\Filament\Resources\ThemeBuilder\Themes\ThemeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTheme extends EditRecord
{
    protected static string $resource = ThemeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
