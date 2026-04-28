<footer class="site-footer">
    <div class="container footer-shell">
        <div class="footer-top">
            <div class="footer-brand">
                <a class="footer-logo" href="{{ route('destinations') }}">Jelajah Bali</a>
                <p class="footer-tagline">
                    Platform rekomendasi wisata yang membantu Anda merencanakan perjalanan Bali dengan pilihan destinasi yang lebih relevan.
                </p>
            </div>

            <div class="footer-columns">
                <div class="footer-column" aria-label="Legal links">
                    <h4>Legal</h4>
                    <a class="footer-link" href="{{ route('privacy') }}">Privacy Policy</a>
                    <a class="footer-link" href="{{ route('terms') }}">Terms</a>
                </div>

                <div class="footer-column" aria-label="Support links">
                    <h4>Support</h4>
                    <a class="footer-link" href="{{ route('contact') }}">Contact</a>
                    <a
                        class="footer-link external"
                        href="https://bali.com/"
                        target="_blank"
                        rel="noopener noreferrer"
                    >
                        Bali Guide
                        <span aria-hidden="true">↗</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-copy">© {{ date('Y') }} Kelompok 3. All rights reserved.</p>
            <p class="footer-meta">Made for smarter Bali trip planning.</p>
        </div>
    </div>
</footer>