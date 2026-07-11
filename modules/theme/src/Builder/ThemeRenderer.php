<?php

namespace Theme\Builder;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Illuminate\Support\Arr;
use JsonException;
use Theme\Services\ThemeBlockResolver;

class ThemeRenderer
{
    public function __construct(
        private readonly BlockRegistry $blocks,
        private readonly ViewFactory $views,
        private readonly ThemeBlockResolver $data,
    ) {
    }

    public function render(array|string|null $builderData, array $context = []): string
    {
        $blocks = $this->normalizeBuilderData($builderData);

        if ($blocks === []) {
            return '';
        }

        return collect($blocks)
            ->map(fn ($block): string => $this->renderBlock($block, $context))
            ->implode('');
    }

    private function renderBlock(mixed $block, array $context = []): string
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
            ->map(fn ($child): string => $this->renderBlock($child, $context))
            ->implode('');

        return $this->views->make($definition['view'], array_merge([
            'block' => $block,
            'definition' => $definition,
            'settings' => $settings,
            'childrenHtml' => $childrenHtml,
        ], $context, $this->data->resolve($type, $settings, $context)))->render();
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
