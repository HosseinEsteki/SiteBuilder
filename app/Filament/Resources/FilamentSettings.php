<?php

namespace App\Filament\Resources;

class FilamentSettings
{
    public static function BlogArticleSetting(): array
    {
        $navigationGroup=trans('filament-settings.blog.article.navigationGroup');
        $recordTitleAttribute=trans('filament-settings.blog.article.recordTitleAttribute');
        $pluralLabel=trans('filament-settings.blog.article.pluralLabel');
        $modelLabel=trans('filament-settings.blog.article.modelLabel');
        return compact('navigationGroup', 'recordTitleAttribute', 'pluralLabel', 'modelLabel');
    }
}
