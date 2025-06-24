<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    {{-- Vite + Tailwind --}}
    @vite('resources/css/app.css')
    @stack('styles')

    {{-- Alpine.js --}}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
{{-- Favicon & PWA icons --}}
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon.ico') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/web-app-manifest-192x192.png') }}">
<link rel="icon" type="image/png" sizes="512x512" href="{{ asset('favicon/web-app-manifest-512x512.png') }}">

{{-- Доп. для Windows tiles (необязательно) --}}
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">

<body class="font-sans antialiased bg-gray-50">

{{-- Шапка --}}
@include('layouts._header')

{{-- Основной контент --}}
<main class="min-h-screen">
    @yield('content')
</main>

{{-- Футер --}}
<footer class="bg-white border-t py-6">
    <div class="max-w-7xl mx-auto px-4 text-center text-sm text-gray-500">
        &copy; {{ now()->year }} ООО "Компания "РИФЕЙ"
    </div>
</footer>

@stack('scripts')
</body>
</html>
