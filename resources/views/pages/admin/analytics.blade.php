@extends('layouts.app')

@section('topbar_title', 'Analisis')
@section('title', 'Analisis Performa — Admin Jelajah')

@section('body')
<div class="min-h-screen bg-[#f8fafc] flex font-sans antialiased text-slate-800">
    @include('components.admin.sidebar')

    <main class="flex-1 pl-0 sm:pl-64 min-h-screen flex flex-col justify-between transition-all duration-300">
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            @include('components.admin.topbar')

            {{-- KARTU STATISTIK UTAMA (4 KARTU) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">
                {{-- KARTU 1: TOTAL KUNJUNGAN --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Kunjungan</span>
                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                            {{ number_format($analyticsStats['total_kunjungan'] ?? 0, 0, ',', '.') }}
                        </h3>
                        <div class="text-[10px] font-bold flex items-center gap-1 mt-1">
                            @if(($analyticsStats['tren_kunjungan']['status'] ?? '') === 'naik')
                                <span class="text-emerald-600 flex items-center gap-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                    +{{ $analyticsStats['tren_kunjungan']['persen'] }}%
                                </span>
                                <span class="text-slate-400">vs bln lalu</span>
                            @elseif(($analyticsStats['tren_kunjungan']['status'] ?? '') === 'turun')
                                <span class="text-red-500 flex items-center gap-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/>
                                    </svg>
                                    -{{ $analyticsStats['tren_kunjungan']['persen'] }}%
                                </span>
                                <span class="text-slate-400">vs bln lalu</span>
                            @else
                                <span class="text-slate-500 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Stabil
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="p-3 bg-sky-50 text-sky-600 rounded-xl">
                        <svg class="w-5 h-5 text-[#1e617a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                </div>

                {{-- KARTU 2: RATA-RATA HARIAN --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Rata-rata Harian</span>
                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                            {{ number_format($analyticsStats['rata_rata_harian'] ?? 0, 0, ',', '.') }}
                        </h3>
                        <div class="text-[10px] font-bold flex items-center gap-1 mt-1">
                            @if(($analyticsStats['tren_rata_harian']['status'] ?? '') === 'naik')
                                <span class="text-emerald-600">+{{ $analyticsStats['tren_rata_harian']['persen'] }}%</span>
                            @elseif(($analyticsStats['tren_rata_harian']['status'] ?? '') === 'turun')
                                <span class="text-red-500">-{{ $analyticsStats['tren_rata_harian']['persen'] }}%</span>
                            @else
                                <span class="text-slate-400">Stabil</span>
                            @endif
                            <span class="text-slate-400">vs bln lalu</span>
                        </div>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/>
                        </svg>
                    </div>
                </div>

                {{-- KARTU 3: DURASI SESI RATA-RATA --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Durasi Sesi</span>
                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                            {{ $analyticsStats['durasi_sesi'] ?? '0m 0s' }}
                        </h3>
                        <div class="text-[10px] font-bold flex items-center gap-1 mt-1">
                            @if(($analyticsStats['tren_durasi_sesi']['status'] ?? '') === 'naik')
                                <span class="text-emerald-600">+{{ $analyticsStats['tren_durasi_sesi']['persen'] }}%</span>
                            @elseif(($analyticsStats['tren_durasi_sesi']['status'] ?? '') === 'turun')
                                <span class="text-red-500">-{{ $analyticsStats['tren_durasi_sesi']['persen'] }}%</span>
                            @else
                                <span class="text-slate-400">Stabil</span>
                            @endif
                            <span class="text-slate-400">vs bln lalu</span>
                        </div>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                {{-- KARTU 4: RATA-RATA PENCARIAN PER HARI --}}
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Rata-rata Pencarian/Hari</span>
                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                            {{ number_format($analyticsStats['rata_pencarian_per_hari'] ?? 0, 1, ',', '.') }}
                        </h3>
                        <div class="text-[10px] font-bold flex items-center gap-1 mt-1">
                            @if(($analyticsStats['tren_pencarian']['status'] ?? '') === 'naik')
                                <span class="text-emerald-600">+{{ $analyticsStats['tren_pencarian']['persen'] }}%</span>
                            @elseif(($analyticsStats['tren_pencarian']['status'] ?? '') === 'turun')
                                <span class="text-red-500">-{{ $analyticsStats['tren_pencarian']['persen'] }}%</span>
                            @else
                                <span class="text-slate-400">Stabil</span>
                            @endif
                            <span class="text-slate-400">vs bln lalu</span>
                        </div>
                    </div>
                    <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- GRAFIK TREN KUNJUNGAN & LOGIN --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                    <div>
                        <h3 class="text-sm font-bold text-sky-900 tracking-tight">Tren Kunjungan Harian</h3>
                        <p class="text-[10px] text-slate-400 font-medium">7 hari terakhir</p>
                    </div>
                    <div class="h-64 relative w-full">
                        <canvas id="analyticsWeeklyChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
                    <div>
                        <h3 class="text-sm font-bold text-sky-900 tracking-tight">Login Pengguna per Hari</h3>
                        <p class="text-[10px] text-slate-400 font-medium">7 hari terakhir (user unik)</p>
                    </div>
                    <div class="h-64 relative w-full">
                        <canvas id="loginChart"></canvas>
                    </div>
                </div>
            </div>

            {{-- GROWTH INSIGHT & RINGKASAN --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-[#1e617a] p-6 rounded-2xl text-white shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <span class="px-2.5 py-1 bg-white/10 text-[9px] font-black uppercase tracking-wider rounded-md backdrop-blur-sm">
                            Growth Insight
                        </span>
                        <div class="space-y-2">
                            <h4 class="text-base font-bold tracking-tight leading-snug">
                                Pertumbuhan Destinasi Wisata {{ $growthInsight['kategori_top'] ?? 'Alam' }}
                            </h4>
                            <p class="text-xs text-sky-100/80 leading-relaxed font-light">
                                Kategori <strong class="text-white font-bold">{{ $growthInsight['kategori_top'] ?? 'Alam' }}</strong> mencatat kenaikan minat tertinggi sebesar 
                                <strong class="text-white font-bold">{{ $growthInsight['persentase'] ?? 24 }}%</strong> pada minggu ini dibandingkan kategori {{ $growthInsight['kategori_pembanding'] ?? 'Rekreasi' }}.
                            </p>
                        </div>
                    </div>
                    <div class="space-y-3 pt-6">
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-[11px] font-bold text-sky-200">
                                <span>Target Bulanan</span>
                                <span>{{ $growthInsight['target_bulanan'] ?? '69%' }}</span>
                            </div>
                            <div class="w-full bg-white/10 h-2 rounded-full overflow-hidden">
                                <div class="bg-white h-full rounded-full" style="width: {{ $growthInsight['target_bulanan_percent'] ?? '69' }}%"></div>
                            </div>
                        </div>
                        <a href="{{ route('admin.analytics.category-details') }}" class="w-full block text-center py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs font-bold transition-all backdrop-blur-sm">
                            See Category Details
                        </a>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-3">
                    <h4 class="text-sm font-bold text-slate-700">Ringkasan Aktivitas</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-500">Total Pencarian (30 hari)</span>
                            <span class="font-bold">{{ number_format($analyticsStats['total_pencarian_30hari'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Total Login (30 hari)</span>
                            <span class="font-bold">{{ number_format($analyticsStats['total_login_30hari'] ?? 0, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-500">Rata-rata Sesi per User</span>
                            <span class="font-bold">{{ number_format($analyticsStats['rata_sesi_per_user'] ?? 0, 1) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TABEL PERINGKAT DESTINASI POPULER --}}
            <div id="tabel-peringkat-container">
                @include('pages.admin.partials.tabel-peringkat')
            </div>

            <<script>
                document.addEventListener('DOMContentLoaded', function () {
                    // Grafik kunjungan (sudah sesuai format {labels, data})
                    const ctx = document.getElementById('analyticsWeeklyChart')?.getContext('2d');
                    if (ctx) {
                        fetch('/api/daily-visits')
                            .then(res => res.json())
                            .then(data => {
                                new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: data.labels,
                                        datasets: [{
                                            label: 'Kunjungan',
                                            data: data.data,
                                            backgroundColor: '#1e617a',
                                            borderRadius: 6,
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        plugins: { legend: { display: false } },
                                        scales: { y: { beginAtZero: true, ticks: { callback: (v) => v.toLocaleString() } } }
                                    }
                                });
                            })
                            .catch(err => console.error('Gagal memuat kunjungan:', err));
                    }

                    // Grafik login per hari (menggunakan endpoint yang baru)
                    const loginCtx = document.getElementById('loginChart')?.getContext('2d');
                    if (loginCtx) {
                        fetch('/api/daily-logins')
                            .then(res => res.json())
                            .then(data => {
                                new Chart(loginCtx, {
                                    type: 'line',
                                    data: {
                                        labels: data.labels,
                                        datasets: [{
                                            label: 'Login Unik',
                                            data: data.data,
                                            borderColor: '#f59e0b',
                                            backgroundColor: 'rgba(245,158,11,0.1)',
                                            fill: true,
                                            tension: 0.3,
                                            pointBackgroundColor: '#f59e0b',
                                            pointBorderColor: '#f59e0b',
                                            pointRadius: 4
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        maintainAspectRatio: false,
                                        scales: { y: { beginAtZero: true, ticks: { stepSize: 1, callback: (v) => v } } }
                                    }
                                });
                            })
                            .catch(err => console.error('Gagal memuat login:', err));
                    }

                    // AJAX pagination untuk tabel peringkat (tetap)
                    const container = document.getElementById('tabel-peringkat-container');
                    if (container) {
                        container.addEventListener('click', function (e) {
                            const link = e.target.closest('.AJAX-pagination a');
                            if (link) {
                                e.preventDefault();
                                fetch(link.href, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                                    .then(res => res.text())
                                    .then(html => container.innerHTML = html)
                                    .catch(console.warn);
                            }
                        });
                    }
                });
            </script>
        </div>
    </main>
</div>
@endsection