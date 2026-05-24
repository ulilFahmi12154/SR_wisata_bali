@extends('layouts.app')

@section('topbar_title', 'Kelola User')
@section('topbar_search_placeholder', 'Cari nama atau email....')

@section('title', 'Kelola User — Admin Jelajah')

@section('body')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<div class="min-h-screen bg-[#f8fafc] flex font-sans antialiased text-[#1e465a]" x-data="{ openCreate: false, openEditId: null }">
    @include('components.admin.sidebar')

    <main class="flex-1 pl-0 sm:pl-64 min-h-screen flex flex-col justify-between transition-all duration-300 relative">
        
        <div class="fixed top-0 right-0 left-0 sm:left-64 h-16 z-40 bg-white border-b border-slate-100 shadow-sm transition-all duration-300 flex items-center">
            <div class="w-full px-8 py-0">
                @include('components.admin.topbar')
            </div>
        </div>

        <div class="p-8 w-full mx-auto space-y-6 pt-24 flex-1">
            
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-emerald-700 bg-emerald-50 rounded-xl border border-emerald-100 flex items-center space-x-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-rose-700 bg-rose-50 rounded-xl border border-rose-100 flex items-center space-x-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="font-semibold">{{ session('error') }}</span>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <h2 class="text-xl font-bold text-[#1e465a]">Daftar User</h2>
                    <p class="text-xs text-gray-400">Menampilkan total {{ number_format($users->total()) }} user yang terdaftar.</p>
                </div>
                <button @click="openCreate = true" class="flex items-center space-x-2 px-5 py-2.5 bg-[#004e64] hover:bg-[#003d52] text-white rounded-xl text-xs font-bold transition-all shadow-sm cursor-pointer">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/>
                    </svg>
                    <span>Tambah User Baru</span>
                </button>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="p-5 flex items-center justify-end space-x-3 bg-white border-b border-slate-50">
                    <form action="{{ route('admin.users.index') }}" method="GET" id="filterForm" class="flex items-center space-x-3 m-0">
                        <input type="hidden" name="search" id="hiddenSearchInput" value="{{ request('search') }}">

                        <div class="relative">
                            <select name="role" onchange="document.getElementById('filterForm').submit()" class="appearance-none pl-4 pr-10 py-2 text-xs font-semibold text-slate-700 bg-white border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1e617a]/10 focus:border-[#1e617a] cursor-pointer transition-all">
                                <option value="">Semua Peran</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            <span class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </span>
                        </div>
                    </form>
                    
                    @if(request('search') || request('role'))
                        <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition-all">
                            Reset
                        </a>
                    @endif

                    <button onclick="document.getElementById('filterForm').submit()" class="flex items-center space-x-2 px-4 py-2 border border-[#1e617a] text-[#1e617a] hover:bg-sky-50 rounded-xl text-xs font-bold transition-all cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707v5.586a1 1 0 01-.553.894l-2 1A1 1 0 0110 18v-5.586a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z"/>
                        </svg>
                        <span>Filter</span>
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/70 text-[11px] font-bold text-gray-400 uppercase tracking-wider border-b border-slate-100">
                                <th class="px-6 py-4">Nama</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Peran</th>
                                <th class="px-6 py-4">Tanggal Bergabung</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-sm text-slate-700 font-medium">
                            @forelse($users as $user)
                            <tr class="hover:bg-slate-50/50 transition-colors" x-data="{ showOldPassword: false, showEditPassword: false }">
                                <td class="px-6 py-4 flex items-center space-x-3">
                                    <div class="w-8 h-8 rounded-full bg-sky-50 text-[#1e617a] flex items-center justify-center border border-slate-100 font-bold text-xs uppercase">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <span class="font-bold text-[#1e465a]">{{ $user->name }}</span>
                                </td>
                                <td class="px-6 py-4 text-slate-500 font-normal">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    @php $roleBadge = strtolower($user->role) === 'admin' ? 'bg-amber-50 text-amber-600' : 'bg-sky-50 text-sky-600'; @endphp
                                    <span class="px-2.5 py-1 text-[10px] font-bold rounded-md capitalize {{ $roleBadge }}">{{ $user->role ?? 'User' }}</span>
                                </td>
                                <td class="px-6 py-4 text-slate-400 font-light">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-3 text-gray-400">
                                        <button @click="openEditId = '{{ $user->id }}'; showOldPassword = false; showEditPassword = false" class="hover:text-amber-500 transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                        </button>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')" class="inline-block m-0">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="hover:text-rose-500 transition-colors flex items-center cursor-pointer">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm text-left" x-show="openEditId === '{{ $user->id }}'" x-transition.opacity style="display: none;" @keydown.escape.window="openEditId = null">
                                        <div class="bg-white w-full max-w-md p-6 rounded-2xl shadow-xl border border-slate-100 space-y-4" @click.away="openEditId = null">
                                            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                                                <h3 class="text-base font-bold text-[#1e465a]">Edit Data Pengguna</h3>
                                                <button @click="openEditId = null" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4 m-0">
                                                @csrf @method('PUT')
                                                <div class="space-y-1">
                                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nama Lengkap</label>
                                                    <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1e617a] text-slate-700">
                                                </div>
                                                <div class="space-y-1">
                                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Alamat Email</label>
                                                    <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1e617a] text-slate-700">
                                                </div>
                                                <div class="space-y-1">
                                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Peran Pengguna</label>
                                                    <select name="role" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1e617a] text-slate-700 cursor-pointer">
                                                        <option value="user" {{ strtolower($user->role) == 'user' ? 'selected' : '' }}>User</option>
                                                        <option value="admin" {{ strtolower($user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    </select>
                                                </div>
                                                <div class="space-y-1">
                                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Password Lama</label>
                                                    <div class="relative flex items-center">
                                                        <input :type="showOldPassword ? 'text' : 'password'" name="old_password" placeholder="Masukkan password saat ini" class="w-full pl-4 pr-10 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1e617a] text-slate-700">
                                                        <button type="button" @click="showOldPassword = !showOldPassword" class="absolute right-3 text-gray-400 hover:text-slate-600 focus:outline-none cursor-pointer">
                                                            <svg x-show="showOldPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                            <svg x-show="!showOldPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 014.175-4.404m2.036-1.023A10.06 10.06 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.13 4.412m-6-5.412a3 3 0 11-4.243-4.243m1.414 1.414L4.929 4.93m14.142 14.142l-1.414-1.414"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="space-y-1">
                                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Password Baru</label>
                                                    <div class="relative flex items-center">
                                                        <input :type="showEditPassword ? 'text' : 'password'" name="password" placeholder="••••••••" class="w-full pl-4 pr-10 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1e617a] text-slate-700">
                                                        <button type="button" @click="showEditPassword = !showEditPassword" class="absolute right-3 text-gray-400 hover:text-slate-600 focus:outline-none cursor-pointer">
                                                            <svg x-show="showEditPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                            <svg x-show="!showEditPassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 014.175-4.404m2.036-1.023A10.06 10.06 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.13 4.412m-6-5.412a3 3 0 11-4.243-4.243m1.414 1.414L4.929 4.93m14.142 14.142l-1.414-1.414"/></svg>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="flex items-center justify-end space-x-2 pt-3 border-t border-slate-100">
                                                    <button type="button" @click="openEditId = null" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition-all cursor-pointer">Batal</button>
                                                    <button type="submit" class="px-4 py-2 bg-[#004e64] hover:bg-[#003d52] text-white rounded-xl text-xs font-bold transition-all shadow-sm cursor-pointer">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-sm text-slate-400 font-light">Tidak ada data pengguna ditemukan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-5 flex items-center justify-between border-t border-slate-100 bg-white custom-pagination">
                    <span class="text-xs text-gray-400 font-medium">Menampilkan {{ $users->firstItem() ?? 0 }} sampai {{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} user</span>
                    <div>{{ $users->appends(request()->query())->links() }}</div>
                </div>
            </div>
        </div>
    </main>

    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm transition-opacity" x-show="openCreate" x-transition.opacity style="display: none;" @keydown.escape.window="openCreate = false" x-data="{ showCreatePassword: false }">
        <div class="bg-white w-full max-w-md p-6 rounded-2xl shadow-xl border border-slate-100 space-y-4" @click.away="openCreate = false; showCreatePassword = false">
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-bold text-[#1e465a]">Tambah Pengguna Baru</h3>
                <button @click="openCreate = false; showCreatePassword = false" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4 m-0">
                @csrf
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Nama Lengkap</label>
                    <input type="text" name="name" placeholder="Masukkan nama lengkap" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1e617a] text-slate-700">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Alamat Email</label>
                    <input type="email" name="email" placeholder="contoh@domain.com" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1e617a] text-slate-700">
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Peran Pengguna</label>
                    <select name="role" required class="w-full px-4 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1e617a] text-slate-700 cursor-pointer">
                        <option value="user" selected>User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <div class="space-y-1">
                    <label class="text-xs font-bold text-slate-500 uppercase tracking-wider block">Password</label>
                    <div class="relative flex items-center">
                        <input :type="showCreatePassword ? 'text' : 'password'" name="password" placeholder="••••••••" required class="w-full pl-4 pr-10 py-2 text-sm bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:border-[#1e617a] text-slate-700">
                        <button type="button" @click="showCreatePassword = !showCreatePassword" class="absolute right-3 text-gray-400 hover:text-slate-600 focus:outline-none cursor-pointer">
                            <svg x-show="showCreatePassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            <svg x-show="!showCreatePassword" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.024 10.024 0 014.175-4.404m2.036-1.023A10.06 10.06 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.13 4.412m-6-5.412a3 3 0 11-4.243-4.243m1.414 1.414L4.929 4.93m14.142 14.142l-1.414-1.414"/></svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-end space-x-2 pt-3 border-t border-slate-100">
                    <button type="button" @click="openCreate = false; showCreatePassword = false" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition-all cursor-pointer">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-[#004e64] hover:bg-[#003d52] text-white rounded-xl text-xs font-bold transition-all shadow-sm cursor-pointer">Tambah User</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const topbarSearch = document.getElementById('topbarSearchInput');
        const hiddenSearch = document.getElementById('hiddenSearchInput');
        const filterForm = document.getElementById('filterForm');

        if (topbarSearch && hiddenSearch) {
            // Memastikan teks yang dicari tetap ada di kolom input setelah halaman reload
            topbarSearch.value = hiddenSearch.value;

            // Memindahkan kursor ke akhir teks setelah reload (biar ngetik lebih nyaman)
            topbarSearch.focus();
            const val = topbarSearch.value;
            topbarSearch.value = '';
            topbarSearch.value = val;

            let debounceTimer;

            // Dengarkan event saat user mengetik (input)
            topbarSearch.addEventListener("input", function () {
                // Bersihkan timer sebelumnya setiap kali user mengetik huruf baru
                clearTimeout(debounceTimer);

                // Set nilai input tersembunyi dengan apa yang diketik user
                hiddenSearch.value = topbarSearch.value;

                // Tunggu user selesai mengetik selama 500ms sebelum submit form
                debounceTimer = setTimeout(function () {
                    filterForm.submit();
                }, 500); 
            });

            // Mencegah form bawaan submit instan jika user tidak sengaja menekan Enter
            topbarSearch.addEventListener("keypress", function (e) {
                if (e.key === "Enter") {
                    e.preventDefault();
                }
            });
        }
    });
</script>
@endsection