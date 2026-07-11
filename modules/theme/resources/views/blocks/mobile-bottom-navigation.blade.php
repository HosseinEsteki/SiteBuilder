@php($items = collect($settings['items'] ?? []))
@if($items->isNotEmpty())<nav class="theme-bottom-nav" aria-label="دسترسی سریع" data-footer-block="mobile_bottom_navigation">@foreach($items as $item)<a href="{{ $item['url'] ?? '#' }}"><span aria-hidden="true">{{ $item['icon'] ?? '•' }}</span><small>{{ $item['label'] ?? '' }}</small></a>@endforeach</nav>@endif
