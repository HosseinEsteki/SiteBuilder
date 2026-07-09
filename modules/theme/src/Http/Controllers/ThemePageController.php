<?php

namespace Theme\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Theme\Builder\ThemeRenderer;
use Theme\Enums\ThemePermission;
use Theme\Models\ThemePage;

class ThemePageController extends Controller
{
    public function __construct(
        private readonly ThemeRenderer $renderer,
    ) {
    }

    public function show(string $slug): View
    {
        $page = ThemePage::query()
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return $this->renderPage($page, false);
    }

    public function preview(ThemePage $page): View
    {
        abort_unless(
            auth()->user()?->can(ThemePermission::PageView->value) || auth()->user()?->can(ThemePermission::PageUpdate->value),
            403,
        );

        return $this->renderPage($page, true);
    }

    private function renderPage(ThemePage $page, bool $preview): View
    {
        return view($preview ? 'theme::pages.preview' : 'theme::pages.show', [
            'page' => $page,
            'renderedContent' => $this->renderer->render($page->builder_data),
            'metaTitle' => $page->meta_title ?: $page->title,
            'metaDescription' => $page->meta_description ?: $page->excerpt,
        ]);
    }
}
