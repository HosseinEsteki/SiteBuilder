<section class="theme-purchase-panel" data-theme-block="purchase_panel">
    @if($settings['show_stock'] ?? true)<p>{{ $product->stock > 0 ? 'آماده ارسال' : 'این محصول در حال حاضر موجود نیست' }}</p>@endif
    <label for="product-quantity-{{ $product->id }}">تعداد</label><input id="product-quantity-{{ $product->id }}" type="number" min="1" max="{{ max(1, (int) $product->stock) }}" value="1" inputmode="numeric" @disabled($product->stock <= 0)>
    <x-theme::button class="theme-purchase-panel__action" data-cart-action data-product-id="{{ $product->id }}" :disabled="$product->stock <= 0">{{ $settings['button_text'] ?? 'افزودن به سبد خرید' }}</x-theme::button>
</section>
