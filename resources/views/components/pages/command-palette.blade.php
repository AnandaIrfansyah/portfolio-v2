<!-- Command Palette Modal -->
<div class="command-palette" id="commandPalette" onclick="closeCommandPalette(event)">
    <div class="command-palette-content" onclick="event.stopPropagation()">
        <div class="command-search-box">
            <i class="bi bi-search command-search-icon"></i>
            <input type="text" class="command-search-input" placeholder="Search pages, socials, or links..."
                id="commandSearchInput" autofocus>
        </div>

        <div class="command-results" id="commandResults">

            <!-- PAGES -->
            <div class="command-section">
                <div class="command-section-title">PAGES</div>

                <a href="{{ route('home.index') }}"
                    class="command-item {{ request()->routeIs('home.index') ? 'current' : '' }}">
                    <div class="command-item-left">
                        <i class="bi bi-house-door-fill command-item-icon"></i>
                        <span class="command-item-text">Home</span>
                    </div>
                    <span class="command-item-badge">
                        {{ request()->routeIs('home.index') ? 'You are here' : 'Pages' }}
                    </span>
                </a>

                <a href="{{ route('project.index') }}"
                    class="command-item {{ request()->routeIs('project.index') ? 'current' : '' }}">
                    <div class="command-item-left">
                        <i class="bi bi-kanban command-item-icon"></i>
                        <span class="command-item-text">Projects</span>
                    </div>
                    <span class="command-item-badge">
                        {{ request()->routeIs('project.index') ? 'You are here' : 'Pages' }}
                    </span>
                </a>

                <a href="{{ route('publication.index') }}"
                    class="command-item {{ request()->routeIs('publication.index') ? 'current' : '' }}">
                    <div class="command-item-left">
                        <i class="bi bi-rss command-item-icon"></i>
                        <span class="command-item-text">Publications</span>
                    </div>
                    <span class="command-item-badge">
                        {{ request()->routeIs('publication.index') ? 'You are here' : 'Pages' }}
                    </span>
                </a>

                <a href="{{ route('about.index') }}"
                    class="command-item {{ request()->routeIs('about.index') ? 'current' : '' }}">
                    <div class="command-item-left">
                        <i class="bi bi-person command-item-icon"></i>
                        <span class="command-item-text">About</span>
                    </div>
                    <span class="command-item-badge">
                        {{ request()->routeIs('about.index') ? 'You are here' : 'Pages' }}
                    </span>
                </a>

                <a href="{{ route('contact.index') }}"
                    class="command-item {{ request()->routeIs('contact.index') ? 'current' : '' }}">
                    <div class="command-item-left">
                        <i class="bi bi-envelope command-item-icon"></i>
                        <span class="command-item-text">Contact</span>
                    </div>
                    <span class="command-item-badge">
                        {{ request()->routeIs('contact.index') ? 'You are here' : 'Pages' }}
                    </span>
                </a>

                <a href="{{ route('guestbook.index') }}"
                    class="command-item {{ request()->routeIs('guestbook.index') ? 'current' : '' }}">
                    <div class="command-item-left">
                        <i class="bi bi-chat-left-quote command-item-icon"></i>
                        <span class="command-item-text">Guestbook</span>
                    </div>
                    <span class="command-item-badge">
                        {{ request()->routeIs('guestbook.index') ? 'You are here' : 'Pages' }}
                    </span>
                </a>
            </div>

            <!-- SOCIALS -->
            <div class="command-section">
                <div class="command-section-title">SOCIALS</div>

                <a href="mailto:ananda@example.com" class="command-item">
                    <div class="command-item-left">
                        <i class="bi bi-envelope-fill command-item-icon"></i>
                        <span class="command-item-text">Email</span>
                    </div>
                    <span class="command-item-badge">Link</span>
                </a>

                <a href="https://github.com/anandairfansyah" target="_blank" class="command-item">
                    <div class="command-item-left">
                        <i class="bi bi-github command-item-icon"></i>
                        <span class="command-item-text">GitHub</span>
                    </div>
                    <span class="command-item-badge">Link</span>
                </a>

                <a href="https://linkedin.com/in/anandairfansyah" target="_blank" class="command-item">
                    <div class="command-item-left">
                        <i class="bi bi-linkedin command-item-icon"></i>
                        <span class="command-item-text">LinkedIn</span>
                    </div>
                    <span class="command-item-badge">Link</span>
                </a>

                <a href="https://instagram.com/anndairfnsyh_" target="_blank" class="command-item">
                    <div class="command-item-left">
                        <i class="bi bi-instagram command-item-icon"></i>
                        <span class="command-item-text">Instagram</span>
                    </div>
                    <span class="command-item-badge">Link</span>
                </a>

                <a href="https://twitter.com/anandairfansyah" target="_blank" class="command-item">
                    <div class="command-item-left">
                        <i class="bi bi-twitter command-item-icon"></i>
                        <span class="command-item-text">X (Twitter)</span>
                    </div>
                    <span class="command-item-badge">Link</span>
                </a>
            </div>

            <!-- EXTERNAL LINKS -->
            <div class="command-section">
                <div class="command-section-title">EXTERNAL LINKS</div>

                <a href="#" class="command-item">
                    <div class="command-item-left">
                        <i class="bi bi-heart-fill command-item-icon"></i>
                        <span class="command-item-text">Support</span>
                    </div>
                    <span class="command-item-badge">Link</span>
                </a>

                <a href="#" class="command-item">
                    <div class="command-item-left">
                        <i class="bi bi-file-pdf command-item-icon"></i>
                        <span class="command-item-text">CV PDF</span>
                    </div>
                    <span class="command-item-badge">Link</span>
                </a>

                <a href="#" class="command-item">
                    <div class="command-item-left">
                        <i class="bi bi-file-word command-item-icon"></i>
                        <span class="command-item-text">CV Word</span>
                    </div>
                    <span class="command-item-badge">Link</span>
                </a>

                <a href="#" class="command-item">
                    <div class="command-item-left">
                        <i class="bi bi-files command-item-icon"></i>
                        <span class="command-item-text">CV Copy</span>
                    </div>
                    <span class="command-item-badge">Link</span>
                </a>
            </div>

            <!-- No Results Message -->
            <div class="command-no-results" id="commandNoResults" style="display: none;">
                <i class="bi bi-search command-no-results-icon"></i>
                <div class="command-no-results-title">No results found</div>
                <div class="command-no-results-desc">Try searching with different keywords</div>
            </div>
        </div>
    </div>
</div>
