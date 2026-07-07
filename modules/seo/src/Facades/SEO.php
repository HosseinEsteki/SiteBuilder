<?php

namespace Seo\Facades;

use Illuminate\Support\Facades\Facade;

class SEO extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'seo';
    }
}
