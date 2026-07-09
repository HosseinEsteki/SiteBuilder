<?php

namespace App\Filament\Resources\ThemeBuilder\Themes;

use App\Filament\Resources\ThemeBuilder\Themes\Pages\CreateTheme;
use App\Filament\Resources\ThemeBuilder\Themes\Pages\EditTheme;
use App\Filament\Resources\ThemeBuilder\Themes\Pages\ListThemes;
use App\Filament\Resources\ThemeBuilder\Themes\Schemas\ThemeForm;
use App\Filament\Resources\ThemeBuilder\Themes\Tables\ThemesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Theme\Enums\ThemePermission;
use Theme\Models\Theme;

class ThemeResource extends Resource
{
    protected static ?string $model = Theme::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSwatch;

    protected static string|null|\UnitEnum $navigationGroup = 'Theme Builder';

    protected static ?string $modelLabel = 'Theme';

    protected static ?string $pluralLabel = 'Themes';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ThemeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThemesTable::configure($table);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can(ThemePermission::ThemeView->value) || auth()->user()?->can(ThemePermission::SettingsView->value) || false;
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can(ThemePermission::ThemeCreate->value) || false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can(ThemePermission::ThemeUpdate->value) || auth()->user()?->can(ThemePermission::SettingsUpdate->value) || false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can(ThemePermission::ThemeDelete->value) || false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can(ThemePermission::ThemeDelete->value) || false;
    }

    public static function canReorder(): bool
    {
        return auth()->user()?->can(ThemePermission::ThemeUpdate->value) || false;
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListThemes::route('/'),
            'create' => CreateTheme::route('/create'),
            'edit' => EditTheme::route('/{record}/edit'),
        ];
    }
}
