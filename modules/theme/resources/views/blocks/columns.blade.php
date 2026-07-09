@php
    $columns = min(6, max(1, (int) ($settings['columns'] ?? 2)));
    $gap = max(0, (int) ($settings['gap'] ?? 24));
@endphp

<div style="display: grid; grid-template-columns: repeat({{ $columns }}, minmax(0, 1fr)); gap: {{ $gap }}px;">
    {!! $childrenHtml !!}
</div>
