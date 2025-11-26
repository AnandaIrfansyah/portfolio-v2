@extends('layouts.pages')

@section('title', 'Blog')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- Hero Section -->
        <section class="hero-section">
            <div class="row">
                <div class="col-12">
                    <h1 class="hero-title">
                        Latest <span>Blogs</span>
                    </h1>
                    <p class="hero-subtitle">
                        Not all traces are written in code. Some live here in thoughts, questions, and quiet
                        observations.
                    </p>
                </div>
            </div>
        </section>

        <!-- Blog Search Section -->
        <section class="blog-search-section">
            <div class="row">
                <div class="col-12">
                    <div class="blog-search-wrapper">
                        <div class="blog-search-input-wrapper">
                            <i class="bi bi-search blog-search-icon"></i>
                            <input type="text" class="blog-search-input" placeholder="Search blogs..."
                                id="blogSearchInput">
                        </div>
                        <button class="blog-search-btn">Search</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blogs Grid -->
        <section class="blogs-grid-section">
            <div class="row g-4">
                <!-- Blog 1 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="blog-card">
                        <div class="blog-tags">
                            <span class="tag">#threshold-system</span>
                            <span class="tag">#manual-control</span>
                            <span class="tag">#1</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=800&h=400&fit=crop"
                            alt="Usage Monitoring" class="blog-image">
                        <h3 class="blog-title">How Usage Monitoring Sustains MLBB-Stats and API-PDDIKTI</h3>
                        <p class="blog-excerpt">
                            Two open APIs remain online through a robust threshold system and manual code-based
                            controls, ensuring sustainable performance and reliability.
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

                <!-- Blog 2 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="blog-card">
                        <div class="blog-tags">
                            <span class="tag">#project-management</span>
                            <span class="tag">#productivity</span>
                            <span class="tag">#2</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=800&h=400&fit=crop"
                            alt="Project Priority" class="blog-image">
                        <h3 class="blog-title">Project Priority: What It Is and How to Master It</h3>
                        <p class="blog-excerpt">
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

                <!-- Blog 3 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="blog-card">
                        <div class="blog-tags">
                            <span class="tag">#api-update</span>
                            <span class="tag">#community</span>
                            <span class="tag">#1</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop"
                            alt="API Status" class="blog-image">
                        <h3 class="blog-title">Remain Online with Low Usage Threshold</h3>
                        <p class="blog-excerpt">
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

                <!-- Blog 4 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="blog-card">
                        <div class="blog-tags">
                            <span class="tag">#astronomy</span>
                            <span class="tag">#exoplanets</span>
                            <span class="tag">#space-exploration</span>
                            <span class="tag">#1</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1462331940025-496dfbfc7564?w=800&h=400&fit=crop"
                            alt="Exoplanet" class="blog-image">
                        <h3 class="blog-title">What Is an Exoplanet? – A Tale from Beyond Our Sky</h3>
                        <p class="blog-excerpt">
                            Venture into distant star systems as we uncover what exoplanets are and how they fuel
                            our cosmic curiosity.
                        </p>
                        <div class="blog-meta">
                            <div class="blog-author">
                                <img src="{{ asset('pages/img/hero.png') }}" alt="Author" class="author-avatar">
                                <span class="author-name">Ananda Irfansyah</span>
                            </div>
                            <span class="blog-date">June 30, 2025</span>
                        </div>
                    </a>
                </div>

                <!-- Blog 5 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="blog-card">
                        <div class="blog-tags">
                            <span class="tag">#coding-camp</span>
                            <span class="tag">#DI-coding</span>
                            <span class="tag">#dbs-foundation</span>
                            <span class="tag">#3</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=800&h=400&fit=crop"
                            alt="Coding Camp" class="blog-image">
                        <h3 class="blog-title">Coding Camp – Building Future-Ready Talent with DBS Foundation</h3>
                        <p class="blog-excerpt">
                            Explore how this nationwide initiative equips students across Indonesia with high-demand
                            tech skills, professional
                            readiness, and meaningful support.
                        </p>
                        <div class="blog-meta">
                            <div class="blog-author">
                                <img src="{{ asset('pages/img/hero.png') }}" alt="Author" class="author-avatar">
                                <span class="author-name">Ananda Irfansyah</span>
                            </div>
                            <span class="blog-date">June 23, 2025</span>
                        </div>
                    </a>
                </div>

                <!-- Blog 6 -->
                <div class="col-lg-4 col-md-6 col-12">
                    <a href="#" class="blog-card">
                        <div class="blog-tags">
                            <span class="tag">#asian-countries</span>
                            <span class="tag">#governance</span>
                            <span class="tag">#religious-tolerance</span>
                            <span class="tag">#8</span>
                        </div>
                        <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=800&h=400&fit=crop"
                            alt="Asian Countries" class="blog-image">
                        <h3 class="blog-title">Top 6 Asian Countries with Better Governance and Religious Harmony
                        </h3>
                        <p class="blog-excerpt">
                            Exploring Asian nations with strong governance, low corruption, and religious tolerance
                            for Indonesians
                            seeking alternatives.
                        </p>
                        <div class="blog-meta">
                            <div class="blog-author">
                                <img src="{{ asset('pages/img/hero.png') }}" alt="Author" class="author-avatar">
                                <span class="author-name">Ananda Irfansyah</span>
                            </div>
                            <span class="blog-date">May 10, 2025</span>
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
                <a href="#" class="page-item">4</a>
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
@endpush
