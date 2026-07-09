@php
    $backgroundColor = $settings['background_color'] ?? '#f8fafc';
@endphp

<section style="background-color: {{ $backgroundColor }}; padding: 80px 16px; text-align: center;">
    @if (! empty($settings['eyebrow']))
        <p>{{ $settings['eyebrow'] }}</p>
    @endif
    <h1>{{ $settings['title'] ?? '' }}</h1>
    @if (! empty($settings['subtitle']))
        <p>{{ $settings['subtitle'] }}</p>
    @endif
    @if (! empty($settings['button_text']))
        <a href="{{ $settings['button_url'] ?? '#' }}">{{ $settings['button_text'] }}</a>
    @endif
</section>
