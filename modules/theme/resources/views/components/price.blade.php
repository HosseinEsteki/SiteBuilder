@props(['price', 'oldPrice' => null, 'currency' => 'تومان'])
<div {{ $attributes->class('theme-price') }}>
    @if($oldPrice !== null)<span class="theme-price__old">{{ number_format((float) $oldPrice) }}</span>@endif
    <span>{{ number_format((float) $price) }} <small>{{ $currency }}</small></span>
</div>
