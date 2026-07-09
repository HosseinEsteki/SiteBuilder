<?php

namespace App\Filament\Resources\ThemeBuilder\Templates;

use App\Filament\Resources\ThemeBuilder\Templates\Pages\CreateThemeTemplate;
use App\Filament\Resources\ThemeBuilder\Templates\Pages\EditThemeTemplate;
use App\Filament\Resources\ThemeBuilder\Templates\Pages\ListThemeTemplates;
use App\Filament\Resources\ThemeBuilder\Templates\Schemas\ThemeTemplateForm;
use App\Filament\Resources\ThemeBuilder\Templates\Tables\ThemeTemplatesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Theme\Enums\ThemePermission;
use Theme\Models\ThemeTemplate;

class ThemeTemplateResource extends Resource
{
    protected static ?string $model = ThemeTemplate::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

    protected static string|null|\UnitEnum $navigationGroup = 'Theme Builder';

    protected static ?string $modelLabel = 'Template';

    protected static ?string $pluralLabel = 'Templates';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ThemeTemplateForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThemeTemplatesTable::configure($table);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can(ThemePermission::TemplateView->value) || false;
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can(ThemePermission::TemplateCreate->value) || false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can(ThemePermission::TemplateUpdate->value) || false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can(ThemePermission::TemplateDelete->value) || false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can(ThemePermission::TemplateDelete->value) || false;
    }

    public static function canReorder(): bool
    {
        return auth()->user()?->can(ThemePermission::TemplateUpdate->value) || false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListThemeTemplates::route('/'),
            'create' => CreateThemeTemplate::route('/create'),
            'edit' => EditThemeTemplate::route('/{record}/edit'),
        ];
    }
}
