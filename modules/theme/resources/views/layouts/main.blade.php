<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $metaTitle ?? config('app.name') }}</title>
    @if (! empty($metaDescription))
        <meta name="description" content="{{ $metaDescription }}">
    @endif
    @stack('styles')
</head>
<body>
    @yield('content')
</body>
</html>
