<?php

namespace Theme\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Theme\Builder\ThemeRenderer;
use Theme\Services\ActiveThemeResolver;
use Theme\Services\TemplateResolver;
use Theme\ThemeContext;

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
        abort_if($theme === null, 404);

        $template = $this->templates->resolve($theme, 'homepage');
        abort_if($template === null, 404);

        $header = $this->templates->resolve($theme, 'header');
        $footer = $this->templates->resolve($theme, 'footer');
        $context = new ThemeContext($theme, $header, $footer);

        return view('theme::templates.show', [
            'template' => $template,
            'themeContext' => $context,
            'renderedContent' => $this->renderer->render($template->builder_data),
            'renderedHeader' => $header ? $this->renderer->render($header->builder_data) : '',
            'renderedFooter' => $footer ? $this->renderer->render($footer->builder_data) : '',
            'metaTitle' => $template->name,
            'metaDescription' => $theme->description,
        ]);
    }
}
