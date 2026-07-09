<?php

use Theme\Builder\ThemeRenderer;

it('renders a heading block', function () {
    $html = app(ThemeRenderer::class)->render([
        [
            'type' => 'heading',
            'settings' => [
                'text' => 'Welcome to SiteBuilder',
                'level' => 'h1',
                'align' => 'center',
            ],
        ],
    ]);

    expect($html)->toContain('<h1')
        ->and($html)->toContain('Welcome to SiteBuilder')
        ->and($html)->toContain('text-align: center');
});

it('renders and escapes a text block', function () {
    $html = app(ThemeRenderer::class)->render([
        [
            'type' => 'text',
            'settings' => [
                'text' => '<script>alert("x")</script>',
            ],
        ],
    ]);

    expect($html)->toContain('&lt;script&gt;alert(&quot;x&quot;)&lt;/script&gt;')
        ->and($html)->not->toContain('<script>alert');
});

it('renders a button block', function () {
    $html = app(ThemeRenderer::class)->render([
        [
            'type' => 'button',
            'settings' => [
                'text' => 'Start',
                'url' => '/start',
                'align' => 'center',
            ],
        ],
    ]);

    expect($html)->toContain('href="/start"')
        ->and($html)->toContain('Start')
        ->and($html)->toContain('text-align: center');
});

it('ignores unknown block types', function () {
    $html = app(ThemeRenderer::class)->render([
        [
            'type' => 'does-not-exist',
            'settings' => [
                'text' => 'Hidden',
            ],
        ],
    ]);

    expect($html)->toBe('');
});

it('renders empty builder data safely', function () {
    expect(app(ThemeRenderer::class)->render(null))->toBe('')
        ->and(app(ThemeRenderer::class)->render([]))->toBe('')
        ->and(app(ThemeRenderer::class)->render(''))->toBe('');
});
