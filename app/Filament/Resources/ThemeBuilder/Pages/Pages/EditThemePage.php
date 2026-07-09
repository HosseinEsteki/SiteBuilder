<?php

namespace App\Filament\Resources\ThemeBuilder\Pages\Pages;

use App\Filament\Resources\ThemeBuilder\Pages\ThemePageResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Theme\Models\ThemePage;

class EditThemePage extends EditRecord
{
    protected static string $resource = ThemePageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('preview')
                ->url(fn (ThemePage $record): string => route('theme.pages.preview', $record))
                ->openUrlInNewTab(),
            DeleteAction::make(),
        ];
    }
}
