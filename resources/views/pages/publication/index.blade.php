@extends('layouts.pages')
@section('title', 'Publications')
@push('styles')
    <style>
        /* Publications Page Specific */
        .publications-hero {
            padding: 4rem 0 2rem;
        }

        .publications-hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }

        .publications-hero-title span {
            color: #2563eb;
        }

        .publications-hero-subtitle {
            color: #9ca3af;
            font-size: 1rem;
            margin-bottom: 0;
            max-width: 700px;
        }

        /* Search & Filter Container */
        .search-filter-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            margin-bottom: 3rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #1a1a1a;
        }

        /* Search Section - Compact */
        .blog-search-section {
            margin-bottom: 0;
            flex: 1;
            max-width: 500px;
        }

        .blog-search-wrapper {
            display: flex;
            gap: 0.5rem;
        }

        .blog-search-input-wrapper {
            position: relative;
            flex: 1;
        }

        .blog-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 0.875rem;
        }

        .blog-search-input {
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            background-color: #0f0f0f;
            border: 1px solid #262626;
            border-radius: 0.5rem;
            color: #ffffff;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .blog-search-input:focus {
            outline: none;
            border-color: #2563eb;
            background-color: #1a1a1a;
        }

        .blog-search-input::placeholder {
            color: #6b7280;
        }

        .blog-search-btn {
            background-color: #0f0f0f;
            border: 1px solid #262626;
            color: #e5e7eb;
            padding: 0.625rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .blog-search-btn:hover {
            background-color: #1a1a1a;
            border-color: #374151;
            color: #ffffff;
        }

        /* Publication Filters - Dropdown Style */
        .publication-filters {
            position: relative;
        }

        .filter-dropdown-btn {
            background-color: #0f0f0f;
            border: 1px solid #262626;
            color: #e5e7eb;
            padding: 0.625rem 1.25rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .filter-dropdown-btn:hover {
            background-color: #1a1a1a;
            border-color: #374151;
        }

        .filter-dropdown-btn i {
            font-size: 0.75rem;
            transition: transform 0.2s;
        }

        .filter-dropdown-btn.active i {
            transform: rotate(180deg);
        }

        .filter-dropdown-menu {
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background-color: #0f0f0f;
            border: 1px solid #262626;
            border-radius: 0.5rem;
            padding: 0.5rem;
            min-width: 200px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 100;
        }

        .filter-dropdown-menu.show {
            display: block;
        }

        .filter-dropdown-item {
            display: block;
            padding: 0.625rem 1rem;
            color: #9ca3af;
            text-decoration: none;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .filter-dropdown-item:hover {
            background-color: #1a1a1a;
            color: #e5e7eb;
        }

        .filter-dropdown-item.active {
            background-color: rgba(55, 65, 81, 0.3);
            color: #d1d5db;
            font-weight: 600;
            border-left: 3px solid #6b7280;
        }

        /* Publication Card Redesign */
        .publication-card {
            background-color: #0f0f0f;
            border: 1px solid #1a1a1a;
            border-radius: 0.75rem;
            padding: 0;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .publication-card:hover {
            border-color: #2563eb;
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.15);
        }

        /* Featured Badge - Top Right Corner */
        .pub-featured-badge-corner {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            color: #000000;
            padding: 0.375rem 0.875rem;
            border-radius: 0.5rem;
            font-size: 0.75rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            z-index: 10;
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .pub-featured-badge-corner i {
            font-size: 0.875rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.1);
            }
        }

        .blog-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .publication-content {
            padding: 1.5rem;
        }

        .blog-tags {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }

        .tag {
            background-color: #1a1a1a;
            color: #9ca3af;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .publication-title {
            color: #ffffff;
            font-size: 1.125rem;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 0.75rem;
        }

        .publication-abstract {
            color: #9ca3af;
            font-size: 0.875rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .publication-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid #1a1a1a;
        }

        .publication-authors {
            color: #9ca3af;
            font-size: 0.8125rem;
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .publication-authors i {
            font-size: 0.875rem;
            color: #6b7280;
        }

        .publication-year {
            color: #6b7280;
            font-size: 0.8125rem;
            font-weight: 500;
        }

        .publication-venue {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            color: #6b7280;
            font-size: 0.8125rem;
            margin-bottom: 1rem;
        }

        .publication-venue i {
            font-size: 0.875rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state-icon {
            font-size: 4rem;
            color: #374151;
            margin-bottom: 1rem;
        }

        .empty-state-title {
            color: #9ca3af;
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state-desc {
            color: #6b7280;
            font-size: 0.875rem;
        }

        /* Pagination */
        .pagination-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #1a1a1a;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .page-item {
            background-color: #0f0f0f;
            border: 1px solid #262626;
            color: #9ca3af;
            padding: 0.5rem 0.875rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
        }

        .page-item:hover:not(.disabled) {
            background-color: #1a1a1a;
            border-color: #374151;
            color: #ffffff;
        }

        .page-item.active {
            background-color: #1a1a1a;
            border-color: #374151;
            color: #ffffff;
            font-weight: 700;
        }

        .page-item.disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        @media (max-width: 991px) {
            .publications-hero-title {
                font-size: 2rem;
            }

            .search-filter-container {
                flex-direction: column;
                align-items: stretch;
            }

            .blog-search-section {
                max-width: 100%;
            }

            .filter-dropdown-menu {
                right: auto;
                left: 0;
            }
        }

        @media (max-width: 767px) {
            .blog-search-wrapper {
                flex-direction: column;
            }

            .blog-search-btn {
                width: 100%;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- Hero Section -->
        <section class="publications-hero">
            <h1 class="publications-hero-title">
                Latest <span>Publications</span>
            </h1>
            <p class="publications-hero-subtitle">
                Research papers, academic publications, and scientific contributions.
            </p>
        </section>

        <!-- Search Bar & Filters - Aligned -->
        <div class="search-filter-container">
            <!-- Search -->
            <section class="blog-search-section">
                <form action="{{ route('publication.index') }}" method="GET">
                    <div class="blog-search-wrapper">
                        <div class="blog-search-input-wrapper">
                            <i class="bi bi-search blog-search-icon"></i>
                            <input type="text" class="blog-search-input" placeholder="Search publications..."
                                name="search" value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="blog-search-btn">Search</button>
                    </div>
                </form>
            </section>

            <!-- Filters Dropdown -->
            <section class="publication-filters">
                <button class="filter-dropdown-btn" id="filterDropdownBtn">
                    <i class="bi bi-funnel"></i>
                    <span>{{ request('type') ? ucfirst(str_replace('_', ' ', request('type'))) : 'All Types' }}</span>
                    <i class="bi bi-chevron-down"></i>
                </button>
                <div class="filter-dropdown-menu" id="filterDropdownMenu">
                    <a href="{{ route('publication.index') }}"
                        class="filter-dropdown-item {{ !request('type') ? 'active' : '' }}">
                        All Types
                    </a>
                    @foreach (['journal', 'conference', 'preprint', 'thesis', 'book_chapter', 'workshop'] as $type)
                        <a href="{{ route('publication.index', ['type' => $type]) }}"
                            class="filter-dropdown-item {{ request('type') == $type ? 'active' : '' }}">
                            {{ ucfirst(str_replace('_', ' ', $type)) }}
                        </a>
                    @endforeach
                </div>
            </section>
        </div>

        <!-- Publications Grid -->
        <section class="blogs-grid-section">
            <div class="row g-4">
                @forelse($publications as $pub)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('publication.show', $pub->slug) }}" class="publication-card">
                            <!-- Featured Badge - Top Right -->
                            @if ($pub->is_featured)
                                <span class="pub-featured-badge-corner">
                                    <i class="bi bi-star-fill"></i>
                                    Featured
                                </span>
                            @endif

                            <!-- Image -->
                            <img src="{{ asset('storage/' . $pub->featured_image) }}" alt="{{ $pub->title }}"
                                class="blog-image">

                            <!-- Content -->
                            <div class="publication-content">
                                <!-- Tags -->
                                <div class="blog-tags">
                                    @foreach ($pub->tags->take(2) as $tag)
                                        <span class="tag">#{{ $tag->slug }}</span>
                                    @endforeach
                                </div>

                                <!-- Title -->
                                <h3 class="publication-title">{{ $pub->title }}</h3>

                                <!-- Venue -->
                                @if ($pub->venue)
                                    <div class="publication-venue">
                                        <i class="bi bi-building"></i>
                                        <span>{{ Str::limit($pub->venue, 40) }}</span>
                                    </div>
                                @endif

                                <!-- Abstract -->
                                <p class="publication-abstract">
                                    {{ strip_tags($pub->short_abstract) }}
                                </p>

                                <!-- Meta -->
                                <div class="publication-meta">
                                    <div class="publication-authors">
                                        <i class="bi bi-person"></i>
                                        <span>
                                            {{ $pub->authors->first()->name ?? 'Anonymous' }}
                                            @if ($pub->authors->count() > 1)
                                                et al.
                                            @endif
                                        </span>
                                    </div>
                                    <span class="publication-year">{{ $pub->formatted_date }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-file-earmark-text empty-state-icon"></i>
                            <h3 class="empty-state-title">No publications found</h3>
                            <p class="empty-state-desc">
                                Try adjusting your search or filter criteria
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Pagination -->
        @if ($publications->hasPages())
            <section class="pagination-section">
                <div class="pagination">
                    @if ($publications->onFirstPage())
                        <span class="page-item disabled">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $publications->previousPageUrl() }}" class="page-item">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    @endif

                    @foreach (range(1, $publications->lastPage()) as $page)
                        @if ($page == $publications->currentPage())
                            <span class="page-item active">{{ $page }}</span>
                        @else
                            <a href="{{ $publications->url($page) }}" class="page-item">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($publications->hasMorePages())
                        <a href="{{ $publications->nextPageUrl() }}" class="page-item">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    @else
                        <span class="page-item disabled">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    @endif
                </div>
            </section>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        // Dropdown Toggle
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.getElementById('filterDropdownBtn');
            const dropdownMenu = document.getElementById('filterDropdownMenu');

            dropdownBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
                dropdownBtn.classList.toggle('active');
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function(e) {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                    dropdownBtn.classList.remove('active');
                }
            });
        });
    </script>
@endpush
