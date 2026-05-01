<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title') —
        @endif
        Jelajah Bali
    </title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#0c93e9',
                            600: '#0074c7',
                            700: '#005da1',
                        },
                    },
                    fontFamily: {
                        display: ['"Playfair Display"', 'serif'],
                        body: ['"DM Sans"', 'sans-serif'],
                    },
                }
            }
        }
    </script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Playfair Display', serif; }
    </style>

    @stack('styles')
</head>

<body class="h-full bg-slate-50 text-slate-800 antialiased">

    {{-- =========================
        MODE AUTH (LOGIN / REGISTER)
    ========================== --}}
    @hasSection('body')
        @yield('body')

    @else
    {{-- =========================
        MODE NORMAL (SEMUA HALAMAN)
    ========================== --}}

        {{-- 🔥 NAVBAR SELALU MUNCUL --}}
        <x-user.navbar />

        <main class="min-h-screen px-4 md:px-8 py-6">
            @yield('content')
        </main>

        {{-- 🔥 FOOTER SELALU MUNCUL --}}
        <x-user.footer />

    @endif

    @stack('scripts')

</body>
</html>