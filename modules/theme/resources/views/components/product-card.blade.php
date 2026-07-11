@props([
    'product',
    'variant' => 'default',
    'showImage' => true,
    'showBrand' => true,
    'showRating' => false,
    'showDiscount' => true,
    'showStock' => true,
    'showButton' => true,
])
@php
    $variant = in_array($variant, ['default', 'compact', 'horizontal'], true) ? $variant : 'default';
    $image = $product->thumbnail_url ?: null;
    $regularPrice = is_numeric($product->price) ? (float) $product->price : null;
    $salePrice = is_numeric($product->sale_price) ? (float) $product->sale_price : null;
    $hasDiscount = $showDiscount && $regularPrice > 0 && $salePrice !== null && $salePrice < $regularPrice;
    $currentPrice = $hasDiscount ? $salePrice : $regularPrice;
    $oldPrice = $hasDiscount ? $regularPrice : null;
    $discount = $hasDiscount ? (int) round((($regularPrice - $salePrice) / $regularPrice) * 100) : null;
    $information = $product->short_information ?? $product->short_description ?? $product->summary ?? null;
    $rating = $product->rating ?? $product->average_rating ?? null;
    $inStock = (int) ($product->stock ?? 0) > 0;
    $cardClasses = ['theme-product-card', 'theme-product-card--'.$variant];
@endphp
<x-theme::card {{ $attributes->class($cardClasses) }} data-product-card data-variant="{{ $variant }}">
    @if($showImage)
        <div class="theme-product-card__media">
            @if($image)
                <x-theme::image :src="$image" :alt="$product->name" />
            @else
                <div class="theme-product-card__placeholder" data-placeholder-image role="img" aria-label="تصویر محصول موجود نیست"><span aria-hidden="true">◇</span></div>
            @endif
        </div>
    @endif
    @if($hasDiscount)<x-theme::badge class="theme-product-card__badge">{{ $discount }}٪ تخفیف</x-theme::badge>@endif
    <div class="theme-card__body theme-product-card__body">
        <div class="theme-product-card__meta">
            @if($showBrand && $product->brand)<span class="theme-product-card__brand">{{ $product->brand->name }}</span>@endif
            @if($showRating && $rating !== null)<span class="theme-product-card__rating" aria-label="امتیاز {{ $rating }} از ۵">★ {{ number_format((float) $rating, 1) }}</span>@endif
        </div>
        <h3 class="theme-product-card__title">{{ $product->name }}</h3>
        @if($information)<p class="theme-product-card__information">{{ $information }}</p>@endif
        @if($currentPrice !== null)<x-theme::price :price="$currentPrice" :old-price="$oldPrice" />@endif
        @if($showStock)<span class="theme-product-card__stock {{ $inStock ? 'is-in-stock' : 'is-out-of-stock' }}">{{ $inStock ? 'موجود در انبار' : 'ناموجود' }}</span>@endif
        <div class="theme-product-card__actions">
            @if($showButton)<x-theme::button class="theme-product-card__action" data-cart-action data-product-id="{{ $product->id }}" :disabled="!$inStock">افزودن به سبد خرید</x-theme::button>@endif
            <button class="theme-product-card__wishlist" type="button" disabled aria-label="افزودن به علاقه‌مندی‌ها (به‌زودی)" title="علاقه‌مندی‌ها به‌زودی" data-wishlist-placeholder>♡</button>
        </div>
    </div>
</x-theme::card>
