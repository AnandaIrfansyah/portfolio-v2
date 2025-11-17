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
        <a href="home.html" class="nav-item active" onclick="closeMobileMenu(event)">
            <i class="bi bi-house-door-fill"></i>
            <span data-lang="nav-home">Home</span>
            <i class="bi bi-arrow-right nav-arrow"></i>
        </a>
        <a href="projects.html" class="nav-item" onclick="closeMobileMenu(event)">
            <i class="bi bi-kanban"></i>
            <span data-lang="nav-projects">Projects</span>
        </a>
        <a href="blog.html" class="nav-item" onclick="closeMobileMenu(event)">
            <i class="bi bi-rss"></i>
            <span data-lang="nav-blog">Blog</span>
        </a>
        <a href="about.html" class="nav-item" onclick="closeMobileMenu(event)">
            <i class="bi bi-person"></i>
            <span data-lang="nav-about">About</span>
        </a>
        <a href="contact.html" class="nav-item" onclick="closeMobileMenu(event)">
            <i class="bi bi-envelope"></i>
            <span data-lang="nav-contact">Contact</span>
        </a>
        <a href="guestbook.html" class="nav-item" onclick="closeMobileMenu(event)">
            <i class="bi bi-chat-left-quote"></i>
            <span data-lang="nav-guestbook">Guestbook</span>
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
