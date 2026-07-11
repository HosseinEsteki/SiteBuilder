<?php

use Theme\Models\Theme;
use Theme\Services\ActiveThemeResolver;
use Theme\ThemeContext;

it('resolves the active theme', function () {
    Theme::query()->create(['name' => 'Inactive', 'slug' => 'inactive', 'is_active' => false]);
    $active = Theme::query()->create(['name' => 'Commerce', 'slug' => 'commerce', 'is_active' => true, 'settings' => ['primary_color' => '#123456']]);
    expect(app(ActiveThemeResolver::class)->resolve()->is($active))->toBeTrue();
});

it('returns null when no theme is active', function () {
    expect(app(ActiveThemeResolver::class)->resolve())->toBeNull();
});

it('exposes theme settings through context', function () {
    $theme = Theme::query()->create(['name' => 'Commerce', 'slug' => 'commerce', 'is_active' => true, 'settings' => ['primary_color' => '#123456']]);
    $context = new ThemeContext($theme);
    expect($context->theme->is($theme))->toBeTrue()->and($context->settings())->toBe(['primary_color' => '#123456']);
});
