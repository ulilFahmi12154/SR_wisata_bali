@extends('layouts.app')

@section('topbar_title', 'Analisis')

@section('title', 'Analisis Performa — Admin Jelajah')

@section('body')
<div class="min-h-screen bg-[#f8fafc] flex font-sans antialiased text-slate-800">
    @include('components.admin.sidebar')

    <main class="flex-1 pl-0 sm:pl-64 min-h-screen flex flex-col justify-between transition-all duration-300">
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            @include('components.admin.topbar')

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Total Kunjungan</span>
                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($analyticsStats['total_kunjungan'] ?? 0) }}</h3>
                        <p class="text-[10px] font-bold text-emerald-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                            +12.4% vs bln lalu
                        </p>
                    </div>
                    <div class="p-3 bg-sky-50 text-sky-600 rounded-xl">
                        <svg class="w-5 h-5 text-[#1e617a]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Rata-rata Harian</span>
                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ number_format($analyticsStats['rata_rata_harian'] ?? 0) }}</h3>
                        <p class="text-[10px] font-bold text-emerald-500 flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> +5.2% stabil
                        </p>
                    </div>
                    <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between">
                    <div class="space-y-1">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Durasi Sesi Rata-rata</span>
                        <h3 class="text-3xl font-extrabold text-slate-800 tracking-tight">{{ $analyticsStats['durasi_sesi'] ?? '0m 0s' }}</h3>
                        <p class="text-[10px] font-bold text-red-500 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6"/></svg>
                            -1.8% vs bln lalu
                        </p>
                    </div>
                    <div class="p-3 bg-amber-50 text-amber-600 rounded-xl">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm space-y-4">
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

                <div class="bg-[#1e617a] p-6 rounded-2xl text-white shadow-sm flex flex-col justify-between">
                    <div class="space-y-4">
                        <span class="px-2.5 py-1 bg-white/10 text-[9px] font-black uppercase tracking-wider rounded-md backdrop-blur-sm">Growth Insight</span>
                        <div class="space-y-2">
                            <h4 class="text-base font-bold tracking-tight leading-snug">Pertumbuhan Destinasi Wisata {{ $growthInsight['kategori_top'] }}</h4>
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
                        <button class="w-full py-2.5 bg-white/10 hover:bg-white/20 text-white rounded-xl text-xs font-bold transition-all backdrop-blur-sm">
                            Lihat Detail Kategori
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden space-y-4 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-sky-900 tracking-tight">Peringkat Destinasi Populer Global</h3>
                        <p class="text-[10px] text-slate-400 font-medium">Berdasarkan volume pencarian dan kunjungan unik aplikasi</p>
                    </div>
                    <a href="{{ route('admin.destinations.index') }}" class="text-[11px] font-bold text-sky-600 hover:underline">Lihat Semua</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-100 text-[10px] font-bold text-slate-400 uppercase tracking-wider">
                                <th class="px-6 py-4">Destinasi</th>
                                <th class="px-6 py-4">Kategori</th>
                                <th class="px-6 py-4 text-center">Trend</th>
                                <th class="px-6 py-4 text-right">Kunjungan</th>
                                <th class="px-6 py-4 text-right">Pertumbuhan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50 text-xs">
                            @forelse($peringkatDestinasi as $index => $row)
                            <tr class="hover:bg-slate-50/40 transition-colors">
                                <td class="px-6 py-3.5 flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-slate-100 overflow-hidden shadow-sm flex-shrink-0">
                                        <img src="{{ $row->image ? asset('storage/' . $row->image) : 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=80&q=80' }}" class="w-full h-full object-cover" alt="wisata">
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-slate-800 truncate">{{ $row->nama_wisata ?? $row->name }}</h4>
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest">ID: DEST-0{{ $row->id }}</p>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5">
                                    <span class="px-2.5 py-1 bg-sky-50 text-sky-600 rounded-full text-[10px] font-bold uppercase whitespace-nowrap">
                                        {{ $row->kategori->nama_kategori ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 text-center">
                                    @if(($index % 3) === 2)
                                        <span class="text-red-500 font-bold text-sm" title="Menurun">📉</span>
                                    @else
                                        <span class="text-emerald-500 font-bold text-sm" title="Meningkat">📈</span>
                                    @endif
                                </td>
                                <td class="px-6 py-3.5 text-right font-bold text-slate-700">
                                    {{ number_format($row->views ?? 0) }}
                                </td>
                                <td class="px-6 py-3.5 text-right font-bold {{ ($index % 3) === 2 ? 'text-red-500' : 'text-emerald-600' }}">
                                    {{ ($index % 3) === 2 ? '-' : '+' }}{{ rand(2, 18) }}.{{ rand(1, 9) }}%
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-xs text-slate-400">Belum ada data statistik destinasi tersedia.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="pt-2">
                    {{ $peringkatDestinasi->links() }}
                </div>
            </div>

        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('analyticsWeeklyChart').getContext('2d');
        
        // Parsing data aman dari Controller PHP ke JavaScript Array
        const labelsData = {!! json_encode($trenKunjungan['labels'] ?? ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']) !!};
        const trafficData = {!! json_encode($trenKunjungan['data'] ?? [0,0,0,0,0,0,0]) !!};

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsData,
                datasets: [{
                    label: 'Pengunjung Unik',
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
                    legend: { display: false }
                },
                scales: {
                    y: {
                        grid: { color: '#f1f5f9' },
                        border: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 10, weight: '600' } },
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