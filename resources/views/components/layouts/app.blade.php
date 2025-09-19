<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Apex SoftBuild | Solutions that scale with you' }}</title>
    @livewireStyles
    @vite('resources/scss/main.scss')
    {{-- @vite('resources/css/app.css') --}}

    @yield('styles')
</head>

<body @yield('body-attributes')>
    @include('components.layouts.partials.loader')
    @include('components.layouts.partials.header.navbar')
    @include('components.layouts.partials.sidebar')
    @include('components.layouts.partials.header.mobile-nav')

    {{ $slot }}

    @include('components.layouts.partials.slider')
    @include('components.layouts.partials.cta')
    @include('components.layouts.partials.footer')
    @livewireScriptConfig
    @yield('scripts')
    @vite('resources/js/main.js')
</body>

</html>
