<nav class="theme-product-breadcrumbs" aria-label="مسیر صفحه" data-theme-block="product_breadcrumbs">
    <ol><li><a href="{{ route('theme.homepage') }}">خانه</a></li><li><a href="{{ route('products.index') }}">فروشگاه</a></li>@if(($settings['show_category'] ?? true) && $product->category)<li><a href="{{ route('product-categories.show', $product->category->slug ?: $product->category) }}">{{ $product->category->name }}</a></li>@endif<li aria-current="page">{{ $product->name }}</li></ol>
</nav>
