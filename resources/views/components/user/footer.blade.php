@php
    $routePrefix = auth()->check() ? 'user.' : '';
@endphp

<footer class="bg-slate-900 text-slate-300 mt-20">
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            {{-- About --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-brand-600 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        </svg>
                    </div>
                    <span class="font-display font-semibold text-white text-lg">Jelajah Bali</span>
                </div>
                <p class="text-sm leading-relaxed">Platform rekomendasi wisata yang membantu Anda merencanakan perjalanan Bali dengan pilihan destinasi yang lebih relevan.</p>
            </div>

            {{-- Links --}}
            <div>
                <h3 class="font-semibold text-white mb-4">Menu</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('privacy') }}" class="hover:text-brand-400 transition">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('terms') }}" class="hover:text-brand-400 transition">Ketentuan</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-brand-400 transition">Kontak</a></li>
                    <li><a href="https://bali.com/" target="_blank" class="hover:text-brand-400 transition">Panduan Bali ↗</a></li>
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="font-semibold text-white mb-4">Kontak</h3>
                <p class="text-sm mb-2">📧 info@jelajahbali.com</p>
                <p class="text-sm mb-4">📱 +62 (123) 456-789</p>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-8">
            <p class="text-center text-sm">© {{ date('Y') }} Kelompok 2. Semua hak dilindungi.</p>
            <p class="text-center text-xs text-slate-400 mt-2">Dibuat untuk perencanaan perjalanan Bali yang lebih cerdas.</p>
        </div>

    </div>
</footer>