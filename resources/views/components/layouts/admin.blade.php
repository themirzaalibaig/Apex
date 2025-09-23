<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Apex SoftBuild | Solutions that scale with you' }}</title>
    @vite('resources/css/app.css')
    {{-- @vite('resources/css/app.css') --}}

    @yield('styles')
</head>

<body>
    {{ $slot }}

    {{-- @vite('resources/js/main.js') --}}
</body>

</html>
