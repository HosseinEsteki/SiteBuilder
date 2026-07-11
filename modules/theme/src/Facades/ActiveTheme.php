<?php

namespace Theme\Facades;

use Illuminate\Support\Facades\Facade;
use Theme\Models\Theme;

/** @method static Theme|null resolve() */
class ActiveTheme extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'theme.active';
    }
}
