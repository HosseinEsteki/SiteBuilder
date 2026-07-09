<?php

namespace Theme\Builder;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Arr;
use JsonException;

class ThemeRenderer
{
    public function __construct(
        private readonly BlockRegistry $blocks,
        private readonly ViewFactory $views,
    ) {
    }

    public function render(array|string|null $builderData): string
    {
        $blocks = $this->normalizeBuilderData($builderData);

        if ($blocks === []) {
            return '';
        }

        return collect($blocks)
            ->map(fn ($block): string => $this->renderBlock($block))
            ->implode('');
    }

    private function renderBlock(mixed $block): string
    {
        if (! is_array($block)) {
            return '';
        }

        $type = Arr::get($block, 'type');
        if (! is_string($type)) {
            return '';
        }

        $definition = $this->blocks->get($type);
        if ($definition === null || ! $this->views->exists($definition['view'])) {
            return '';
        }

        $blockData = is_array($block['data'] ?? null) ? $block['data'] : [];
        $blockSettings = is_array($block['settings'] ?? null) ? $block['settings'] : [];
        $dataSettings = is_array($blockData['settings'] ?? null) ? $blockData['settings'] : $blockData;

        $settings = array_replace(
            $definition['settings'] ?? [],
            $blockSettings,
            $dataSettings,
        );

        $children = is_array($block['children'] ?? null) ? $block['children'] : ($blockData['children'] ?? []);
        $children = is_array($children) ? $children : [];
        $childrenHtml = collect($children)
            ->map(fn ($child): string => $this->renderBlock($child))
            ->implode('');

        return $this->views->make($definition['view'], [
            'block' => $block,
            'definition' => $definition,
            'settings' => $settings,
            'childrenHtml' => $childrenHtml,
        ])->render();
    }

    private function normalizeBuilderData(array|string|null $builderData): array
    {
        if ($builderData === null || $builderData === '') {
            return [];
        }

        if (is_array($builderData)) {
            return array_is_list($builderData) ? $builderData : [];
        }

        try {
            $decoded = json_decode($builderData, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            return [];
        }

        return is_array($decoded) && array_is_list($decoded) ? $decoded : [];
    }
}
