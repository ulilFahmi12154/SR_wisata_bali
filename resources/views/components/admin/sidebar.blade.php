<aside id="admin-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen bg-white border-r border-slate-100 transition-transform -translate-x-full sm:translate-x-0 flex flex-col justify-between p-6">
    
    <div class="space-y-8">
        <div>
            <h1 class="text-base font-bold text-sky-900 tracking-tight">Admin Jelajah</h1>
            <p class="text-[10px] text-slate-400 font-medium tracking-wide">Bali Management System</p>
        </div>

        <nav class="space-y-1.5">
            <a href="{{ route('admin.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition-all duration-200 
               {{ Route::is('admin.dashboard') ? 'bg-sky-50 text-sky-900 shadow-sm' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
                </svg>
                Dashboard
            </a>

            <a href="{{ route('admin.destinations.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition-all duration-200 
               {{ Route::is('admin.destinations.*') ? 'bg-sky-50 text-sky-900 shadow-sm' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
                Kelola Wisata
            </a>

            <a href="{{ route('admin.users.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition-all duration-200 
               {{ Route::is('admin.users.*') ? 'bg-sky-50 text-sky-900 shadow-sm' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                </svg>
                Kelola User
            </a>

            <a href="{{ route('admin.analytics') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl text-xs font-bold transition-all duration-200 
               {{ Route::is('admin.analytics') ? 'bg-sky-50 text-sky-900 shadow-sm' : 'text-slate-400 hover:bg-slate-50 hover:text-slate-700' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/>
                </svg>
                Analytics
            </a>
        </nav>
    </div>

    <div class="border-t border-slate-100 pt-4 space-y-3">
        <div class="flex items-center gap-3 px-2">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=1e617a&color=fff" class="w-9 h-9 rounded-xl object-cover" alt="Profile">
            <div class="min-w-0 flex-1">
                <h4 class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->name ?? 'Budi Santoso' }}</h4>
                <p class="text-[10px] text-slate-400 font-medium truncate uppercase tracking-wider">{{ Auth::user()->role ?? 'Super Admin' }}</p>
            </div>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold text-red-500 hover:bg-red-50/60 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</aside>

<div id="sidebar-overlay" class="fixed inset-0 z-30 bg-slate-900/20 backdrop-blur-sm hidden sm:hidden"></div>