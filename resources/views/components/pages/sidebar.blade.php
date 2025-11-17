<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <button class="sidebar-close-btn" onclick="toggleMobileMenu()" id="sidebarCloseBtn">
        <i class="bi bi-x-lg"></i>
    </button>

    <div class="sidebar-header">
        <img src="{{ asset('pages/img/hero.png') }}" alt="Profile" class="profile-img">
        <div class="profile-name">
            Ananda Irfansyah
            <i class="bi bi-patch-check-fill verified-badge"></i>
        </div>
        <div class="profile-username">@anndairfnsyh_</div>
        <span class="status-badge">
            <span class="status-dot"></span>
            <span data-lang="status">Open to Work</span>
        </span>
    </div>

    <div class="search-box">
        <i class="bi bi-search search-icon"></i>
        <input type="text" class="search-input" data-lang="search" placeholder="Search"
            onclick="openCommandPalette()" readonly>
        <span class="search-shortcut">⌘K</span>
    </div>

    <nav class="sidebar-nav">

        {{-- HOME --}}
        <a href="{{ route('home.index') }}" class="nav-item {{ request()->routeIs('home.index') ? 'active' : '' }}"
            onclick="closeMobileMenu(event)">
            <i class="bi bi-house-door-fill"></i>
            <span data-lang="nav-home">Home</span>

            @if (request()->routeIs('home.index'))
                <i class="bi bi-arrow-right nav-arrow"></i>
            @endif
        </a>

        {{-- PROJECTS --}}
        <a href="{{ route('project.index') }}"
            class="nav-item {{ request()->routeIs('project.index') ? 'active' : '' }}" onclick="closeMobileMenu(event)">
            <i class="bi bi-kanban"></i>
            <span data-lang="nav-projects">Projects</span>

            @if (request()->routeIs('project.index'))
                <i class="bi bi-arrow-right nav-arrow"></i>
            @endif
        </a>

        {{-- BLOG --}}
        <a href="{{ route('blog.index') }}" class="nav-item {{ request()->routeIs('blog.index') ? 'active' : '' }}"
            onclick="closeMobileMenu(event)">
            <i class="bi bi-rss"></i>
            <span data-lang="nav-blog">Blog</span>

            @if (request()->routeIs('blog.index'))
                <i class="bi bi-arrow-right nav-arrow"></i>
            @endif
        </a>

        {{-- ABOUT --}}
        <a href="{{ route('about.index') }}" class="nav-item {{ request()->routeIs('about.index') ? 'active' : '' }}"
            onclick="closeMobileMenu(event)">
            <i class="bi bi-person"></i>
            <span data-lang="nav-about">About</span>

            @if (request()->routeIs('about.index'))
                <i class="bi bi-arrow-right nav-arrow"></i>
            @endif
        </a>

        {{-- CONTACT --}}
        <a href="{{ route('contact.index') }}"
            class="nav-item {{ request()->routeIs('contact.index') ? 'active' : '' }}"
            onclick="closeMobileMenu(event)">
            <i class="bi bi-envelope"></i>
            <span data-lang="nav-contact">Contact</span>

            @if (request()->routeIs('contact.index'))
                <i class="bi bi-arrow-right nav-arrow"></i>
            @endif
        </a>

        {{-- GUESTBOOK --}}
        <a href="{{ route('guestbook.index') }}"
            class="nav-item {{ request()->routeIs('guestbook.index') ? 'active' : '' }}"
            onclick="closeMobileMenu(event)">
            <i class="bi bi-chat-left-quote"></i>
            <span data-lang="nav-guestbook">Guestbook</span>

            @if (request()->routeIs('guestbook.index'))
                <i class="bi bi-arrow-right nav-arrow"></i>
            @endif
        </a>

    </nav>

    <div class="sidebar-footer">
        <div class="footer-links">
            <a href="#">OpenHire</a>
            <span>•</span>
            <a href="#">Privacy</a>
        </div>
        <div>&copy; 2025 Ananda Irfansyah</div>
    </div>
</aside>
