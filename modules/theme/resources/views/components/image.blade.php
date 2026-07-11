@props(['src', 'alt' => '', 'loading' => 'lazy', 'width' => null, 'height' => null])
<img src="{{ $src }}" alt="{{ $alt }}" loading="{{ $loading }}" @if($width) width="{{ $width }}" @endif @if($height) height="{{ $height }}" @endif {{ $attributes->class('theme-image') }}>
