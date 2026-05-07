<header class="site-header">
    <div class="container header-shell">
        <a class="brand-mark" href="{{ route('user.destinations') }}">Jelajah Bali</a>

        <button
            class="menu-toggle"
            id="menuToggle"
            type="button"
            aria-controls="siteNav"
            aria-expanded="false"
            aria-label="Toggle navigation menu"
        >
            <span></span>
            <span></span>
            <span></span>
        </button>

        <nav class="site-nav" id="siteNav" aria-label="Primary navigation">
            <a class="nav-link {{ request()->routeIs('user.destinations') ? 'is-active' : '' }}" href="{{ route('user.destinations') }}">
                Destinations
            </a>
            {{-- <a class="nav-link {{ request()->routeIs('preferences') ? 'is-active' : '' }}" href="{{ route('preferences') }}">
                Preferensi
            </a> --}}
            <a class="nav-link {{ request()->routeIs('about') ? 'is-active' : '' }}" href="{{ route('about') }}">
                About
            </a>
        </nav>

        <a class="profile-avatar" href="{{ route('about') }}" aria-label="Profil Jelajah Bali">
            JB
        </a>
    </div>
</header>

<script>
    (() => {
        const menuToggle = document.getElementById('menuToggle');
        const siteNav = document.getElementById('siteNav');

        if (!menuToggle || !siteNav) {
            return;
        }

        const closeMenu = () => {
            siteNav.classList.remove('open');
            menuToggle.setAttribute('aria-expanded', 'false');
        };

        menuToggle.addEventListener('click', () => {
            const isOpen = siteNav.classList.toggle('open');
            menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });

        siteNav.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', closeMenu);
        });

        window.addEventListener('resize', () => {
            if (window.innerWidth > 860) {
                closeMenu();
            }
        });
    })();
</script>
