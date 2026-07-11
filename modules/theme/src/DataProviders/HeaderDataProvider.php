<?php

namespace Theme\DataProviders;

class HeaderDataProvider
{
    public function provide(array $settings = []): array
    {
        $cart = session('cart', []);

        return [
            'cart' => ['count' => is_array($cart) ? array_sum(array_map(fn ($item) => (int) ($item['quantity'] ?? 0), $cart)) : 0],
            'cartCount' => is_array($cart) ? array_sum(array_map(fn ($item) => (int) ($item['quantity'] ?? 0), $cart)) : 0,
        ];
    }
}
