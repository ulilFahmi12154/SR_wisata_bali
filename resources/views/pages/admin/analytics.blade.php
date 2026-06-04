@extends('layouts.app')

@section('topbar_title', 'Analisis')
@section('title', 'Analisis Performa — Admin Jelajah')

@section('body')
<div class="min-h-screen bg-[#f8fafc] flex font-sans antialiased text-slate-800">
    @include('components.admin.sidebar')

    <main class="flex-1 pl-0 sm:pl-64 min-h-screen flex flex-col justify-between transition-all duration-300">
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            @include('components.admin.topbar')

            {{-- ==========================================
                 KARTU STATISTIK UTAMA (TREN DINAMIS)
                 ========================================== --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                
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
                                    Stabil (vs bln lalu)
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
                                <span class="text-emerald-600 flex items-center gap-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                    +{{ $analyticsStats['tren_rata_harian']['persen'] }}%
                                </span>
                                <span class="text-slate-400">vs bln lalu</span>
                            @elseif(($analyticsStats['tren_rata_harian']['status'] ?? '') === 'turun')
                                <span class="text-red-500 flex items-center gap-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/>
                                    </svg>
                                    -{{ $analyticsStats['tren_rata_harian']['persen'] }}%
                                </span>
                                <span class="text-slate-400">vs bln lalu</span>
                            @else
                                <span class="text-slate-500 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Stabil (vs bln lalu)
                                </span>
                            @endif
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
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Durasi Sesi Rata-rata</span>
                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">
                            {{ $analyticsStats['durasi_sesi'] ?? '0m 0s' }}
                        </h3>
                        
                        <div class="text-[10px] font-bold flex items-center gap-1 mt-1">
                            @if(($analyticsStats['tren_durasi_sesi']['status'] ?? '') === 'naik')
                                <span class="text-emerald-600 flex items-center gap-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                                    </svg>
                                    +{{ $analyticsStats['tren_durasi_sesi']['persen'] }}%
                                </span>
                                <span class="text-slate-400">vs bln lalu</span>
                            @elseif(($analyticsStats['tren_durasi_sesi']['status'] ?? '') === 'turun')
                                <span class="text-red-500 flex items-center gap-0.5">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/>
                                    </svg>
                                    -{{ $analyticsStats['tren_durasi_sesi']['persen'] }}%
                                </span>
                                <span class="text-slate-400">vs bln lalu</span>
                            @else
                                <span class="text-slate-500 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                    Stabil (vs bln lalu)
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- ==========================================
                 GRAFIK TREN & GROWTH INSIGHT (WIRE:IGNORE)
                 ========================================== --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Grafik Tren --}}
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4" wire:ignore>
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-sky-900 tracking-tight">Tren Kunjungan Harian</h3>
                            <p class="text-[10px] text-slate-400 font-medium">Visualisasi fluktuasi pengunjung 7 hari terakhir</p>
                        </div>
                        <span class="text-[10px] font-bold text-slate-400 flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-[#1e617a]"></span> Minggu Ini
                        </span>
                    </div>
                    <div class="h-64 relative w-full">
                        <canvas id="analyticsWeeklyChart"></canvas>
                    </div>
                </div>

                {{-- Insight Card --}}
                <div class="bg-[#1e617a] p-6 rounded-2xl text-white shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <span class="px-2.5 py-1 bg-white/10 text-[9px] font-black uppercase tracking-wider rounded-md backdrop-blur-sm">
                            Growth Insight
                        </span>
                        <div class="space-y-2">
                            <h4 class="text-base font-bold tracking-tight leading-snug">
                                Pertumbuhan Destinasi Wisata {{ $growthInsight['kategori_top'] }}
                            </h4>
                            <p class="text-xs text-sky-100/80 leading-relaxed font-light">
                                Kategori <strong class="text-white font-bold">{{ $growthInsight['kategori_top'] }}</strong> mencatat kenaikan minat tertinggi sebesar 
                                <strong class="text-white font-bold">{{ $growthInsight['persentase'] }}%</strong> pada minggu ini dibandingkan kategori {{ $growthInsight['kategori_pembanding'] }}.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-3 pt-6">
                        <div class="space-y-1">
                            <div class="flex items-center justify-between text-[11px] font-bold text-sky-200">
                                <span>Target Bulanan</span>
                                <span>{{ $growthInsight['persentase'] + 45 > 100 ? 92 : $growthInsight['persentase'] + 45 }}%</span>
                            </div>
                            <div class="w-full bg-white/10 h-2 rounded-full overflow-hidden">
                                <div class="bg-white h-full rounded-full" style="width: {{ $growthInsight['persentase'] + 45 > 100 ? 92 : $growthInsight['persentase'] + 45 }}%"></div>
                            </div>
                        </div>
                        <a href="{{ route('admin.analytics.category-details') }}" class="w-full block text-center py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs font-bold transition-all backdrop-blur-sm">
                            See Category Details
                        </a>
                    </div>
                </div>
            </div>

            {{-- ==========================================
                 TABEL PERINGKAT DESTINASI POPULER (AJAX CONTEXT)
                 ========================================== --}}
            <div id="tabel-peringkat-container">
                @include('pages.admin.partials.tabel-peringkat')
            </div>

            {{-- SCRIPT AJAX NATIVE UNTUK MENANGKAP TOMBOL PAGINATION --}}
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const container = document.getElementById('tabel-peringkat-container');

                    if (container) {
                        container.addEventListener('click', function (e) {
                            const link = e.target.closest('.AJAX-pagination a');
                            
                            if (link) {
                                e.preventDefault();
                                const targetUrl = link.getAttribute('href');

                                fetch(targetUrl, {
                                    headers: {
                                        'X-Requested-With': 'XMLHttpRequest'
                                    }
                                })
                                .then(response => response.text())
                                .then(html => {
                                    container.innerHTML = html;
                                })
                                .catch(error => console.warn('Gagal memuat data pagination:', error));
                            }
                        });
                    }
                });
            </script>

        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('analyticsWeeklyChart').getContext('2d');
        
        const labelsData = {!! json_encode($grafikKunjungan['labels'] ?? ['Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min', 'Sen']) !!};
        const trafficData = {!! json_encode($grafikKunjungan['data'] ?? [0,0,0,0,0,0,0]) !!};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsData,
                datasets: [{
                    label: 'Total Kunjungan',
                    data: trafficData,
                    backgroundColor: '#1e617a', 
                    borderRadius: 6,
                    barThickness: 'flex',
                    maxBarThickness: 28
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let value = context.raw || 0;
                                return ' ' + value.toLocaleString('id-ID') + ' Kunjungan';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        grid: { color: '#f1f5f9' },
                        border: { display: false },
                        ticks: { 
                            color: '#94a3b8', 
                            font: { size: 10, weight: '600' },
                            callback: function(value) {
                                return value.toLocaleString('id-ID');
                            }
                        },
                        beginAtZero: true
                    },
                    x: {
                        grid: { display: false },
                        border: { display: false },
                        ticks: { color: '#475569', font: { size: 10, weight: '600' } }
                    }
                }
            }
        });
    });
</script>
@endsection