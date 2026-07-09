<?php

namespace Theme\Enums;

enum ThemePermission: string
{
    case ThemeView = 'theme.themes.view';
    case ThemeCreate = 'theme.themes.create';
    case ThemeUpdate = 'theme.themes.update';
    case ThemeDelete = 'theme.themes.delete';

    case TemplateView = 'theme.templates.view';
    case TemplateCreate = 'theme.templates.create';
    case TemplateUpdate = 'theme.templates.update';
    case TemplateDelete = 'theme.templates.delete';

    case PageView = 'theme.pages.view';
    case PageCreate = 'theme.pages.create';
    case PageUpdate = 'theme.pages.update';
    case PageDelete = 'theme.pages.delete';
    case PagePublish = 'theme.pages.publish';

    case SettingsView = 'theme.settings.view';
    case SettingsUpdate = 'theme.settings.update';

    public static function getPermissionNames()
    {
        return collect(self::cases())->map(fn (self $permission): string => $permission->value);
    }
}
