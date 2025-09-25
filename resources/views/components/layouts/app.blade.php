<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?? 'en') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Apex SoftBuild | Solutions that scale with you' }}</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @php
        $isAdmin = request()->is('admin/*') || request()->is('admin');
        $isAuthPage = request()->is('login') || $isAdmin;
    @endphp

    @if ($isAuthPage)
        @vite('resources/css/app.css')
        @fluxAppearance
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @else
        @vite('resources/scss/main.scss')
    @endif

    @yield('styles')
</head>

<body @if ($isAuthPage) class="bg-white dark:bg-zinc-900 min-h-screen" @endif @yield('body-attributes')>
    @if ($isAuthPage)
        @if ($isAdmin)
            @include('components.layouts.partials.admin.sidebar')
            @include('components.layouts.partials.admin.header')
        @endif
    @else
        @include('components.layouts.partials.loader')
        @include('components.layouts.partials.header.navbar')
        @include('components.layouts.partials.sidebar')
        @include('components.layouts.partials.header.mobile-nav')
    @endif

    @if ($isAdmin)
        <flux:main>
            {{ $slot }}
        </flux:main>
    @else
        {{ $slot }}
    @endif

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @if ($isAuthPage)
        @fluxScripts
    @else
        @include('components.layouts.partials.slider')
        @include('components.layouts.partials.cta')
        @include('components.layouts.partials.footer')
        @vite('resources/js/main.js')
    @endif

    @include('components.layouts.partials.toast')
    @yield('scripts')
</body>

</html>
