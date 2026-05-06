<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Jelajah Bali')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=DM+Sans&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')
</head>

<body class="h-full bg-slate-50 text-slate-800">

    @hasSection('body')
        @yield('body')
    @else
        <x-user.navbar />

        <main class="min-h-screen px-4 md:px-8 py-6">
            @yield('content')
        </main>

        <x-user.footer />
    @endif

    @stack('scripts')
</body>
</html>