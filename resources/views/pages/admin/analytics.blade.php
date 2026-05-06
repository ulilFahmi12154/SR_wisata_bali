@extends('layouts.admin')

@section('admin-content')
<div class="space-y-6">
    {{-- Page Header --}}
    <header class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
            <div class="space-y-2">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Analytics</p>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Analitik Sistem</h1>
                <p class="max-w-2xl text-sm leading-6 text-slate-500">Pantau metrik kinerja sistem, pengunjung, dan aktivitas pengguna secara real-time.</p>
            </div>
            <div class="flex gap-3">
                <select class="px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Periode: 30 Hari</option>
                    <option>7 Hari</option>
                    <option>30 Hari</option>
                    <option>90 Hari</option>
                    <option>1 Tahun</option>
                </select>
                <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </button>
            </div>
        </div>
    </header>

    {{-- Key Metrics --}}
    <section class="grid gap-4 xl:grid-cols-4">
        <article class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500">Total Pengunjung</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">142.8K</p>
                    <p class="mt-2 text-sm text-emerald-600 font-medium">↑ 12% dari bulan lalu</p>
                </div>
                <div class="p-3 rounded-lg bg-blue-100">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
            </div>
        </article>

        <article class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500">Pencarian Destinasi</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">28.4K</p>
                    <p class="mt-2 text-sm text-emerald-600 font-medium">↑ 8% dari bulan lalu</p>
                </div>
                <div class="p-3 rounded-lg bg-emerald-100">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
            </div>
        </article>

        <article class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500">Ulasan Baru</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">1.240</p>
                    <p class="mt-2 text-sm text-red-600 font-medium">↓ 3% dari bulan lalu</p>
                </div>
                <div class="p-3 rounded-lg bg-amber-100">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-2-4 2V5a2 2 0 012-2h8a2 2 0 012 2v11l-4-2-4 2V5z"/>
                    </svg>
                </div>
            </div>
        </article>

        <article class="rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm text-slate-500">Rating Rata-rata</p>
                    <p class="mt-2 text-3xl font-semibold text-slate-900">4.6</p>
                    <p class="mt-2 text-sm text-emerald-600 font-medium">↑ 0.2 dari bulan lalu</p>
                </div>
                <div class="p-3 rounded-lg bg-purple-100">
                    <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                </div>
            </div>
        </article>
    </section>

    {{-- Charts --}}
    <div class="grid gap-6 xl:grid-cols-2">
        {{-- Visitor Trend Chart --}}
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm text-slate-500">Tren Pengunjung</p>
                    <h3 class="mt-1 text-lg font-semibold text-slate-900">Pengunjung per Hari</h3>
                </div>
                <div class="text-sm text-emerald-600 font-medium bg-emerald-50 px-3 py-1 rounded-full">↑ 12%</div>
            </div>

            <div class="h-64 flex items-end justify-between gap-2 bg-slate-50 p-4 rounded-xl">
                <div class="flex-1 h-32 bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg hover:from-blue-500 hover:to-blue-600 cursor-pointer transition-all" title="Mon: 2,400"></div>
                <div class="flex-1 h-40 bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg hover:from-blue-500 hover:to-blue-600 cursor-pointer transition-all" title="Tue: 2,800"></div>
                <div class="flex-1 h-36 bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg hover:from-blue-500 hover:to-blue-600 cursor-pointer transition-all" title="Wed: 2,600"></div>
                <div class="flex-1 h-44 bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg hover:from-blue-500 hover:to-blue-600 cursor-pointer transition-all" title="Thu: 3,200"></div>
                <div class="flex-1 h-48 bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg hover:from-blue-500 hover:to-blue-600 cursor-pointer transition-all" title="Fri: 3,500"></div>
                <div class="flex-1 h-52 bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg hover:from-blue-500 hover:to-blue-600 cursor-pointer transition-all" title="Sat: 3,800"></div>
                <div class="flex-1 h-44 bg-gradient-to-t from-blue-400 to-blue-500 rounded-t-lg hover:from-blue-500 hover:to-blue-600 cursor-pointer transition-all" title="Sun: 3,100"></div>
            </div>

            <div class="mt-4 grid grid-cols-7 gap-2 text-xs text-slate-500 text-center">
                <span>Sen</span>
                <span>Sel</span>
                <span>Rab</span>
                <span>Kam</span>
                <span>Jum</span>
                <span>Sab</span>
                <span>Min</span>
            </div>
        </div>

        {{-- Top Destinations --}}
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <p class="text-sm text-slate-500">Destinasi Populer</p>
                    <h3 class="mt-1 text-lg font-semibold text-slate-900">Destinasi Paling Dicari</h3>
                </div>
            </div>

            <div class="space-y-3">
                @for($i = 1; $i <= 5; $i++)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3 flex-1">
                        <span class="text-sm font-semibold text-slate-500">{{ $i }}</span>
                        <span class="text-sm font-medium text-slate-900">Destinasi {{ $i }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-24 h-1.5 bg-slate-200 rounded-full overflow-hidden">
                            <div class="h-full rounded-full bg-gradient-to-r from-blue-400 to-blue-500" style="width: {{ (100 - $i * 10) }}%;"></div>
                        </div>
                        <span class="text-sm font-medium text-slate-900 w-12 text-right">{{ 100 - $i * 10 }}%</span>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>

    {{-- Bottom Charts --}}
    <div class="grid gap-6 xl:grid-cols-3">
        {{-- Rating Distribution --}}
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div>
                <p class="text-sm text-slate-500">Distribusi Rating</p>
                <h3 class="mt-1 text-lg font-semibold text-slate-900">Rating Destinasi</h3>
            </div>

            <div class="mt-6 space-y-3">
                @for($stars = 5; $stars >= 1; $stars--)
                <div class="flex items-center gap-3">
                    <span class="text-sm text-slate-600 w-8">⭐ {{ $stars }}</span>
                    <div class="flex-1 h-2 bg-slate-200 rounded-full overflow-hidden">
                        <div class="h-full rounded-full bg-amber-400" style="width: {{ 80 - $stars * 10 }}%;"></div>
                    </div>
                    <span class="text-sm font-medium text-slate-900 w-8 text-right">{{ 80 - $stars * 10 }}%</span>
                </div>
                @endfor
            </div>
        </div>

        {{-- Category Breakdown --}}
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div>
                <p class="text-sm text-slate-500">Kategori Destinasi</p>
                <h3 class="mt-1 text-lg font-semibold text-slate-900">Distribusi Kategori</h3>
            </div>

            <div class="mt-6 space-y-3">
                @php
                    $categories = [
                        ['name' => 'Pantai', 'count' => 8, 'color' => 'bg-blue-500'],
                        ['name' => 'Gunung', 'count' => 6, 'color' => 'bg-emerald-500'],
                        ['name' => 'Kuil', 'count' => 5, 'color' => 'bg-purple-500'],
                        ['name' => 'Seni & Budaya', 'count' => 3, 'color' => 'bg-amber-500'],
                    ];
                @endphp

                @foreach($categories as $cat)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="w-3 h-3 rounded-full {{ $cat['color'] }}"></div>
                        <span class="text-sm text-slate-700">{{ $cat['name'] }}</span>
                    </div>
                    <span class="text-sm font-medium text-slate-900">{{ $cat['count'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Recent Activities --}}
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
            <div>
                <p class="text-sm text-slate-500">Aktivitas Terbaru</p>
                <h3 class="mt-1 text-lg font-semibold text-slate-900">Log Sistem</h3>
            </div>

            <div class="mt-6 space-y-2 text-sm max-h-64 overflow-y-auto">
                <div class="flex gap-2 pb-2 border-b border-slate-200">
                    <span class="text-blue-600">●</span>
                    <div>
                        <p class="text-slate-900 font-medium">Pengguna baru terdaftar</p>
                        <p class="text-xs text-slate-500">2 menit yang lalu</p>
                    </div>
                </div>
                <div class="flex gap-2 pb-2 border-b border-slate-200">
                    <span class="text-emerald-600">●</span>
                    <div>
                        <p class="text-slate-900 font-medium">Destinasi dipublikasikan</p>
                        <p class="text-xs text-slate-500">15 menit yang lalu</p>
                    </div>
                </div>
                <div class="flex gap-2 pb-2 border-b border-slate-200">
                    <span class="text-amber-600">●</span>
                    <div>
                        <p class="text-slate-900 font-medium">Review baru diterima</p>
                        <p class="text-xs text-slate-500">1 jam yang lalu</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <span class="text-purple-600">●</span>
                    <div>
                        <p class="text-slate-900 font-medium">Preferensi pengguna diperbarui</p>
                        <p class="text-xs text-slate-500">3 jam yang lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
