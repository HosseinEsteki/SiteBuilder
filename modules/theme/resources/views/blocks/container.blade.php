@php
    $width = match ($settings['width'] ?? 'lg') {
        'sm' => '720px',
        'md' => '960px',
        'xl' => '1280px',
        default => '1120px',
    };
@endphp

<div style="max-width: {{ $width }}; margin-left: auto; margin-right: auto; padding-left: 16px; padding-right: 16px;">
    {!! $childrenHtml !!}
</div>
