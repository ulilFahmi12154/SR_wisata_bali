<header class="flex items-center justify-between w-full px-8 py-4 bg-white border-b border-gray-100">
    <div class="flex items-center space-x-6 flex-1">
        <h1 class="text-2xl font-bold text-[#1e465a]">
            @yield('topbar_title', 'Dashboard')
        </h1>

        @if(View::hasSection('topbar_search_placeholder'))
            <div class="relative w-full max-w-md">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </span>
                <input 
                    type="text" 
                    id="topbarSearchInput" 
                    placeholder="@yield('topbar_search_placeholder', 'Cari sesuatu...')"
                    class="w-full py-2.5 pl-11 pr-4 text-sm bg-gray-50/60 border border-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-[#1e617a]/20 focus:border-[#1e617a] text-gray-700 transition-all placeholder-gray-400"
                >
            </div>
        @endif
    </div>

    <div class="flex items-center space-x-6">
        <button class="relative p-2 text-gray-400 hover:text-gray-600 transition-colors focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span class="absolute top-2 right-2 w-2 h-2 bg-rose-500 rounded-full"></span>
        </button>

        <div class="h-6 w-px bg-gray-200"></div>

        <div class="flex items-center space-x-3">
            <div class="text-right">
                <h4 class="text-sm font-bold text-[#1e465a] leading-tight">Admin Bali</h4>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-wider block">Super Admin</span>
            </div>
            <div class="w-10 h-10 bg-black rounded-full overflow-hidden flex items-center justify-center border-2 border-gray-100 shadow-sm">
                <img 
                    src="https://img.icons8.com/isometric-folders/100/glasses.png" 
                    alt="Admin Avatar" 
                    class="w-7 h-7 object-contain"
                >
            </div>
        </div>
    </div>
</header>