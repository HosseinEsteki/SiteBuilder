@php($regular = is_numeric($product->price) ? (float) $product->price : null)
@php($sale = is_numeric($product->sale_price) && (float) $product->sale_price < $regular ? (float) $product->sale_price : null)
<section class="theme-product-detail-price" aria-label="قیمت محصول" data-theme-block="product_price">
    @if(($settings['show_price'] ?? true) && $regular !== null)<x-theme::price :price="$sale ?? $regular" :old-price="$sale !== null ? $regular : null" />@if($sale !== null)<x-theme::badge>{{ (int) round((($regular - $sale) / $regular) * 100) }}٪ تخفیف</x-theme::badge>@endif @else<p>قیمت در دسترس نیست</p>@endif
</section>
