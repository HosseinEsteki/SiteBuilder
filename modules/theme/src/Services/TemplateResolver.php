<?php

namespace Theme\Services;

use Theme\Models\Theme;
use Theme\Models\ThemeTemplate;

class TemplateResolver
{
    public function resolve(Theme $theme, string $type, ?string $slug = null): ?ThemeTemplate
    {
        return $theme->templates()
            ->published()
            ->where('type', $type)
            ->when($slug, fn ($query) => $query->where('slug', $slug))
            ->orderByDesc('is_default')
            ->first();
    }
}
