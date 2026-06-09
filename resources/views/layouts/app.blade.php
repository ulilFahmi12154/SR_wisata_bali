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

    {{-- Tailwind CDN (hanya untuk development) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- App assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Chart.js untuk grafik --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    @stack('styles')

    <style>
        .want-to-go-button {
            border-color: #e2e8f0;
            background: #ffffff;
            color: #334155;
        }

        .want-to-go-button:hover {
            background: #f0f9ff;
            color: #075985;
        }

        .want-to-go-button.is-wanted {
            border-color: #fde68a;
            background: #fffbeb;
            color: #b45309;
        }

        .want-to-go-button.is-wanted:hover {
            background: #fef3c7;
        }

        .want-to-go-button.is-loading {
            opacity: 0.72;
            pointer-events: none;
        }
    </style>
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

            function showWantToGoToast(message, isError = false) {
                let toast = document.getElementById('want-to-go-toast');

                if (!toast) {
                    toast = document.createElement('div');
                    toast.id = 'want-to-go-toast';
                    toast.className = 'fixed bottom-5 left-1/2 z-[120] max-w-[92vw] -translate-x-1/2 rounded-full px-5 py-3 text-sm font-bold shadow-[0_18px_48px_rgba(15,23,42,0.22)] transition';
                    document.body.appendChild(toast);
                }

                toast.textContent = message;
                toast.classList.toggle('bg-red-600', isError);
                toast.classList.toggle('text-white', true);
                toast.classList.toggle('bg-sky-700', !isError);
                toast.classList.remove('opacity-0', 'translate-y-3');

                window.clearTimeout(toast.dataset.timeoutId);
                toast.dataset.timeoutId = window.setTimeout(() => {
                    toast.classList.add('opacity-0', 'translate-y-3');
                }, 2600);
            }

            function setWantToGoButtonState(button, isWanted) {
                button.dataset.isWanted = isWanted ? 'true' : 'false';
                button.classList.toggle('is-wanted', isWanted);
                button.textContent = isWanted
                    ? (button.dataset.wantedText || 'Tersimpan')
                    : (button.dataset.unwantedText || 'Ingin Dikunjungi');
            }

            function syncWantToGoButtons(wisataId, isWanted) {
                document
                    .querySelectorAll(`[data-want-to-go-form][data-wisata-id="${wisataId}"] [data-want-to-go-button]`)
                    .forEach((button) => setWantToGoButtonState(button, isWanted));
            }

            document.addEventListener('submit', async function (event) {
                const form = event.target.closest('[data-want-to-go-form]');

                if (!form) {
                    return;
                }

                event.preventDefault();

                const button = form.querySelector('[data-want-to-go-button]');
                const wisataId = form.dataset.wisataId;
                const previousState = button?.dataset.isWanted === 'true';

                if (button) {
                    button.classList.add('is-loading');
                    button.disabled = true;
                    button.textContent = 'Menyimpan...';
                }

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                        body: new FormData(form),
                    });

                    const data = await response.json();

                    if (!response.ok || !data.success) {
                        throw new Error(data.message || 'Gagal memperbarui daftar ingin dikunjungi.');
                    }

                    syncWantToGoButtons(wisataId, data.is_wanted);

                    if (!data.is_wanted && form.dataset.removeOnUnwanted === 'true') {
                        const card = form.closest('[data-want-to-go-card]');
                        card?.remove();
                    }

                    showWantToGoToast(data.message || 'Daftar ingin dikunjungi diperbarui.');
                } catch (error) {
                    if (button) {
                        setWantToGoButtonState(button, previousState);
                    }

                    showWantToGoToast(error.message || 'Gagal memperbarui daftar ingin dikunjungi.', true);
                } finally {
                    if (button) {
                        button.classList.remove('is-loading');
                        button.disabled = false;
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.getElementById('toggle-sidebar-btn');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (toggleBtn && sidebar && overlay) {
                toggleBtn.addEventListener('click', function () {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                });

                overlay.addEventListener('click', function () {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>
