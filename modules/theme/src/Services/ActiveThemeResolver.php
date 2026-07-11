<?php

namespace Theme\Services;

use Theme\Models\Theme;

class ActiveThemeResolver
{
    private ?Theme $resolved = null;

    public function resolve(): ?Theme
    {
        return $this->resolved ??= Theme::query()->active()->first();
    }

    public function get(): ?Theme
    {
        return $this->resolve();
    }
}
