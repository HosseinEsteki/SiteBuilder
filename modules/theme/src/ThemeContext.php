<?php

namespace Theme;

use Theme\Models\Theme;
use Theme\Models\ThemeTemplate;

final class ThemeContext
{
    public function __construct(
        public readonly Theme $theme,
        public readonly ?ThemeTemplate $header = null,
        public readonly ?ThemeTemplate $footer = null,
    ) {
    }

    public function settings(): array
    {
        return $this->theme->settings ?? [];
    }
}
