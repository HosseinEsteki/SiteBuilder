<?php

namespace App\Filament\Resources\ThemeBuilder\Pages;

use App\Filament\Resources\ThemeBuilder\Pages\Pages\CreateThemePage;
use App\Filament\Resources\ThemeBuilder\Pages\Pages\EditThemePage;
use App\Filament\Resources\ThemeBuilder\Pages\Pages\ListThemePages;
use App\Filament\Resources\ThemeBuilder\Pages\Schemas\ThemePageForm;
use App\Filament\Resources\ThemeBuilder\Pages\Tables\ThemePagesTable;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Theme\Enums\ThemePermission;
use Theme\Models\ThemePage;

class ThemePageResource extends Resource
{
    protected static ?string $model = ThemePage::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocument;

    protected static string|null|\UnitEnum $navigationGroup = 'Theme Builder';

    protected static ?string $modelLabel = 'Page';

    protected static ?string $pluralLabel = 'Pages';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return ThemePageForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ThemePagesTable::configure($table);
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canViewAny();
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->can(ThemePermission::PageView->value) || false;
    }

    public static function canView(Model $record): bool
    {
        return static::canViewAny();
    }

    public static function canCreate(): bool
    {
        return auth()->user()?->can(ThemePermission::PageCreate->value) || false;
    }

    public static function canEdit(Model $record): bool
    {
        return auth()->user()?->can(ThemePermission::PageUpdate->value) || false;
    }

    public static function canDelete(Model $record): bool
    {
        return auth()->user()?->can(ThemePermission::PageDelete->value) || false;
    }

    public static function canDeleteAny(): bool
    {
        return auth()->user()?->can(ThemePermission::PageDelete->value) || false;
    }

    public static function canReorder(): bool
    {
        return auth()->user()?->can(ThemePermission::PageUpdate->value) || false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListThemePages::route('/'),
            'create' => CreateThemePage::route('/create'),
            'edit' => EditThemePage::route('/{record}/edit'),
        ];
    }
}
