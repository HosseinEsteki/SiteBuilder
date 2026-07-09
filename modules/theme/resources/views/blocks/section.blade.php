@php
    $paddingTop = max(0, (int) ($settings['padding_top'] ?? 0));
    $paddingBottom = max(0, (int) ($settings['padding_bottom'] ?? 0));
    $backgroundColor = $settings['background_color'] ?? '#ffffff';
@endphp

<section style="background-color: {{ $backgroundColor }}; padding-top: {{ $paddingTop }}px; padding-bottom: {{ $paddingBottom }}px;">
    {!! $childrenHtml !!}
</section>
