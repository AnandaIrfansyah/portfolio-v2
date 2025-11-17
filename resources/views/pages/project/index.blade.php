@extends('layouts.pages')

@section('title', 'Projects')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- Hero Section -->
        <section class="hero-section projects-hero">
            <div class="row">
                <div class="col-12">
                    <h1 class="hero-title">
                        <span data-lang="hero-greeting">My</span>
                        <span class="hero-name">Projects</span>
                    </h1>
                    <p class="hero-subtitle" data-lang="projects-subtitle">
                        Where effort met execution, these projects are artifacts of discipline and continuous
                        learning.
                    </p>
                </div>
            </div>
        </section>

        <!-- Project Search Section -->
        <section class="project-search-section">
            <div class="row">
                <div class="col-12">
                    <div class="project-search-wrapper">
                        <div class="project-search-input-wrapper">
                            <i class="bi bi-search project-search-icon"></i>
                            <input type="text" class="project-search-input" placeholder="Search projects..."
                                id="projectSearchInput" data-lang-placeholder="search-projects">
                        </div>
                        <button class="project-search-btn" data-lang="search-btn">Search</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects Grid -->
        <section class="projects-grid-section">
            <div class="row g-4">
                <!-- Project 1 - Featured -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="project-card">
                        <span class="project-badge">
                            <i class="bi bi-star-fill"></i>
                            FEATURED
                        </span>
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop"
                            alt="anandairfansyah.my.id" class="project-image">
                        <div class="project-content">
                            <h3 class="project-title">anandairfansyah.my.id</h3>
                            <p class="project-desc">
                                Advanced developer portfolio platform with individual file data management,
                                real-time API integrations, and enterprise-grade security.
                            </p>
                            <div class="project-tech">
                                <span class="tech-icon" style="color: #61dafb;" title="React">
                                    <i class="bi bi-code-slash"></i>
                                </span>
                                <span class="tech-icon" style="color: #3178c6;" title="TypeScript">
                                    <i class="bi bi-filetype-js"></i>
                                </span>
                                <span class="tech-icon" style="color: #ffffff;" title="Next.js">
                                    <i class="bi bi-box"></i>
                                </span>
                                <span class="tech-icon" style="color: #38bdf8;" title="Tailwind">
                                    <i class="bi bi-palette"></i>
                                </span>
                                <span class="tech-icon" style="color: #ff9900;" title="Cloudflare">
                                    <i class="bi bi-cloud-fog"></i>
                                </span>
                                <span class="tech-icon" style="color: #f89939;" title="Vercel">
                                    <i class="bi bi-triangle"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Project 2 - Featured -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="project-card">
                        <span class="project-badge">
                            <i class="bi bi-star-fill"></i>
                            FEATURED
                        </span>
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=400&fit=crop"
                            alt="MLBB API Stats Hub" class="project-image">
                        <div class="project-content">
                            <h3 class="project-title">MLBB API Stats Hub</h3>
                            <p class="project-desc">
                                REST API and website loaded with Mobile Legends game data.
                            </p>
                            <div class="project-tech">
                                <span class="tech-icon" style="color: #61dafb;" title="React">
                                    <i class="bi bi-code-slash"></i>
                                </span>
                                <span class="tech-icon" style="color: #3178c6;" title="TypeScript">
                                    <i class="bi bi-filetype-js"></i>
                                </span>
                                <span class="tech-icon" style="color: #4584b6;" title="Python">
                                    <i class="bi bi-code"></i>
                                </span>
                                <span class="tech-icon" style="color: #10b981;" title="FastAPI">
                                    <i class="bi bi-lightning"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Project 3 - Featured -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="project-card">
                        <span class="project-badge">
                            <i class="bi bi-star-fill"></i>
                            FEATURED
                        </span>
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&h=400&fit=crop"
                            alt="Neural Network" class="project-image">
                        <div class="project-content">
                            <h3 class="project-title">Neural Network from Scratch</h3>
                            <p class="project-desc">
                                A professional implementation of a neural network using only NumPy for MNIST digit
                                classification.
                            </p>
                            <div class="project-tech">
                                <span class="tech-icon" style="color: #4584b6;" title="Python">
                                    <i class="bi bi-code"></i>
                                </span>
                                <span class="tech-icon" style="color: #f89939;" title="NumPy">
                                    <i class="bi bi-calculator"></i>
                                </span>
                                <span class="tech-icon" style="color: #ffffff;" title="Jupyter">
                                    <i class="bi bi-journal-code"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Project 4 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="project-card">
                        <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=800&h=400&fit=crop"
                            alt="Instagram Analyzer" class="project-image">
                        <div class="project-content">
                            <h3 class="project-title">Insta Follow Analyzer</h3>
                            <p class="project-desc">
                                Python tool to dissect Instagram follower dynamics.
                            </p>
                            <div class="project-tech">
                                <span class="tech-icon" style="color: #4584b6;" title="Python">
                                    <i class="bi bi-code"></i>
                                </span>
                                <span class="tech-icon" style="color: #38bdf8;" title="API">
                                    <i class="bi bi-cloud-arrow-up"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Project 5 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="project-card">
                        <img src="https://images.unsplash.com/photo-1563986768609-322da13575f3?w=800&h=400&fit=crop"
                            alt="Django WebSocket" class="project-image">
                        <div class="project-content">
                            <h3 class="project-title">Django Real-Time Sync with WebSocket</h3>
                            <p class="project-desc">
                                A Django project enabling real-time data synchronization across multiple browser
                                tabs using WebSocket and Redis.
                            </p>
                            <div class="project-tech">
                                <span class="tech-icon" style="color: #092e20;" title="Django">
                                    <i class="bi bi-code-square"></i>
                                </span>
                                <span class="tech-icon" style="color: #4584b6;" title="Python">
                                    <i class="bi bi-code"></i>
                                </span>
                                <span class="tech-icon" style="color: #dc382d;" title="Redis">
                                    <i class="bi bi-hdd-stack"></i>
                                </span>
                                <span class="tech-icon" style="color: #38bdf8;" title="WebSocket">
                                    <i class="bi bi-arrow-left-right"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Project 6 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="project-card">
                        <img src="https://images.unsplash.com/photo-1518432031352-d6fc5c10da5a?w=800&h=400&fit=crop"
                            alt="Shopping Bot" class="project-image">
                        <div class="project-content">
                            <h3 class="project-title">n8n Shopping Data Bot</h3>
                            <p class="project-desc">
                                A personal finance tracking bot powered by n8n and AI, with automated input via
                                Telegram and receipt OCR, then stored in Google Sheets.
                            </p>
                            <div class="project-tech">
                                <span class="tech-icon" style="color: #ff6d5a;" title="n8n">
                                    <i class="bi bi-diagram-3"></i>
                                </span>
                                <span class="tech-icon" style="color: #0088cc;" title="Telegram">
                                    <i class="bi bi-telegram"></i>
                                </span>
                                <span class="tech-icon" style="color: #34a853;" title="Google Sheets">
                                    <i class="bi bi-table"></i>
                                </span>
                                <span class="tech-icon" style="color: #6d28d9;" title="AI">
                                    <i class="bi bi-cpu"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Pagination -->
        <section class="pagination-section">
            <div class="pagination">
                <a href="#" class="page-item disabled">
                    <i class="bi bi-chevron-left"></i>
                </a>
                <a href="#" class="page-item active">1</a>
                <a href="#" class="page-item">2</a>
                <a href="#" class="page-item">3</a>
                <span class="page-dots">...</span>
                <a href="#" class="page-item">10</a>
                <a href="#" class="page-item">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </section>
    </div>
@endsection

@push('modal')
@endpush

@push('scripts')
    <script>
        // Language translations (TEMPORARY - will be replaced by Laravel localization)
        const translations = {
            en: {
                'status': 'Open to Work',
                'search': 'Search',
                'nav-home': 'Home',
                'nav-projects': 'Projects',
                'nav-blog': 'Blog',
                'nav-about': 'About',
                'nav-contact': 'Contact',
                'nav-guestbook': 'Guestbook',
                'projects-title': 'Projects',
                'projects-subtitle': 'Where effort met execution, these projects are artifacts of discipline and continuous learning.',
                'search-projects': 'Search projects...',
                'search-btn': 'Search'
            },
            id: {
                'status': 'Terbuka untuk Kerja',
                'search': 'Cari',
                'nav-home': 'Beranda',
                'nav-projects': 'Proyek',
                'nav-blog': 'Blog',
                'nav-about': 'Tentang',
                'nav-contact': 'Kontak',
                'nav-guestbook': 'Buku Tamu',
                'projects-title': 'Proyek',
                'projects-subtitle': 'Di mana usaha bertemu eksekusi, proyek-proyek ini adalah artefak disiplin dan pembelajaran berkelanjutan.',
                'search-projects': 'Cari proyek...',
                'search-btn': 'Cari'
            }
        };

        let currentLanguage = 'en';

        function toggleLanguage() {
            currentLanguage = currentLanguage === 'en' ? 'id' : 'en';
            updateLanguage();
            document.body.style.opacity = '0.8';
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 150);
        }

        function updateLanguage() {
            const elements = document.querySelectorAll('[data-lang]');
            elements.forEach(element => {
                const key = element.getAttribute('data-lang');
                if (translations[currentLanguage][key]) {
                    if (element.tagName === 'INPUT') {
                        element.placeholder = translations[currentLanguage][key];
                    } else {
                        element.textContent = translations[currentLanguage][key];
                    }
                }
            });

            // Update placeholder separately
            const searchInput = document.getElementById('projectSearchInput');
            if (searchInput) {
                const placeholderKey = searchInput.getAttribute('data-lang-placeholder');
                if (placeholderKey && translations[currentLanguage][placeholderKey]) {
                    searchInput.placeholder = translations[currentLanguage][placeholderKey];
                }
            }

            const langElement = document.getElementById('currentLang');
            if (langElement) {
                langElement.textContent = currentLanguage.toUpperCase();
            }
        }

        // Initialize language
        updateLanguage();
    </script>
@endpush
