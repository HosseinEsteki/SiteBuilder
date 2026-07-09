@php
    $align = in_array($settings['align'] ?? 'left', ['left', 'center', 'right'], true) ? $settings['align'] : 'left';
@endphp

<p style="text-align: {{ $align }};">{{ $settings['text'] ?? '' }}</p>
