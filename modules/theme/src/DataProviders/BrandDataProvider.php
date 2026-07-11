<?php

namespace Theme\DataProviders;

use Ecommerce\Models\Brand;

class BrandDataProvider
{
    public function provide(array $settings = []): array
    {
        $limit = min(24, max(1, (int) ($settings['limit'] ?? 12)));

        return ['brands' => Brand::query()->orderBy('name')->limit($limit)->get()];
    }
}
