<?php

use Theme\Database\Seeders\ThemeSeeder;
use Theme\Models\Theme;
use Theme\Models\ThemePage;
use Theme\Models\ThemeTemplate;

beforeEach(fn () => app(ThemeSeeder::class)->run());

it('seeds one active theme with settings', function () {
    $theme = Theme::query()->active()->firstOrFail();
    expect($theme->slug)->not->toBeEmpty()->and($theme->settings)->toBeArray();
});

it('seeds published default header and footer templates', function () {
    expect(ThemeTemplate::query()->where('type', 'header')->published()->where('is_default', true)->exists())->toBeTrue()
        ->and(ThemeTemplate::query()->where('type', 'footer')->published()->where('is_default', true)->exists())->toBeTrue();
});

it('seeds a published homepage', function () {
    $page = ThemePage::query()->published()->where('slug', 'home')->firstOrFail();
    expect($page->builder_data)->toBeArray()->and($page->published_at)->not->toBeNull();
});

it('keeps seeding idempotent', function () {
    $counts = [Theme::count(), ThemeTemplate::count(), ThemePage::count()];
    app(ThemeSeeder::class)->run();
    expect([Theme::count(), ThemeTemplate::count(), ThemePage::count()])->toBe($counts);
});
