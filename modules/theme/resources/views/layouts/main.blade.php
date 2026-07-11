<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    @if (! empty($renderedHeader))<header data-theme-region="header">{!! $renderedHeader !!}</header>@endif
    @yield('content')
    @if (! empty($renderedFooter))<footer data-theme-region="footer">{!! $renderedFooter !!}</footer>@endif
</body>
</html>
