<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LofiPlan') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="font-[Instrument Sans] text-white antialiased relative overflow-hidden">

    <div class="absolute inset-0 bg-gradient-to-br from-[#0b0f12] via-[#111927] to-[#0f0f10]"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,rgba(0,255,163,0.07),transparent_70%)]"></div>
    <div class="absolute -top-40 left-1/2 w-[600px] h-[600px] bg-green-500/20 rounded-full blur-[120px] -translate-x-1/2"></div>

    <div class="relative z-10 min-h-screen flex flex-col items-center justify-center px-6">
        {{ $slot }}
    </div>

    <footer class="absolute bottom-6 text-xs text-gray-500 z-10 w-full text-center">
        © {{ date('Y') }} <span class="text-green-400 font-semibold">LofiPlan</span>. All rights reserved.
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
