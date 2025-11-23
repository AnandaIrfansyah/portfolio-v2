@extends('layouts.pages')

@section('title', 'Home')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="row">
                <div class="col-12">
                    <h1 class="hero-title">
                        <span data-lang="hero-greeting">Hi, I'm</span>
                        <span class="hero-name">{{ $user->name }}</span>
                        <span class="hero-wave">👋</span>
                    </h1>
                    <div class="hero-subtitle">
                        <span data-lang="hero-role">{{ $user->job_title }}</span>
                        <span>•</span>
                        <span>{{ $user->location }} 🇮🇩</span>
                    </div>

                    <div class="hero-desc">{!! $user->bio !!}</div>

                    <div class="hero-buttons">
                        <a href="{{ route('about.index') }}" class="btn btn-primary">
                            <i class="bi bi-person"></i>
                            <span data-lang="btn-about">About</span>
                        </a>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline">
                            <i class="bi bi-envelope"></i>
                            <span data-lang="btn-contact">Contact</span>
                        </a>
                        <a href="#" class="btn btn-success">
                            <i class="bi bi-briefcase"></i>
                            <span data-lang="btn-hireable">Hireable</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider"></div>

        <!-- Publications Section -->
        <section class="publications-section">
            <div class="row">
                <div class="col-12">
                    <div class="section-header">
                        <h2 class="section-title">
                            <span data-lang="section-latest">Latest</span>
                            <span data-lang="section-blogs">Blogs</span>
                        </h2>
                        <a href="#" class="view-all-link">
                            <span data-lang="view-all">View All</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Desktop Grid View -->
            <div class="row g-4 d-none d-lg-flex">
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="blog-card" onclick="handleCardClick(event, 'blog1')">
                        <div class="blog-tags">
                            <span class="tag">#threshold-system</span>
                            <span class="tag">#manual-control</span>
                            <span class="tag">#1</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=400&fit=crop"
                            alt="Usage Monitoring" class="blog-image">
                        <h3 class="blog-title" data-lang="blog1-title">How Usage Monitoring Sustains MLBB-Stats and
                            API-PDDIKTI</h3>
                        <p class="blog-excerpt" data-lang="blog1-excerpt">
                            Two open APIs remain online through a robust threshold system and manual code-based
                            controls, ensuring sustainable...
                        </p>
                        <div class="blog-meta">
                            <div class="blog-author">
                                <img src="{{ asset('pages/img/hero.png') }}" alt="Author" class="author-avatar">
                                <span class="author-name">Ananda Irfansyah</span>
                            </div>
                            <span class="blog-date">July 9, 2025</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="blog-card" onclick="handleCardClick(event, 'blog2')">
                        <div class="blog-tags">
                            <span class="tag">#project-management</span>
                            <span class="tag">#productivity</span>
                            <span class="tag">#2</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=800&h=400&fit=crop"
                            alt="Project Priority" class="blog-image">
                        <h3 class="blog-title" data-lang="blog2-title">Project Priority: What It Is and How to
                            Master It</h3>
                        <p class="blog-excerpt" data-lang="blog2-excerpt">
                            Learn how to prioritize projects effectively based on urgency, complexity, and impact to
                            stay focused and meet deadlines.
                        </p>
                        <div class="blog-meta">
                            <div class="blog-author">
                                <img src="{{ asset('pages/img/hero.png') }}" alt="Author" class="author-avatar">
                                <span class="author-name">Ananda Irfansyah</span>
                            </div>
                            <span class="blog-date">July 7, 2025</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="blog-card" onclick="handleCardClick(event, 'blog3')">
                        <div class="blog-tags">
                            <span class="tag">#api-update</span>
                            <span class="tag">#community</span>
                            <span class="tag">#1</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop"
                            alt="API Status" class="blog-image">
                        <h3 class="blog-title" data-lang="blog3-title">Remain Online with Low Usage Threshold</h3>
                        <p class="blog-excerpt" data-lang="blog3-excerpt">
                            The planned shutdown APIs remain accessible, under a memory usage threshold, ensuring
                            continued service for the community.
                        </p>
                        <div class="blog-meta">
                            <div class="blog-author">
                                <img src="{{ asset('pages/img/hero.png') }}" alt="Author" class="author-avatar">
                                <span class="author-name">Ananda Irfansyah</span>
                            </div>
                            <span class="blog-date">June 15, 2025</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Mobile Carousel View -->
            <div class="blog-mobile d-lg-none">
                <div id="blogCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <a href="#" class="blog-card" onclick="handleCardClick(event, 'blog1')">
                                <div class="blog-tags">
                                    <span class="tag">#threshold-system</span>
                                    <span class="tag">#manual-control</span>
                                </div>
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=400&fit=crop"
                                    alt="Usage Monitoring" class="blog-image">
                                <h3 class="blog-title" data-lang="blog1-title">How Usage Monitoring Sustains
                                    MLBB-Stats and API-PDDIKTI</h3>
                                <p class="blog-excerpt" data-lang="blog1-excerpt">
                                    Two open APIs remain online through a robust threshold system and manual
                                    code-based controls, ensuring sustainable...
                                </p>
                                <div class="blog-meta">
                                    <div class="blog-author">
                                        <img src="{{ asset('pages/img/hero.png') }}" alt="Author"
                                            class="author-avatar">
                                        <span class="author-name">Ananda Irfansyah</span>
                                    </div>
                                    <span class="blog-date">July 9, 2025</span>
                                </div>
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="#" class="blog-card" onclick="handleCardClick(event, 'blog2')">
                                <div class="blog-tags">
                                    <span class="tag">#project-management</span>
                                    <span class="tag">#productivity</span>
                                </div>
                                <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=800&h=400&fit=crop"
                                    alt="Project Priority" class="blog-image">
                                <h3 class="blog-title" data-lang="blog2-title">Project Priority: What It Is and How
                                    to Master It</h3>
                                <p class="blog-excerpt" data-lang="blog2-excerpt">
                                    Learn how to prioritize projects effectively based on urgency, complexity, and
                                    impact to stay focused and meet deadlines.
                                </p>
                                <div class="blog-meta">
                                    <div class="blog-author">
                                        <img src="{{ asset('pages/img/hero.png') }}" alt="Author"
                                            class="author-avatar">
                                        <span class="author-name">Ananda Irfansyah</span>
                                    </div>
                                    <span class="blog-date">July 7, 2025</span>
                                </div>
                            </a>
                        </div>
                        <div class="carousel-item">
                            <a href="#" class="blog-card" onclick="handleCardClick(event, 'blog3')">
                                <div class="blog-tags">
                                    <span class="tag">#api-update</span>
                                    <span class="tag">#community</span>
                                </div>
                                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop"
                                    alt="API Status" class="blog-image">
                                <h3 class="blog-title" data-lang="blog3-title">Remain Online with Low Usage
                                    Threshold</h3>
                                <p class="blog-excerpt" data-lang="blog3-excerpt">
                                    The planned shutdown APIs remain accessible, under a memory usage threshold,
                                    ensuring continued service for the community.
                                </p>
                                <div class="blog-meta">
                                    <div class="blog-author">
                                        <img src="{{ asset('pages/img/hero.png') }}" alt="Author"
                                            class="author-avatar">
                                        <span class="author-name">Ananda Irfansyah</span>
                                    </div>
                                    <span class="blog-date">June 15, 2025</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#blogCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#blogCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#blogCarousel" data-bs-slide-to="2"></button>
                    </div>
                </div>
            </div>
        </section>

        <div class="divider"></div>

        {{-- <section class="tools-section">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">
                        <span data-lang="section-tools">Tools</span>
                        <span data-lang="section-used">I've Used</span>
                    </h2>
                </div>
            </div>
            <div class="tools-wrapper">
                <div class="tools-row">
                    <span class="tool-badge"><i class="bi bi-telegram" style="color: #0088cc;"></i> Telegram</span>
                    <span class="tool-badge"><i class="bi bi-filetype-js" style="color: #3178c6;"></i>
                        TypeScript</span>
                    <span class="tool-badge"><i class="bi bi-code-slash" style="color: #f7df1e;"></i>
                        JavaScript</span>
                    <span class="tool-badge"><i class="bi bi-diagram-3" style="color: #e535ab;"></i> GraphQL</span>
                    <span class="tool-badge"><i class="bi bi-braces" style="color: #f89939;"></i>
                        Scikit-learn</span>
                    <span class="tool-badge"><i class="bi bi-cloud-arrow-up" style="color: #4584b6;"></i>
                        boto3</span>
                    <span class="tool-badge"><i class="bi bi-telegram" style="color: #0088cc;"></i> Telegram</span>
                    <span class="tool-badge"><i class="bi bi-filetype-js" style="color: #3178c6;"></i>
                        TypeScript</span>
                    <span class="tool-badge"><i class="bi bi-code-slash" style="color: #f7df1e;"></i>
                        JavaScript</span>
                    <span class="tool-badge"><i class="bi bi-diagram-3" style="color: #e535ab;"></i> GraphQL</span>
                    <span class="tool-badge"><i class="bi bi-braces" style="color: #f89939;"></i>
                        Scikit-learn</span>
                    <span class="tool-badge"><i class="bi bi-cloud-arrow-up" style="color: #4584b6;"></i>
                        boto3</span>
                </div>
                <div class="tools-row">
                    <span class="tool-badge"><i class="bi bi-bootstrap" style="color: #7952b3;"></i>
                        Bootstrap</span>
                    <span class="tool-badge"><i class="bi bi-database" style="color: #336791;"></i>
                        PostgreSQL</span>
                    <span class="tool-badge"><i class="bi bi-lightning-charge" style="color: #61dafb;"></i>
                        React</span>
                    <span class="tool-badge"><i class="bi bi-filetype-py" style="color: #3776ab;"></i> Python</span>
                    <span class="tool-badge"><i class="bi bi-fire" style="color: #ff6f00;"></i> TensorFlow</span>
                    <span class="tool-badge"><i class="bi bi-git" style="color: #f05032;"></i> Git</span>
                    <span class="tool-badge"><i class="bi bi-bootstrap" style="color: #7952b3;"></i>
                        Bootstrap</span>
                    <span class="tool-badge"><i class="bi bi-database" style="color: #336791;"></i>
                        PostgreSQL</span>
                    <span class="tool-badge"><i class="bi bi-lightning-charge" style="color: #61dafb;"></i>
                        React</span>
                    <span class="tool-badge"><i class="bi bi-filetype-py" style="color: #3776ab;"></i> Python</span>
                    <span class="tool-badge"><i class="bi bi-fire" style="color: #ff6f00;"></i> TensorFlow</span>
                    <span class="tool-badge"><i class="bi bi-git" style="color: #f05032;"></i> Git</span>
                </div>
            </div>
        </section> --}}

        <!-- Tools Section -->
        <section class="tools-section">
            <div class="row">
                <div class="col-12">
                    <h2 class="section-title">
                        <span data-lang="section-tools">Tools</span>
                        <span data-lang="section-used">I've Used</span>
                    </h2>
                </div>
            </div>

            <div class="tools-wrapper">
                <div class="tools-row">
                    @foreach ($techStacks as $tool)
                        <span class="tool-badge">
                            <i class="{{ $tool->icon_class }}"></i>
                            {{ $tool->name }}
                        </span>
                    @endforeach
                </div>
                <div class="tools-row">
                    @foreach ($techStacks as $tool)
                        <span class="tool-badge">
                            <i class="{{ $tool->icon_class }}"></i>
                            {{ $tool->name }}
                        </span>
                    @endforeach
                </div>
            </div>
        </section>


        <div class="divider"></div>

        <!-- Support Section -->
        <section class="support-section">
            <div class="row">
                <div class="col-12">
                    <div class="support-card">
                        <div class="support-content">
                            <h3 class="support-title" data-lang="support-title">Support My Work</h3>
                            <p class="support-desc" data-lang="support-desc">
                                Help me continue creating open source projects and sharing knowledge with the
                                community!
                            </p>
                            <a href="{{ $user->support_url }}" target="_blank" class="btn btn-support">
                                <i class="bi bi-heart-fill"></i>
                                <span data-lang="btn-support">Support</span>
                            </a>
                        </div>
                    </div>
                </div>
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
                'hero-greeting': "Hi, I'm",
                'hero-role': 'Web Developer',
                'hero-desc': "I explore through code, share with empathy, and reflect on every challenge. My work weaves machine learning, web creation, and open source. I thrive on collaborating with teams to develop AI and web solutions that blend function with clarity.",
                'btn-about': 'About',
                'btn-contact': 'Contact',
                'btn-hireable': 'Hireable',
                'section-latest': 'Latest',
                'section-blogs': 'Blogs',
                'view-all': 'View All',
                'blog1-title': 'How Usage Monitoring Sustains MLBB-Stats and API-PDDIKTI',
                'blog1-excerpt': 'Two open APIs remain online through a robust threshold system and manual code-based controls, ensuring sustainable...',
                'blog2-title': 'Project Priority: What It Is and How to Master It',
                'blog2-excerpt': 'Learn how to prioritize projects effectively based on urgency, complexity, and impact to stay focused and meet deadlines.',
                'blog3-title': 'Remain Online with Low Usage Threshold',
                'blog3-excerpt': 'The planned shutdown APIs remain accessible, under a memory usage threshold, ensuring continued service for the community.',
                'section-tools': 'Tools',
                'section-used': "I've Used",
                'support-title': 'Support My Work',
                'support-desc': 'Help me continue creating open source projects and sharing knowledge with the community!',
                'btn-support': 'Support'
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
                'hero-greeting': 'Hai, Saya',
                'hero-role': 'Developer Web',
                'hero-desc': 'Saya mengeksplorasi melalui kode, berbagi dengan empati, dan merefleksikan setiap tantangan. Pekerjaan saya menggabungkan pembelajaran mesin, pembuatan web, dan sumber terbuka. Saya senang berkolaborasi dengan tim untuk mengembangkan solusi AI dan web yang memadukan fungsi dengan kejelasan.',
                'btn-about': 'Tentang',
                'btn-contact': 'Kontak',
                'btn-hireable': 'Bisa Dipekerjakan',
                'section-latest': 'Terbaru',
                'section-blogs': 'Blog',
                'view-all': 'Lihat Semua',
                'blog1-title': 'Cara Pemantauan Penggunaan Mempertahankan MLBB-Stats dan API-PDDIKTI',
                'blog1-excerpt': 'Dua API terbuka tetap online melalui sistem ambang batas yang kuat dan kontrol berbasis kode manual, memastikan keberlanjutan...',
                'blog2-title': 'Prioritas Proyek: Apa Itu dan Cara Menguasainya',
                'blog2-excerpt': 'Pelajari cara memprioritaskan proyek secara efektif berdasarkan urgensi, kompleksitas, dan dampak untuk tetap fokus dan memenuhi tenggat waktu.',
                'blog3-title': 'Tetap Online dengan Ambang Batas Penggunaan Rendah',
                'blog3-excerpt': 'API yang direncanakan untuk ditutup tetap dapat diakses, di bawah ambang batas penggunaan memori, memastikan layanan berkelanjutan untuk komunitas.',
                'section-tools': 'Alat',
                'section-used': 'Yang Saya Gunakan',
                'support-title': 'Dukung Karya Saya',
                'support-desc': 'Bantu saya terus membuat proyek sumber terbuka dan berbagi pengetahuan dengan komunitas!',
                'btn-support': 'Dukung'
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
            const langElement = document.getElementById('currentLang');
            if (langElement) {
                langElement.textContent = currentLanguage.toUpperCase();
            }
        }

        // Initialize language
        updateLanguage();
    </script>
@endpush
