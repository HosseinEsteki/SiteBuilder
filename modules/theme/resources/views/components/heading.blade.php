@props(['level' => 2, 'size' => 'lg'])
@php($tag = 'h'.min(6, max(1, (int) $level)))
<{{ $tag }} {{ $attributes->class(['theme-heading', 'theme-heading--'.$size]) }}>{{ $slot }}</{{ $tag }}>
