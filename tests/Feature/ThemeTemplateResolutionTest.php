<?php

use Theme\Models\Theme;
use Theme\Models\ThemeTemplate;
use Theme\Services\TemplateResolver;

it('resolves the published default template by type', function () {
    $theme = Theme::query()->create(['name' => 'Commerce', 'slug' => 'commerce', 'is_active' => true]);
    ThemeTemplate::query()->create(['theme_id' => $theme->id, 'name' => 'Draft', 'slug' => 'draft-header', 'type' => 'header', 'status' => 'draft', 'is_default' => true]);
    $expected = ThemeTemplate::query()->create(['theme_id' => $theme->id, 'name' => 'Header', 'slug' => 'header', 'type' => 'header', 'status' => 'published', 'is_default' => true]);
    expect(app(TemplateResolver::class)->resolve($theme, 'header')->is($expected))->toBeTrue();
});

it('resolves a published template by slug', function () {
    $theme = Theme::query()->create(['name' => 'Commerce', 'slug' => 'commerce', 'is_active' => true]);
    $template = ThemeTemplate::query()->create(['theme_id' => $theme->id, 'name' => 'Special', 'slug' => 'special', 'type' => 'footer', 'status' => 'published']);
    expect(app(TemplateResolver::class)->resolve($theme, 'footer', 'special')->is($template))->toBeTrue();
});

it('does not resolve draft or mismatched templates', function () {
    $theme = Theme::query()->create(['name' => 'Commerce', 'slug' => 'commerce', 'is_active' => true]);
    ThemeTemplate::query()->create(['theme_id' => $theme->id, 'name' => 'Draft', 'slug' => 'draft', 'type' => 'header', 'status' => 'draft']);
    expect(app(TemplateResolver::class)->resolve($theme, 'header'))->toBeNull();
});
