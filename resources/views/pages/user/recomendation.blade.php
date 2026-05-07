@extends('layouts.user')

@section('content')

<div class="max-w-6xl mx-auto space-y-8">
    {{-- Page Header --}}
    <header class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="space-y-2">
                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Rekomendasi Khusus</p>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Destinasi yang Sesuai untuk Anda</h1>
                <p class="max-w-2xl text-sm leading-6 text-slate-500">Berdasarkan preferensi dan riwayat kunjungan Anda, kami merekomendasikan destinasi-destinasi terbaik.</p>
            </div>
        </div>
    </header>

    {{-- Filter Section --}}
    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="flex-1">
                <input type="text"
                       placeholder="Cari destinasi..."
                       class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div class="flex gap-2">
                <select class="px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Kategori: Semua</option>
                    <option>Pantai</option>
                    <option>Gunung</option>
                    <option>Kuil</option>
                    <option>Seni & Budaya</option>
                </select>
                <select class="px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Urutkan: Relevansi</option>
                    <option>Rating Tertinggi</option>
                    <option>Terbaru</option>
                    <option>Populer</option>
                </select>
            </div>
        </div>
    </div>

    {{-- Recommendation Cards --}}
    <div class="space-y-6">
        @forelse($recommendations ?? [] as $index => $destination)
        <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="grid gap-6 lg:grid-cols-4">
                {{-- Image --}}
                <div class="lg:col-span-1">
                    <div class="relative rounded-xl overflow-hidden h-48 lg:h-full bg-slate-200">
                        <img src="{{ $destination->image_url ?? 'https://via.placeholder.com/300x250' }}"
                             alt="{{ $destination->name }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        <div class="absolute top-3 left-3 flex gap-2">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-white/90 text-slate-900">{{ $destination->kategori->name ?? 'Destinasi' }}</span>
                        </div>
                        @if($index == 0)
                        <div class="absolute bottom-3 right-3 px-3 py-1 rounded-full text-xs font-semibold bg-blue-600 text-white">
                            🏆 Teratas
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Content --}}
                <div class="lg:col-span-2 space-y-3">
                    <div>
                        <h3 class="text-2xl font-semibold text-slate-900">{{ $destination->name }}</h3>
                        <p class="text-sm text-slate-500 mt-1">📍 {{ $destination->lokasi->nama_lokasi ?? 'Bali' }}</p>
                    </div>

                    <p class="text-slate-600 line-clamp-2">{{ $destination->description }}</p>

                    <div class="flex flex-wrap gap-2 pt-2">
                        @foreach($destination->facilities ?? [] as $facility)
                            @php
                                $facilityIcons = [
                                    'parking' => '🅿️ Parkir',
                                    'restaurant' => '🍽️ Restoran',
                                    'toilet' => '🚻 Toilet',
                                    'wheelchair' => '♿ Akses Kursi Roda',
                                    'wifi' => '📶 WiFi',
                                    'guide' => '👨‍🏫 Pemandu',
                                ];
                            @endphp
                            @if(isset($facilityIcons[$facility]))
                            <span class="px-2 py-1 rounded-full text-xs bg-slate-100 text-slate-700">
                                {{ $facilityIcons[$facility] }}
                            </span>
                            @endif
                        @endforeach
                    </div>

                    <div class="pt-3 border-t border-slate-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600">Jam Buka</p>
                                <p class="font-medium text-slate-900">{{ $destination->opening_hours ?? '08:00 - 18:00' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600">Harga Tiket</p>
                                <p class="font-medium text-slate-900">
                                    @if($destination->ticket_price > 0)
                                        Rp {{ number_format($destination->ticket_price, 0, ',', '.') }}
                                    @else
                                        Gratis
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Rating & Actions --}}
                <div class="lg:col-span-1 flex flex-col justify-between">
                    <div class="text-center mb-4">
                        <div class="text-4xl font-bold text-slate-900">{{ $destination->rating ?? '4.5' }}</div>
                        <div class="flex gap-1 justify-center mt-2">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= floor($destination->rating ?? 4.5) ? 'text-amber-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            @endfor
                        </div>
                        <p class="text-xs text-slate-500 mt-1">({{ $destination->review_count ?? 128 }} ulasan)</p>
                    </div>

                    <div class="space-y-2">
                        <p class="text-center">
                            @if($index == 0)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                ✓ Sangat Cocok untuk Anda
                            </span>
                            @elseif($index == 1)
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                Cocok untuk Anda
                            </span>
                            @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700">
                                Mungkin Anda Suka
                            </span>
                            @endif
                        </p>

                        <a href="{{ route('user.destinations.show', $destination->id) }}" class="block w-full px-4 py-2.5 rounded-lg bg-slate-950 text-white font-medium hover:bg-slate-800 transition-colors text-center">
                            Lihat Detail
                        </a>
                        <button class="w-full px-4 py-2.5 rounded-lg border border-slate-200 bg-white text-slate-700 font-medium hover:bg-slate-50 transition-colors">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="rounded-[2rem] border border-slate-200 bg-white p-12 shadow-sm text-center">
            <svg class="w-16 h-16 text-slate-400 mx-auto mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            <p class="text-slate-500 text-lg font-medium">Tidak ada rekomendasi saat ini</p>
            <p class="text-slate-400 text-sm mt-2">Mulai jelajahi destinasi untuk mendapatkan rekomendasi yang dipersonalisasi</p>
            <a href="{{ route('user.destinations.index') }}" class="inline-block mt-4 px-6 py-2.5 rounded-lg bg-slate-950 text-white font-medium hover:bg-slate-800 transition-colors">
                Jelajahi Destinasi
            </a>
        </div>
        @endforelse
    </div>

    {{-- Similar Interests Section --}}
    <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-2xl font-semibold text-slate-900 mb-6">Destinasi Lainnya yang Mungkin Anda Sukai</h2>
        
        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @for($i = 1; $i <= 4; $i++)
            <div class="group rounded-xl overflow-hidden border border-slate-200 hover:shadow-lg transition-shadow">
                <div class="relative h-40 bg-slate-200">
                    <img src="https://via.placeholder.com/300x200"
                         alt="Destinasi"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-slate-900 text-sm">Destinasi Alternatif {{ $i }}</h3>
                    <div class="flex items-center gap-1 mt-2">
                        <svg class="w-4 h-4 text-amber-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="text-xs font-medium text-slate-900">4.{{ $i }}</span>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>

@endsection
