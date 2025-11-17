<!-- Mobile Top Navbar -->
<nav class="mobile-top-navbar">
    <div class="mobile-navbar-content">
        <div class="mobile-profile">
            <img src="{{ asset('pages/img/hero.png') }}" alt="Profile" class="mobile-profile-img">
            <div class="mobile-profile-info">
                <div class="mobile-profile-name">
                    Ananda Irfansyah
                    <i class="bi bi-patch-check-fill"></i>
                </div>
                <div class="mobile-profile-username">@anndairfnsyh_</div>
            </div>
        </div>
        <div class="mobile-navbar-actions">
            <button class="mobile-nav-btn" onclick="toggleMobileMenu()" id="mobileMenuBtn">
                <i class="bi bi-list"></i>
            </button>
            <button class="mobile-nav-btn" onclick="toggleLanguage()">
                <i class="bi bi-globe"></i>
            </button>
        </div>
    </div>
</nav>

<!-- Mobile Overlay -->
<div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>
