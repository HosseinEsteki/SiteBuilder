@if (! empty($settings['src']))
    <figure>
        <img src="{{ $settings['src'] }}" alt="{{ $settings['alt'] ?? '' }}" style="max-width: 100%; height: auto;">
        @if (! empty($settings['caption']))
            <figcaption>{{ $settings['caption'] }}</figcaption>
        @endif
    </figure>
@endif
