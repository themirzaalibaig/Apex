<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Apex SoftBuild | Solutions that scale with you')</title>


    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    @vite('resources/css/app.css')
    @fluxAppearance
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />

    @stack('styles')
</head>

<body class="bg-white dark:bg-zinc-900 min-h-screen">
    <x-layouts.partials.admin.sidebar />
    <x-layouts.partials.admin.header />
    <flux:main>
        @yield('content')
    </flux:main>
    @fluxScripts
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <x-layouts.partials.toast />
    @stack('scripts')
</body>

</html>
