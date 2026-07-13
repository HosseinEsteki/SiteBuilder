<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metaTitle ?? config('app.name') }}</title>
    @if (! empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    @vite('modules/theme/resources/css/theme.css')
    @stack('styles')
</head>
<body>
    <a class="theme-skip-link" href="#main-content">رفتن به محتوای اصلی</a>
    @if (! empty($renderedHeader))<header data-theme-region="header">{!! $renderedHeader !!}</header>@endif
    @yield('content')
    @if (! empty($renderedFooter))<footer data-theme-region="footer">{!! $renderedFooter !!}</footer>@endif
</body>
</html>
