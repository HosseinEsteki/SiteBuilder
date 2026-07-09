@php
    $align = in_array($settings['align'] ?? 'left', ['left', 'center', 'right'], true) ? $settings['align'] : 'left';
    $background = ($settings['style'] ?? 'primary') === 'secondary' ? '#334155' : '#0f172a';
@endphp

<div style="text-align: {{ $align }};">
    <a href="{{ $settings['url'] ?? '#' }}" style="display: inline-block; background: {{ $background }}; color: #ffffff; padding: 10px 18px; border-radius: 6px; text-decoration: none;">
        {{ $settings['text'] ?? 'Learn more' }}
    </a>
</div>
