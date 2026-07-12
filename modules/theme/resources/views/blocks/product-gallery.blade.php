@php($images = collect([$product->thumbnail_url])->filter()->merge($product->gallery_urls ?? [])->unique()->values())
@php($regular = is_numeric($product->price) ? (float) $product->price : 0)
@php($sale = is_numeric($product->sale_price) ? (float) $product->sale_price : $regular)
@php($discount = $regular > 0 && $sale < $regular ? (int) round((($regular - $sale) / $regular) * 100) : null)
<section class="theme-product-gallery" aria-label="تصاویر {{ $product->name }}" data-theme-block="product_gallery" style="--product-image-ratio: {{ in_array($settings['image_ratio'] ?? '1/1', ['1/1', '4/3', '3/4'], true) ? $settings['image_ratio'] : '1/1' }}; --product-image-fit: {{ ($settings['image_fit'] ?? 'contain') === 'cover' ? 'cover' : 'contain' }}">
    <div class="theme-product-gallery__primary">@if($images->isNotEmpty())<img src="{{ $images->first() }}" alt="{{ $product->name }}" fetchpriority="high">@else<div class="theme-product-gallery__placeholder" data-placeholder-image role="img" aria-label="تصویر محصول موجود نیست"><span aria-hidden="true">◇</span></div>@endif @if(($settings['show_discount_badge'] ?? true) && $discount)<x-theme::badge class="theme-product-gallery__badge">{{ $discount }}٪ تخفیف</x-theme::badge>@endif</div>
    @if(($settings['show_thumbnails'] ?? true) && $images->count() > 1)<div class="theme-product-gallery__thumbs" aria-label="تصاویر بیشتر">@foreach($images as $image)<a href="{{ $image }}" aria-label="نمایش تصویر {{ $loop->iteration }}"><img src="{{ $image }}" alt="" loading="lazy"></a>@endforeach</div>@endif
</section>
