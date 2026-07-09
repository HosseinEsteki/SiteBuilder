@php
    $level = in_array($settings['level'] ?? 'h2', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true) ? $settings['level'] : 'h2';
    $align = in_array($settings['align'] ?? 'left', ['left', 'center', 'right'], true) ? $settings['align'] : 'left';
@endphp

<{{ $level }} style="text-align: {{ $align }};">{{ $settings['text'] ?? '' }}</{{ $level }}>
