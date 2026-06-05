<footer id="kontak" class="site-footer">
    <div class="container footer-shell">
        <div class="footer-top">
            <div class="footer-brand">
                <a class="footer-logo" href="{{ route('landingpage') }}">Jelajah Bali</a>
                <p class="footer-tagline">
                    Platform rekomendasi perjalanan terpercaya untuk perencanaan destinasi Bali yang lebih personal dan relevan.
                </p>
            </div>

            <div class="footer-columns">
                <div class="footer-column" aria-label="Menu footer">
                    <h4>Menu</h4>
                    <a class="footer-link" href="{{ route('about') }}">Tentang</a>
                    @auth
                        <a class="footer-link" href="{{ route('user.destinations') }}">Destinasi</a>
                    @else
                        <a class="footer-link" href="{{ route('user.login') }}">Destinasi</a>
                    @endauth
                    <a class="footer-link" href="{{ route('privacy') }}">Kebijakan Privasi</a>
                    <a class="footer-link" href="{{ route('terms') }}">Ketentuan</a>
                </div>

                <div class="footer-column" aria-label="Panduan eksternal">
                    <h4>Panduan</h4>
                    <a
                        class="footer-link external"
                        href="https://bali.com/"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Panduan Bali
                        <span aria-hidden="true">&nearr;</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copy">&copy; {{ date('Y') }} Kelompok 2. Semua hak dilindungi.</p>
            <p class="footer-meta">Dibuat untuk perencanaan perjalanan Bali yang lebih cerdas.</p>
        </div>
    </div>
</footer>
