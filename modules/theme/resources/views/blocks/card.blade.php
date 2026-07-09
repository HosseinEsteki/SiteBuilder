<article style="border: 1px solid #e2e8f0; border-radius: 8px; padding: 24px;">
    <h3>{{ $settings['title'] ?? '' }}</h3>
    <p>{{ $settings['text'] ?? '' }}</p>
    @if (! empty($settings['url']))
        <a href="{{ $settings['url'] }}">Read more</a>
    @endif
</article>
