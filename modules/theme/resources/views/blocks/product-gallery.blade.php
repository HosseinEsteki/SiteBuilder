@php($images = collect([$product->thumbnail_url])->filter()->merge($product->gallery_urls ?? [])->unique()->values())
<section class="theme-product-gallery theme-product-gallery--{{ $settings['layout'] ?? 'vertical' }}" aria-label="تصاویر {{ $product->name }}" data-theme-block="product_gallery">
    <div class="theme-product-gallery__primary">@if($images->isNotEmpty())<img src="{{ $images->first() }}" alt="{{ $product->name }}" fetchpriority="high">@else<div class="theme-product-gallery__placeholder" data-placeholder-image role="img" aria-label="تصویر محصول موجود نیست"><span aria-hidden="true">◇</span></div>@endif</div>
    @if(($settings['show_thumbnails'] ?? true) && $images->count() > 1)<div class="theme-product-gallery__thumbs" aria-label="تصاویر بیشتر">@foreach($images as $image)<a href="{{ $image }}" aria-label="نمایش تصویر {{ $loop->iteration }}"><img src="{{ $image }}" alt="" loading="lazy"></a>@endforeach</div>@endif
</section>
