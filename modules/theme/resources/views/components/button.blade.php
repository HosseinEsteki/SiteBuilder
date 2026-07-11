@props(['href' => null, 'variant' => 'primary', 'type' => 'button', 'disabled' => false])
@php($classes = ['theme-button', 'theme-button--'.$variant])
@if($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>{{ $slot }}</a>
@else
    <button type="{{ $type }}" @disabled($disabled) {{ $attributes->class($classes) }}>{{ $slot }}</button>
@endif
