@extends('layouts.app')

@section('title', 'Analytics Dashboard — Jelajah Bali')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f4f7fc; }
</style>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush

@section('body')
<div class="min-h-screen flex">

    {{-- ================= SIDEBAR LEFT ================= --}}
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col justify-between p-6 shrink-0 h-screen sticky top-0">
        <div>
            <div class="mb-8 px-2">
                <h2 class="text-[#1e293b] font-bold text-lg leading-tight">Admin Jelajah</h2>
                <p class="text-xs text-gray-400 font-medium tracking-wider uppercase mt-0.5">Bali Management</p>
            </div>

            <nav class="space-y-1">
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:text-gray-900 rounded-xl transition-colors text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/></svg>
                    Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:text-gray-900 rounded-xl transition-colors text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 114 0v2m-4 0h4m-4 0H5m12 0h2M12 7h2"/></svg>
                    Kelola Wisata
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-gray-500 hover:text-gray-900 rounded-xl transition-colors text-sm font-medium">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    Kelola User
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-[#e8f2f9] text-[#0071a9] rounded-xl text-sm font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2"/></svg>
                    Analytics
                </a>
            </nav>
        </div>

        <div class="border-t border-gray-100 pt-4 space-y-4">
            <div class="flex items-center gap-3 px-2">
                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=0071a9&color=fff" alt="Avatar" class="w-10 h-10 rounded-full object-cover">
                <div>
                    <h4 class="text-sm font-bold text-gray-800">Budi Santoso</h4>
                    <p class="text-[11px] text-gray-400 font-medium">Super Admin</p>
                </div>
            </div>
            <a href="#" class="flex items-center gap-2 px-2 text-xs font-semibold text-gray-400 hover:text-red-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                Logout
            </a>
        </div>
    </aside>

    {{-- ================= MAIN CONTENT AREA ================= --}}
    <main class="flex-1 p-8 overflow-y-auto h-screen">
        
        <div class="flex justify-between items-center mb-6">
            <div>
                <a href="{{ url('/admin/analytics') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#0071a9] mb-2 hover:underline">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Back to Analytics
                </a>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Category Details</h1>
                <p class="text-xs text-gray-400 mt-0.5">Explore performance and trends by destination category</p>
            </div>

            <button class="flex items-center gap-2 bg-white px-4 py-2 border border-gray-100 rounded-xl shadow-sm text-xs font-medium text-gray-700 hover:bg-gray-50">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                May 12 - May 18, 2024
                <svg class="w-3 h-3 text-gray-400 ml-1" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
            </button>
        </div>

        {{-- ROW 1: STATS CARD GRID --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 flex items-center gap-4 shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0V11m0 5H9m4-3h-2m2 0h2m4-3h-2m2 0h2m-9-3h2m2 0h2m-4 0v4m-4 0h.01"/></svg>
                </div>
                <div>
                    <span class="block text-[11px] text-gray-400 font-medium">Total Destinations</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-0.5">120</h3>
                    <span class="text-[10px] text-gray-400">Across all categories</span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 flex items-center gap-4 shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                </div>
                <div>
                    <span class="block text-[11px] text-gray-400 font-medium">Total Visitors</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-0.5">45,000</h3>
                    <span class="text-[10px] text-gray-400">Across all categories</span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 flex items-center gap-4 shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <div>
                    <span class="block text-[11px] text-gray-400 font-medium">Growth Rate</span>
                    <h3 class="text-xl font-bold text-emerald-600 mt-0.5">+35%</h3>
                    <span class="text-[10px] text-gray-400">vs last 7 days</span>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl border border-gray-100 flex items-center gap-4 shadow-sm">
                <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <span class="block text-[11px] text-gray-400 font-medium">Monthly Target</span>
                    <h3 class="text-xl font-bold text-gray-800 mt-0.5">80%</h3>
                    <span class="text-[10px] text-gray-400">Achievement</span>
                </div>
            </div>
        </div>

        {{-- ROW 2: PERFORMANCE (LINE CHART) & RANKING (TABLE) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            
            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-sm font-bold text-gray-800">Category Performance (Last 30 Days)</h4>
                    <div class="flex gap-3 text-[10px] font-semibold text-gray-500">
                        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-blue-500"></span> Umum</span>
                        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-emerald-500"></span> Alam</span>
                        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-purple-500"></span> Budaya</span>
                        <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-amber-500"></span> Kuliner</span>
                    </div>
                </div>
                {{-- ID ditambahkan untuk penargetan ApexCharts --}}
                <div class="pt-4 px-2 relative">
                    <div id="categoryPerformanceChart"></div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                <div>
                    <h4 class="text-sm font-bold text-gray-800 mb-4">Category Ranking</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-gray-400 font-medium border-b border-gray-50">
                                    <th class="pb-2">RANK</th>
                                    <th class="pb-2">CATEGORY</th>
                                    <th class="pb-2 text-right">DESTINATIONS</th>
                                    <th class="pb-2 text-right">VISITORS</th>
                                    <th class="pb-2 text-right">GROWTH</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 font-medium text-gray-700">
                                <tr>
                                    <td class="py-2.5"><span class="w-5 h-5 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-[10px]">1</span></td>
                                    <td class="py-2.5"><span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-600 text-[10px]">Umum</span></td>
                                    <td class="py-2.5 text-right">120</td>
                                    <td class="py-2.5 text-right">45,000</td>
                                    <td class="py-2.5 text-right text-emerald-500">+35%</td>
                                </tr>
                                <tr>
                                    <td class="py-2.5"><span class="w-5 h-5 rounded-full bg-slate-200 text-gray-700 flex items-center justify-center font-bold text-[10px]">2</span></td>
                                    <td class="py-2.5"><span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 text-[10px]">Alam</span></td>
                                    <td class="py-2.5 text-right">85</td>
                                    <td class="py-2.5 text-right">32,000</td>
                                    <td class="py-2.5 text-right text-emerald-500">+18%</td>
                                </tr>
                                <tr>
                                    <td class="py-2.5"><span class="w-5 h-5 rounded-full bg-slate-200 text-gray-700 flex items-center justify-center font-bold text-[10px]">3</span></td>
                                    <td class="py-2.5"><span class="px-2 py-0.5 rounded-md bg-purple-50 text-purple-600 text-[10px]">Budaya</span></td>
                                    <td class="py-2.5 text-right">64</td>
                                    <td class="py-2.5 text-right">28,000</td>
                                    <td class="py-2.5 text-right text-emerald-500">+12%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-between items-center border-t border-gray-50 pt-3 text-[11px] text-gray-400">
                    <span>Showing 1 to 3 of 3 results</span>
                    <div class="flex gap-1">
                        <button class="w-6 h-6 flex items-center justify-center rounded border border-gray-100 bg-gray-50 disabled:opacity-50" disabled>&lsaquo;</button>
                        <button class="w-6 h-6 flex items-center justify-center rounded bg-[#0071a9] text-white font-bold">1</button>
                        <button class="w-6 h-6 flex items-center justify-center rounded border border-gray-100 bg-gray-50" disabled>&rsaquo;</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- ROW 3: DISTRIBUTION (DONUT) & TOP DESTINATIONS LIST --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                <h4 class="text-sm font-bold text-gray-800 mb-2">Destination Distribution</h4>
                {{-- ID ditambahkan untuk penargetan ApexCharts dinamis --}}
                <div class="my-2 flex items-center justify-center relative">
                    <div id="destinationDistributionChart" class="w-full"></div>
                </div>
                <div class="grid grid-cols-2 gap-2 text-[11px] font-medium text-gray-600 border-t border-gray-50 pt-3">
                    <div class="flex justify-between items-center"><span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>Umum</span> <span>40% <span class="text-gray-400">(120)</span></span></div>
                    <div class="flex justify-between items-center"><span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>Alam</span> <span>28% <span class="text-gray-400">(85)</span></span></div>
                    <div class="flex justify-between items-center"><span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-purple-500"></span>Budaya</span> <span>21% <span class="text-gray-400">(64)</span></span></div>
                    <div class="flex justify-between items-center"><span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>Kuliner</span> <span>11% <span class="text-gray-400">(42)</span></span></div>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col justify-between">
                <div>
                    <h4 class="text-sm font-bold text-gray-800 mb-4">Top Destinations in Category</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-gray-400 font-medium border-b border-gray-50">
                                    <th class="pb-2">DESTINATION</th>
                                    <th class="pb-2">CATEGORY</th>
                                    <th class="pb-2 text-right">VISITORS</th>
                                    <th class="pb-2 text-right">GROWTH</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-gray-700 font-medium">
                                <tr>
                                    <td class="py-3 flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 overflow-hidden shrink-0">
                                            <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=80&q=80" alt="Wisata" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-gray-800">Jembatan Kuning Tukad Yeh Unda</h5>
                                            <p class="text-[10px] text-gray-400 mt-0.5">ID: DEST-0244</p>
                                        </div>
                                    </td>
                                    <td class="py-3"><span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-600 text-[10px]">Umum</span></td>
                                    <td class="py-3 text-right font-bold">5,000</td>
                                    <td class="py-3 text-right text-emerald-500">+7.4%</td>
                                </tr>
                                <tr>
                                    <td class="py-3 flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-xl bg-slate-100 overflow-hidden shrink-0">
                                            <img src="https://images.unsplash.com/photo-1510798831971-661eb04b3739?auto=format&fit=crop&w=80&q=80" alt="Wisata" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h5 class="font-bold text-gray-800">Kroya Waterfall</h5>
                                            <p class="text-[10px] text-gray-400 mt-0.5">ID: DEST-0281</p>
                                        </div>
                                    </td>
                                    <td class="py-3"><span class="px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-600 text-[10px]">Alam</span></td>
                                    <td class="py-3 text-right font-bold">4,999</td>
                                    <td class="py-3 text-right text-red-500">-8.4%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex justify-between items-center border-t border-gray-50 pt-4 text-[11px] text-gray-400">
                    <span>Showing 1 to 2 of 2 results</span>
                    <div class="flex gap-1">
                        <button class="w-6 h-6 flex items-center justify-center rounded border border-gray-100 bg-gray-50 disabled:opacity-50" disabled>&lsaquo;</button>
                        <button class="w-6 h-6 flex items-center justify-center rounded bg-[#0071a9] text-white font-bold">1</button>
                        <button class="w-6 h-6 flex items-center justify-center rounded border border-gray-100 bg-gray-50" disabled>&rsaquo;</button>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
</div>
@endsection

{{-- ================= INJEKSI SCRIPT APEXCHARTS DINAMIS ================= --}}
@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 1. KONFIGURASI CATEGORY PERFORMANCE (LINE/AREA CHART)
        const performanceOptions = {
            chart: {
                type: 'area',
                height: 260,
                toolbar: { show: false },
                sparkline: { enabled: false }
            },
            dataLabels: { enabled: false },
            stroke: { curve: 'smooth', width: 2 },
            colors: ['#3b82f6', '#10b981', '#a855f7', '#f59e0b'], // Menyesuaikan warna legend HTML kamu
            series: [
                { name: 'Umum', data: [31, 40, 28, 51, 42, 109, 100] },
                { name: 'Alam', data: [11, 32, 45, 32, 34, 52, 41] },
                { name: 'Budaya', data: [15, 22, 33, 24, 18, 43, 33] },
                { name: 'Kuliner', data: [9, 14, 21, 15, 27, 30, 22] }
            ],
            xaxis: {
                categories: ['Wk 1', 'Wk 2', 'Wk 3', 'Wk 4', 'Wk 5', 'Wk 6', 'Wk 7'],
                labels: { style: { colors: '#9ca3af', fontSize: '10px' } },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: { style: { colors: '#9ca3af', fontSize: '10px' } }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 4
            },
            legend: { show: false },
            fill: {
                type: 'gradient',
                gradient: { opacityFrom: 0.2, opacityTo: 0.02 }
            }
        };

        const performanceChart = new ApexCharts(document.querySelector("#categoryPerformanceChart"), performanceOptions);
        performanceChart.render();

        // 2. KONFIGURASI DESTINATION DISTRIBUTION (DONUT CHART)
        const distributionOptions = {
            chart: {
                type: 'donut',
                height: 200
            },
            colors: ['#3b82f6', '#10b981', '#a855f7', '#f59e0b'],
            labels: ['Umum', 'Alam', 'Budaya', 'Kuliner'],
            series: [120, 85, 64, 42], // Data mentah sesuai teks HTML kamu
            dataLabels: { enabled: false },
            legend: { show: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '78%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Total',
                                color: '#9ca3af',
                                fontSize: '12px',
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                }
                            }
                        }
                    }
                }
            }
        };

        const distributionChart = new ApexCharts(document.querySelector("#destinationDistributionChart"), distributionOptions);
        distributionChart.render();
    });
</script>
@endpush