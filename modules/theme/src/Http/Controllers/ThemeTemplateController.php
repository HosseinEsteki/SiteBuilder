<?php

namespace Theme\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Theme\Builder\ThemeRenderer;
use Theme\Services\ActiveThemeResolver;
use Theme\Services\TemplateResolver;
use Theme\ThemeContext;
use Ecommerce\Services\ProductArchiveService;
use Illuminate\Http\Request;

class ThemeTemplateController extends Controller
{
    public function __construct(
        private readonly ActiveThemeResolver $themes,
        private readonly TemplateResolver $templates,
        private readonly ThemeRenderer $renderer,
    ) {
    }

    public function homepage(): View
    {
        $theme = $this->themes->resolve();
        if ($theme === null) {
            return view('welcome');
        }

        $template = $this->templates->resolve($theme, 'homepage');
        $page = $theme->pages()->published()->where('slug', 'home')->first();
        abort_if($template === null && $page === null, 404);

        $header = $this->templates->resolve($theme, 'header');
        $footer = $this->templates->resolve($theme, 'footer');
        $context = new ThemeContext($theme, $header, $footer);

        return view('theme::templates.show', [
            'template' => $template,
            'themeContext' => $context,
            'renderedContent' => $this->renderer->render($page?->builder_data ?? $template?->builder_data),
            'renderedHeader' => $header ? $this->renderer->render($header->builder_data) : '',
            'renderedFooter' => $footer ? $this->renderer->render($footer->builder_data) : '',
            'metaTitle' => $page?->meta_title ?: ($page?->title ?? $template?->name),
            'metaDescription' => $theme->description,
        ]);
    }

    public function shop(Request $request, ProductArchiveService $archive): View
    {
        return $this->archiveView('product_archive', $archive->build($request));
    }

    public function archiveView(string $type, array $data): View
    {
        $theme = $this->themes->resolve();
        abort_if($theme === null, 404);
        $template = $this->templates->resolve($theme, $type);
        abort_if($template === null, 404);
        $header = $this->templates->resolve($theme, 'header');
        $footer = $this->templates->resolve($theme, 'footer');
        return view('theme::templates.show', [
            'template' => $template, 'themeContext' => new ThemeContext($theme, $header, $footer),
            'renderedContent' => $this->renderer->render($template->builder_data, $data),
            'renderedHeader' => $header ? $this->renderer->render($header->builder_data) : '',
            'renderedFooter' => $footer ? $this->renderer->render($footer->builder_data) : '',
            'metaTitle' => isset($data['searchQuery']) ? 'نتایج جستجو' : ($data['currentCategory']?->name ?? 'فروشگاه'),
            'metaDescription' => isset($data['searchQuery']) ? 'جستجوی محصولات فروشگاه' : ($data['currentCategory']?->description ?? 'محصولات فروشگاه'),
        ]);
    }
}
