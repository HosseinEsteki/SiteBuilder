@php
    $height = max(0, (int) ($settings['height'] ?? 32));
@endphp

<div aria-hidden="true" style="height: {{ $height }}px;"></div>
