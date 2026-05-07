@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    {{-- Page Header --}}
    <header class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div class="space-y-2">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Detail Pengguna</p>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">{{ $user->name ?? 'Pengguna' }}</h1>
                <p class="max-w-2xl text-sm leading-6 text-slate-500">Kelola informasi dan izin pengguna di halaman ini.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Kembali</a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center justify-center rounded-full bg-slate-950 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">Edit Pengguna</a>
            </div>
        </div>
    </header>

    <div class="grid gap-6 xl:grid-cols-3">
        {{-- Main Content --}}
        <div class="xl:col-span-2 space-y-6">
            {{-- Basic Information --}}
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900 mb-6">Informasi Dasar</h2>

                <div class="space-y-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Nama Lengkap</label>
                            <p class="text-slate-900 font-medium">{{ $user->name ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Email</label>
                            <p class="text-slate-900 font-medium">{{ $user->email ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Nomor Telepon</label>
                            <p class="text-slate-900 font-medium">{{ $user->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Tanggal Lahir</label>
                            <p class="text-slate-900 font-medium">{{ $user->date_of_birth?->format('d F Y') ?? '-' }}</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm text-slate-600 font-medium mb-2">Alamat</label>
                        <p class="text-slate-900 font-medium">{{ $user->address ?? '-' }}</p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Kota</label>
                            <p class="text-slate-900 font-medium">{{ $user->city ?? '-' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Provinsi</label>
                            <p class="text-slate-900 font-medium">{{ $user->province ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Account Status --}}
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900 mb-6">Status Akun</h2>

                <div class="space-y-4">
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Status</label>
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium {{ $user->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Peran</label>
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                {{ ucfirst($user->role ?? 'user') }}
                            </span>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Email Diverifikasi</label>
                            <p class="text-slate-900 font-medium">{{ $user->email_verified_at ? '✓ Ya' : '✗ Belum' }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-slate-600 font-medium mb-2">Tanggal Bergabung</label>
                            <p class="text-slate-900 font-medium">{{ $user->created_at?->format('d F Y') ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Activity --}}
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-semibold text-slate-900 mb-6">Aktivitas Terbaru</h2>

                <div class="space-y-4">
                    <div class="flex gap-4 pb-4 border-b border-slate-200">
                        <div class="w-2 h-2 rounded-full bg-blue-500 mt-2 flex-shrink-0"></div>
                        <div>
                            <p class="text-sm font-medium text-slate-900">Login ke sistem</p>
                            <p class="text-xs text-slate-500 mt-1">2 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="flex gap-4 pb-4 border-b border-slate-200">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 mt-2 flex-shrink-0"></div>
                        <div>
                            <p class="text-sm font-medium text-slate-900">Mengubah preferensi profil</p>
                            <p class="text-xs text-slate-500 mt-1">1 hari yang lalu</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="w-2 h-2 rounded-full bg-amber-500 mt-2 flex-shrink-0"></div>
                        <div>
                            <p class="text-sm font-medium text-slate-900">Mengakses fitur rekomendasi destinasi</p>
                            <p class="text-xs text-slate-500 mt-1">3 hari yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Avatar & Quick Info --}}
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="text-center">
                    <img src="{{ $user->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=2E86C1&color=fff&size=200' }}"
                         alt="{{ $user->name }}"
                         class="w-24 h-24 rounded-full mx-auto mb-4 ring-4 ring-slate-200">
                    <h3 class="text-lg font-semibold text-slate-900">{{ $user->name }}</h3>
                    <p class="text-sm text-slate-500 mt-1">{{ $user->email }}</p>

                    <div class="mt-6 pt-6 border-t border-slate-200 space-y-3">
                        <button class="w-full px-4 py-2 rounded-lg border border-slate-200 bg-white text-slate-700 hover:bg-slate-50 transition-colors text-sm font-medium">Ubah Status</button>
                        <button class="w-full px-4 py-2 rounded-lg bg-red-50 text-red-600 hover:bg-red-100 transition-colors text-sm font-medium">Reset Password</button>
                    </div>
                </div>
            </div>

            {{-- Statistics --}}
            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm space-y-4">
                <h3 class="font-semibold text-slate-900">Statistik</h3>

                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-sm text-slate-600">Destinasi Dikunjungi</p>
                            <p class="text-lg font-semibold text-slate-900">24</p>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200">
                            <div class="h-full w-3/4 rounded-full bg-blue-500"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-sm text-slate-600">Ulasan Diberikan</p>
                            <p class="text-lg font-semibold text-slate-900">8</p>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200">
                            <div class="h-full w-1/3 rounded-full bg-emerald-500"></div>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <p class="text-sm text-slate-600">Rating Rata-rata Diberikan</p>
                            <p class="text-lg font-semibold text-slate-900">4.5</p>
                        </div>
                        <div class="w-full h-2 rounded-full bg-slate-200">
                            <div class="h-full w-5/6 rounded-full bg-amber-500"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
