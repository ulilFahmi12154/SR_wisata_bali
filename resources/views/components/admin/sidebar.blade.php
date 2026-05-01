@php
    $currentRoute = Route::currentRouteName();

    $navItems = [
        [
            'label'  => 'Dashboard',
            'route'  => 'admin.dashboard',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>',
        ],
        [
            'label'  => 'Analitik',
            'route'  => 'admin.analytics',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
        ],
        [
            'label'  => 'Destinasi',
            'route'  => 'admin.destinations.index',
            'match'  => 'admin.destinations.*',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>',
        ],
        [
            'label'  => 'Pengguna',
            'route'  => 'admin.users.index',
            'match'  => 'admin.users.*',
            'icon'   => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
        ],
    ];

    function adminNavActive(string $routeName, ?string $match, string $current): bool {
        if ($match) return Str::is($match, $current);
        return $routeName === $current;
    }
@endphp

{{-- Desktop sidebar --}}
<aside
    x-data="{ collapsed: false }"
    :class="collapsed ? 'w-16' : 'w-60'"
    class="hidden lg:flex flex-col flex-shrink-0 h-screen sticky top-0 transition-all duration-300 overflow-hidden select-none"
    style="background: var(--color-primary); font-family: var(--font-body);">

    {{-- Logo --}}
    <div class="flex items-center gap-3 px-4 h-16 border-b border-white/10 flex-shrink-0">
        <div class="w-8 h-8 rounded-lg flex items-center justify-center bg-white/15 flex-shrink-0">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 004 0 2 2 0 012-2h1.064"/>
            </svg>
        </div>
        <span x-show="!collapsed"
              x-transition:enter="transition duration-200"
              x-transition:enter-start="opacity-0"
              x-transition:enter-end="opacity-100"
              class="text-white font-bold text-sm whitespace-nowrap overflow-hidden">
            Jelajah<span style="color:var(--color-accent);">Bali</span>
            <span class="ml-1 text-white/50 text-xs font-normal">Admin</span>
        </span>

        {{-- Collapse toggle --}}
        <button @click="collapsed = !collapsed"
                class="ml-auto p-1 rounded-md text-white/50 hover:text-white hover:bg-white/10 transition-colors flex-shrink-0">
            <svg class="w-4 h-4 transition-transform" :class="collapsed ? 'rotate-180' : ''"
                 fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"/>
            </svg>
        </button>
    </div>

    {{-- Nav --}}
    <nav class="flex-1 px-2 py-4 space-y-0.5 overflow-y-auto">
        @foreach($navItems as $item)
        @php
            $active = adminNavActive($item['route'], $item['match'] ?? null, $currentRoute ?? '');
        @endphp
        <a href="{{ route($item['route']) }}"
           title="{{ $item['label'] }}"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-150
                  {{ $active
                       ? 'text-white font-semibold'
                       : 'text-white/60 hover:text-white hover:bg-white/10' }}"
           style="{{ $active ? 'background: rgba(255,255,255,.15);' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                {!! $item['icon'] !!}
            </svg>
            <span x-show="!collapsed"
                  x-transition:enter="transition duration-150"
                  x-transition:enter-start="opacity-0"
                  x-transition:enter-end="opacity-100"
                  class="text-sm whitespace-nowrap overflow-hidden">
                {{ $item['label'] }}
            </span>

            {{-- Active indicator --}}
            @if($active)
            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-white/80 flex-shrink-0"
                  x-show="!collapsed"></span>
            @endif
        </a>
        @endforeach
    </nav>

    {{-- User profile at bottom --}}
    <div class="p-3 border-t border-white/10 flex-shrink-0">
        <div class="flex items-center gap-3 rounded-xl px-2 py-2">
            <img src="{{ Auth::user()->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name ?? 'Admin').'&background=2E86C1&color=fff&size=80' }}"
                 alt="Admin"
                 class="w-8 h-8 rounded-full flex-shrink-0 ring-2 ring-white/20">
            <div x-show="!collapsed" class="min-w-0">
                <p class="text-white text-xs font-semibold truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                <p class="text-white/50 text-xs truncate">Administrator</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="ml-auto flex-shrink-0">
                @csrf
                <button type="submit"
                        title="Keluar"
                        class="p-1.5 rounded-lg text-white/50 hover:text-white hover:bg-white/10 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>

{{-- Mobile overlay drawer (Alpine) --}}
<div x-data="{ mobileOpen: false }" @admin-sidebar-open.window="mobileOpen = true" class="lg:hidden">
    {{-- Backdrop --}}
    <div x-show="mobileOpen" @click="mobileOpen = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm"></div>

    {{-- Drawer --}}
    <aside x-show="mobileOpen"
           x-transition:enter="transition ease-out duration-200"
           x-transition:enter-start="-translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-150"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="-translate-x-full"
           class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col"
           style="background: var(--color-primary);">
        {{-- Same content as desktop, simplified --}}
        <div class="flex items-center justify-between h-16 px-4 border-b border-white/10">
            <span class="text-white font-bold">JelajahBali <span class="text-white/40 text-xs">Admin</span></span>
            <button @click="mobileOpen = false" class="text-white/60 hover:text-white">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        <nav class="flex-1 px-2 py-4 space-y-0.5 overflow-y-auto">
            @foreach($navItems as $item)
            @php $active = adminNavActive($item['route'], $item['match'] ?? null, $currentRoute ?? ''); @endphp
            <a href="{{ route($item['route']) }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm transition-all
                      {{ $active ? 'text-white font-semibold' : 'text-white/60 hover:text-white hover:bg-white/10' }}"
               style="{{ $active ? 'background: rgba(255,255,255,.15);' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    {!! $item['icon'] !!}
                </svg>
                {{ $item['label'] }}
            </a>
            @endforeach
        </nav>
    </aside>
</div>
