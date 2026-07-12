@php
    $items = $products ?? collect();
    $variant = in_array($settings['variant'] ?? 'default', ['default', 'compact', 'horizontal'], true) ? $settings['variant'] : 'default';
@endphp
<section class="theme-product-listing theme-container" data-theme-block="product_listing_grid">
    @if($settings['show_result_count'] ?? false)<p aria-live="polite">{{ number_format($resultCount ?? $items->count()) }} نتیجه</p>@endif
    @forelse($items as $product)
        @if($loop->first)<div class="theme-grid theme-product-grid archive-grid" style="--archive-desktop:{{ min(6,max(1,(int)($settings['desktop_columns']??4))) }};--archive-tablet:{{ min(4,max(1,(int)($settings['tablet_columns']??3))) }};--archive-mobile:{{ min(2,max(1,(int)($settings['mobile_columns']??2))) }}">@endif
        <x-theme::product-card :product="$product" :variant="$variant" :show-brand="$settings['show_brand'] ?? true" :show-discount="$settings['show_discount'] ?? true" :show-stock="$settings['show_stock'] ?? true" :show-button="$settings['show_button'] ?? false" />
        @if($loop->last)</div>@endif
    @empty
        <div class="theme-empty"><h2>{{ $settings['empty_title'] ?? 'محصولی یافت نشد' }}</h2>
            @if($settings['empty_description'] ?? null)<p>{{ $settings['empty_description'] }}</p>@endif
            @if(($searchQuery ?? null) !== null && $searchQuery !== '')<a href="{{ $canonicalSearchUrl }}">پاک کردن جستجو</a>@endif
        </div>
    @endforelse
    @if(method_exists($items, 'hasPages') && $items->hasPages())<nav class="theme-pagination" aria-label="صفحه‌بندی محصولات">{{ $items->onEachSide(1)->links() }}</nav>@endif
</section>
