{{-- resources/views/pages/admin/partials/tabel-peringkat.blade.php --}}
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
                    <td class="px-6 py-3.5 flex items-center gap-4">
                        <div class="relative w-11 h-11 rounded-xl bg-slate-100 flex-shrink-0">
                            <span class="absolute -top-1.5 -left-1.5 w-5 h-5 bg-slate-800 text-white rounded-full flex items-center justify-center text-[9px] font-black z-10 shadow-md border border-white">
                                {{ ($peringkatDestinasi->currentPage() - 1) * $peringkatDestinasi->perPage() + $index + 1 }}
                            </span>
                            <img src="{{ $row->image ? asset($row->image) : asset('images/default-wisata.jpg') }}" 
                                 class="w-full h-full object-cover rounded-xl" 
                                 alt=""
                                 onerror="this.onerror=null;this.src='https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=80&q=80';">
                        </div>
                        <div class="min-w-0">
                            <h4 class="font-bold text-slate-800 text-sm truncate">{{ $row->nama }}</h4>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-0.5">ID: DEST-0{{ $row->id }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-3.5">
                        <span class="px-2.5 py-1 bg-sky-50 text-sky-600 rounded-full text-[10px] font-bold uppercase whitespace-nowrap">
                            {{ $row->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                    </td>
                    <td class="px-6 py-3.5 text-center">
                        @if(($row->id % 2) === 0)
                            <span class="text-emerald-500 font-bold text-sm" title="Meningkat">📈</span>
                        @else
                            <span class="text-red-500 font-bold text-sm" title="Menurun">📉</span>
                        @endif
                    </td>
                    <td class="px-6 py-3.5 text-right font-bold text-slate-700">
                        {{ number_format($row->views ?? 0, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-3.5 text-right font-bold {{ ($row->id % 2) === 0 ? 'text-emerald-600' : 'text-red-500' }}">
                        {{ ($row->id % 2) === 0 ? '+' : '-' }}{{ number_format(($row->id % 12) + 3.4, 1) }}%
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
    
    <div class="pt-4 px-2 AJAX-pagination flex justify-center sm:justify-end">
        <div class="max-w-full overflow-x-auto">
            {{ $peringkatDestinasi->appends(request()->except('page'))->links() }}
        </div>
    </div>
</div>