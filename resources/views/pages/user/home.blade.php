@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

<div class="max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center py-12">
        {{-- Left Content --}}
        <div>
            <p class="text-brand-600 text-sm font-semibold tracking-widest uppercase">
                Mesin Rekomendasi Cerdas
            </p>
            <h1 class="font-display text-4xl lg:text-5xl font-bold text-slate-900 mt-4 leading-tight">
                Ciptakan <span class="text-brand-600">Liburan Bali</span> Impian Anda
            </h1>
            <p class="text-slate-600 mt-4 text-lg leading-relaxed">
                Mesin rekomendasi kami mentransformasi preferensi Anda menjadi itinerary wisata yang sempurna dan personal.
            </p>

            <div class="mt-8">
                <a href="{{ route('user.recommendation') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-brand-600 text-white rounded-lg font-semibold hover:bg-brand-700 transition shadow-lg">
                    Dapatkan Rekomendasi
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </a>
            </div>
        </div>

        {{-- Right Form --}}
        <div class="bg-white shadow-xl rounded-2xl p-8 border border-slate-100">
            <h2 class="text-2xl font-bold text-slate-900 mb-6">Mulai Eksplorasi</h2>

            <form method="GET" action="{{ route('user.recommendation') }}" class="space-y-6">
                {{-- Kabupaten --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Wilayah yang Ingin Dijelajahi</label>
                    <select name="regency" class="w-full px-4 py-3 border border-slate-200 rounded-lg text-slate-900 focus:ring-2 focus:ring-brand-500 focus:border-transparent transition">
                        <option value="">Pilih Kabupaten</option>
                        <option value="ubud">Ubud (Gianyar)</option>
                        <option value="canggu">Canggu (Badung)</option>
                        <option value="kuta">Kuta (Badung)</option>
                        <option value="sanur">Sanur (Denpasar)</option>
                    </select>
                </div>

                {{-- Minat Utama --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Minat Utama Anda</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer group">
                            <input type="radio" name="interest" value="nature" class="hidden peer" checked>
                            <div class="px-4 py-2 border-2 border-slate-200 rounded-lg text-center text-sm font-medium text-slate-600 peer-checked:border-brand-600 peer-checked:bg-brand-50 peer-checked:text-brand-600 group-hover:border-slate-300 transition">
                                🏞️ Alam
                            </div>
                        </label>
                        <label class="cursor-pointer group">
                            <input type="radio" name="interest" value="culture" class="hidden peer">
                            <div class="px-4 py-2 border-2 border-slate-200 rounded-lg text-center text-sm font-medium text-slate-600 peer-checked:border-brand-600 peer-checked:bg-brand-50 peer-checked:text-brand-600 group-hover:border-slate-300 transition">
                                🏛️ Budaya
                            </div>
                        </label>
                        <label class="cursor-pointer group">
                            <input type="radio" name="interest" value="beach" class="hidden peer">
                            <div class="px-4 py-2 border-2 border-slate-200 rounded-lg text-center text-sm font-medium text-slate-600 peer-checked:border-brand-600 peer-checked:bg-brand-50 peer-checked:text-brand-600 group-hover:border-slate-300 transition">
                                🏖️ Pantai
                            </div>
                        </label>
                        <label class="cursor-pointer group">
                            <input type="radio" name="interest" value="culinary" class="hidden peer">
                            <div class="px-4 py-2 border-2 border-slate-200 rounded-lg text-center text-sm font-medium text-slate-600 peer-checked:border-brand-600 peer-checked:bg-brand-50 peer-checked:text-brand-600 group-hover:border-slate-300 transition">
                                🍜 Kuliner
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Budget --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Budget Harian</label>
                    <input type="range" name="budget" min="100000" max="1000000" step="50000" value="500000"
                           class="w-full h-2 bg-slate-200 rounded-lg appearance-none cursor-pointer accent-brand-600">
                    <div class="flex justify-between mt-2 text-xs text-slate-500">
                        <span>Rp 100.000</span>
                        <span id="budget-display" class="font-semibold text-brand-600">Rp 500.000</span>
                        <span>Rp 1.000.000</span>
                    </div>
                </div>

                {{-- Amenities --}}
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-3">Fasilitas Penting</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="amenities[]" value="parking" class="w-4 h-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                            <span class="ml-2 text-sm text-slate-700">Area Parkir</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="amenities[]" value="wifi" checked class="w-4 h-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                            <span class="ml-2 text-sm text-slate-700">WiFi</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="amenities[]" value="restroom" class="w-4 h-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                            <span class="ml-2 text-sm text-slate-700">Kamar Mandi Bersih</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="amenities[]" value="restaurant" class="w-4 h-4 rounded border-slate-300 text-brand-600 focus:ring-brand-500">
                            <span class="ml-2 text-sm text-slate-700">Restoran</span>
                        </label>
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="w-full mt-8 px-6 py-3 bg-brand-600 text-white font-semibold rounded-lg hover:bg-brand-700 transition shadow-lg flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Cari Rekomendasi
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const budgetInput = document.querySelector('input[name="budget"]');
    const budgetDisplay = document.getElementById('budget-display');
    
    if (budgetInput && budgetDisplay) {
        const formatCurrency = (value) => {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(value);
        };
        
        budgetInput.addEventListener('input', () => {
            budgetDisplay.textContent = formatCurrency(budgetInput.value);
        });
    }
</script>
@endpush

@endsection