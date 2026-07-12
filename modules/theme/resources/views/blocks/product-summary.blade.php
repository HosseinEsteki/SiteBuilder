<section class="theme-product-summary" data-theme-block="product_summary">
    <div class="theme-product-summary__eyebrow">@if(($settings['show_brand'] ?? true) && $product->brand)<span>{{ $product->brand->name }}</span>@endif @if(($settings['show_category'] ?? true) && $product->category)<span>{{ $product->category->name }}</span>@endif</div>
    <h1>{{ $product->name }}</h1>
    @if(($settings['show_sku'] ?? true) && filled($product->sku ?? null))<p><span>شناسه محصول:</span> <bdi>{{ $product->sku }}</bdi></p>@endif
    @if(($settings['show_short_description'] ?? true) && ($product->short_information ?? null))<p>{{ $product->short_information }}</p>@endif
    @if($settings['show_stock'] ?? true)<p class="theme-product-stock {{ $product->stock > 0 ? 'is-in-stock' : 'is-out-of-stock' }}">{{ $product->stock > 0 ? 'موجود در انبار' : 'ناموجود' }}</p>@endif
</section>
