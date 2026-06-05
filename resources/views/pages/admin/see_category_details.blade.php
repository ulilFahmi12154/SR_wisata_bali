@extends('layouts.app')

@section('topbar_title', 'Category Details')
@section('title', 'Analytics Dashboard — Jelajah Bali')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
</style>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
@endpush

@section('body')
<div class="min-h-screen bg-[#f8fafc] flex font-sans antialiased text-slate-800">
    @include('components.admin.sidebar')
    <main class="flex-1 pl-0 sm:pl-64 min-h-screen flex flex-col justify-between transition-all duration-300">
        <div class="p-8 max-w-7xl w-full mx-auto space-y-6">
            @include('components.admin.topbar')

            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 pt-2">
                <div>
                    <a href="{{ url('/admin/analytics') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1e617a] mb-1.5 hover:underline">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Analytics
                    </a>
                    <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Category Details</h1>
                    <p class="text-xs text-slate-400 mt-0.5">Explore performance and trends by destination category</p>
                </div>
            </div>

            <!-- Stat cards (sama seperti sebelumnya, sudah benar) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0V11m0 5H9m4-3h-2m2 0h2m4-3h-2m2 0h2m-9-3h2m2 0h2m-4 0v4m-4 0h.01"/></svg>
                    </div>
                    <div>
                        <span class="block text-[11px] text-slate-400 font-medium uppercase tracking-wider">Total Destinations</span>
                        <h3 class="text-xl font-bold text-slate-800 mt-0.5">{{ $totalDestinations }}</h3>
                        <span class="text-[10px] text-slate-400">Across all categories</span>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <div>
                        <span class="block text-[11px] text-slate-400 font-medium uppercase tracking-wider">Total Visitors</span>
                        <h3 class="text-xl font-bold text-slate-800 mt-0.5">{{ number_format($totalVisitors, 0, ',', '.') }}</h3>
                        <span class="text-[10px] text-slate-400">Across all categories</span>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div>
                        <span class="block text-[11px] text-slate-400 font-medium uppercase tracking-wider">Growth Rate</span>
                        <h3 class="text-xl font-bold {{ $growthRate >= 0 ? 'text-emerald-600' : 'text-red-600' }} mt-0.5">{{ $growthRate >= 0 ? '+' : '' }}{{ $growthRate }}%</h3>
                        <span class="text-[10px] text-slate-400">vs last 7 days</span>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl border border-slate-100 flex items-center gap-4 shadow-sm">
                    <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <div>
                        <span class="block text-[11px] text-slate-400 font-medium uppercase tracking-wider">Monthly Target</span>
                        <h3 class="text-xl font-bold text-slate-800 mt-0.5">80%</h3>
                        <span class="text-[10px] text-slate-400">Achievement</span>
                    </div>
                </div>
            </div>

            <!-- Line Chart & Ranking -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <h4 class="text-sm font-bold text-slate-800 mb-4">Category Performance (Last 7 Days)</h4>
                    <div id="categoryPerformanceChart"></div>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <h4 class="text-sm font-bold text-slate-800 mb-4">Category Ranking</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead>
                                <tr class="text-slate-400 font-medium border-b border-slate-100 uppercase tracking-wider text-[10px]">
                                    <th class="pb-3 pl-1">Rank</th>
                                    <th class="pb-3">Category</th>
                                    <th class="pb-3 text-right">Dest</th>
                                    <th class="pb-3 text-right">Visitors</th>
                                    <th class="pb-3 text-right">Growth</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50 font-medium text-slate-700">
                                @forelse($categoryRanking as $index => $cat)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="py-3 pl-1">
                                        <span class="w-5 h-5 rounded-full {{ $index == 0 ? 'bg-slate-900 text-white' : 'bg-slate-200 text-slate-700' }} flex items-center justify-center font-bold text-[10px]">{{ $index+1 }}</span>
                                    </td>
                                    <td class="py-3"><span class="px-2 py-0.5 rounded-md bg-blue-50 text-blue-600 text-[10px]">{{ $cat->nama_kategori }}</span></td>
                                    <td class="py-3 text-right">{{ $cat->total_destinasi }}</td>
                                    <td class="py-3 text-right">{{ number_format($cat->total_kunjungan) }}</td>
                                    <td class="py-3 text-right {{ ($cat->growth ?? 0) >= 0 ? 'text-emerald-500' : 'text-red-500' }}">{{ ($cat->growth ?? 0) >= 0 ? '+' : '' }}{{ $cat->growth ?? 0 }}%</td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="py-4 text-center text-slate-400">No data available</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Donut Chart -->
            <div class="grid grid-cols-1 gap-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-100 shadow-sm">
                    <h4 class="text-sm font-bold text-slate-800 mb-2">Destination Distribution</h4>
                    <div id="destinationDistributionChart" class="mx-auto" style="max-width: 400px;"></div>
                    <div class="grid grid-cols-2 gap-x-4 gap-y-2.5 text-[11px] font-medium text-slate-600 border-t border-slate-100 pt-4 mt-4">
                        @foreach($distribution as $item)
                        <div class="flex justify-between items-center">
                            <span class="flex items-center gap-1.5">
                                <span class="w-2.5 h-2.5 rounded-full" style="background-color: {{ $loop->index % 4 == 0 ? '#3B82F6' : ($loop->index % 4 == 1 ? '#10B981' : ($loop->index % 4 == 2 ? '#8B5CF6' : '#F59E0B')) }}"></span>
                                {{ $item['name'] }}
                            </span>
                            <span class="font-bold text-slate-800">{{ $item['percentage'] }}%</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Line Chart
        const seriesData = @json($seriesData);
        const categories = @json($dates);
        if (seriesData.length > 0) {
            const performanceOptions = {
                chart: { type: 'area', height: 280, toolbar: { show: false }, fontFamily: 'Plus Jakarta Sans, sans-serif' },
                dataLabels: { enabled: false },
                stroke: { curve: 'smooth', width: 2 },
                colors: ['#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', '#EF4444', '#EC4899'],
                series: seriesData,
                xaxis: { categories: categories, labels: { style: { colors: '#94a3b8', fontSize: '10px' } } },
                yaxis: { labels: { style: { colors: '#94a3b8', fontSize: '10px' } } },
                grid: { borderColor: '#f1f5f9' },
                legend: { position: 'top', horizontalAlign: 'right', fontSize: '11px' }
            };
            new ApexCharts(document.querySelector("#categoryPerformanceChart"), performanceOptions).render();
        } else {
            document.querySelector("#categoryPerformanceChart").innerHTML = '<div class="text-center text-slate-400 py-10">No performance data available</div>';
        }

        // Donut Chart
        const distribution = @json($distribution);
        if (distribution.length > 0) {
            const donutOptions = {
                chart: { type: 'donut', height: 280, fontFamily: 'Plus Jakarta Sans, sans-serif' },
                colors: ['#3B82F6', '#10B981', '#8B5CF6', '#F59E0B', '#EF4444', '#EC4899'],
                series: distribution.map(item => item.count),
                labels: distribution.map(item => item.name),
                legend: { show: false },
                dataLabels: { enabled: false },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '70%',
                            labels: {
                                show: true,
                                total: { show: true, label: 'Total', fontSize: '12px', color: '#94a3b8', formatter: () => '{{ $totalDestinations }}' }
                            }
                        }
                    }
                }
            };
            new ApexCharts(document.querySelector("#destinationDistributionChart"), donutOptions).render();
        } else {
            document.querySelector("#destinationDistributionChart").innerHTML = '<div class="text-center text-slate-400 py-10">No distribution data</div>';
        }
    });
</script>
@endsection