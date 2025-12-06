@extends('layouts.pages')
@section('title', 'Projects')

@push('styles')
    <style>
        /* Projects Page Specific */
        .projects-hero {
            padding: 4rem 0 2rem;
        }

        .projects-hero-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 0.75rem;
            line-height: 1.2;
        }

        .projects-hero-title span {
            color: #2563eb;
        }

        .projects-hero-subtitle {
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

        /* Search Section */
        .project-search-section {
            margin-bottom: 0;
            flex: 1;
            max-width: 500px;
        }

        .project-search-wrapper {
            display: flex;
            gap: 0.5rem;
        }

        .project-search-input-wrapper {
            position: relative;
            flex: 1;
        }

        .project-search-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
            font-size: 0.875rem;
        }

        .project-search-input {
            width: 100%;
            padding: 0.625rem 1rem 0.625rem 2.5rem;
            background-color: #0f0f0f;
            border: 1px solid #262626;
            border-radius: 0.5rem;
            color: #ffffff;
            font-size: 0.875rem;
            transition: all 0.2s;
        }

        .project-search-input:focus {
            outline: none;
            border-color: #2563eb;
            background-color: #1a1a1a;
        }

        .project-search-input::placeholder {
            color: #6b7280;
        }

        .project-search-btn {
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

        .project-search-btn:hover {
            background-color: #1a1a1a;
            border-color: #374151;
            color: #ffffff;
        }

        /* Filter Dropdowns */
        .project-filters {
            display: flex;
            gap: 0.75rem;
        }

        .filter-dropdown {
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

        .filter-dropdown-btn i:last-child {
            font-size: 0.75rem;
            transition: transform 0.2s;
        }

        .filter-dropdown-btn.active i:last-child {
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

        /* Project Card */
        .project-card {
            background-color: #0f0f0f;
            border: 1px solid #1a1a1a;
            border-radius: 0.75rem;
            padding: 0;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
            position: relative;
        }

        .project-card:hover {
            border-color: #2563eb;
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.15);
        }

        .project-badge {
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

        .project-badge i {
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

        .project-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            flex-shrink: 0;
        }

        .project-content {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .project-meta-top {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            margin-bottom: 1rem;
        }

        .project-category {
            background-color: #1a1a1a;
            color: #9ca3af;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .project-status {
            padding: 0.25rem 0.625rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-active {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-completed {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .project-title {
            color: #ffffff;
            font-size: 1.125rem;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 0.75rem;
        }

        .project-desc {
            color: #9ca3af;
            font-size: 0.875rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex-grow: 1;
        }

        .project-tech {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #1a1a1a;
            margin-top: auto;
        }

        .tech-icon {
            font-size: 1.25rem;
            transition: transform 0.2s;
        }

        .tech-icon:hover {
            transform: scale(1.15);
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
            .projects-hero-title {
                font-size: 2rem;
            }

            .search-filter-container {
                flex-direction: column;
                align-items: stretch;
            }

            .project-search-section {
                max-width: 100%;
            }

            .project-filters {
                justify-content: flex-start;
            }
        }

        @media (max-width: 767px) {
            .project-search-wrapper {
                flex-direction: column;
            }

            .project-search-btn {
                width: 100%;
            }

            .project-filters {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- Hero Section -->
        <section class="projects-hero">
            <h1 class="projects-hero-title">
                My <span>Projects</span>
            </h1>
            <p class="projects-hero-subtitle">
                Where effort met execution, these projects are artifacts of discipline and continuous learning.
            </p>
        </section>

        <!-- Search & Filter Container -->
        <div class="search-filter-container">
            <!-- Search -->
            <section class="project-search-section">
                <form action="{{ route('project.index') }}" method="GET" id="projectSearchForm">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <input type="hidden" name="status" value="{{ request('status') }}">
                    <div class="project-search-wrapper">
                        <div class="project-search-input-wrapper">
                            <i class="bi bi-search project-search-icon"></i>
                            <input type="text" class="project-search-input" placeholder="Search projects..."
                                name="search" value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="project-search-btn">Search</button>
                    </div>
                </form>
            </section>

            <!-- Filters -->
            <div class="project-filters">
                <!-- Category Filter -->
                <div class="filter-dropdown">
                    <button class="filter-dropdown-btn" id="categoryDropdownBtn">
                        <i class="bi bi-folder"></i>
                        <span>{{ request('category') ? $categories->find(request('category'))->name : 'All Categories' }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="filter-dropdown-menu" id="categoryDropdownMenu">
                        <a href="{{ route('project.index', array_filter(['search' => request('search'), 'status' => request('status')])) }}"
                            class="filter-dropdown-item {{ !request('category') ? 'active' : '' }}">
                            All Categories
                        </a>
                        @foreach ($categories as $category)
                            <a href="{{ route('project.index', array_filter(['category' => $category->id, 'search' => request('search'), 'status' => request('status')])) }}"
                                class="filter-dropdown-item {{ request('category') == $category->id ? 'active' : '' }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="filter-dropdown">
                    <button class="filter-dropdown-btn" id="statusDropdownBtn">
                        <i class="bi bi-funnel"></i>
                        <span>{{ request('status') ? ucfirst(str_replace('_', ' ', request('status'))) : 'All Status' }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <div class="filter-dropdown-menu" id="statusDropdownMenu">
                        <a href="{{ route('project.index', array_filter(['search' => request('search'), 'category' => request('category')])) }}"
                            class="filter-dropdown-item {{ !request('status') ? 'active' : '' }}">
                            All Status
                        </a>
                        @foreach (['active', 'completed', 'archived', 'on_hold', 'in_development'] as $status)
                            <a href="{{ route('project.index', array_filter(['status' => $status, 'search' => request('search'), 'category' => request('category')])) }}"
                                class="filter-dropdown-item {{ request('status') == $status ? 'active' : '' }}">
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Projects Grid -->
        <section class="projects-grid-section">
            <div class="row g-4">
                @forelse($projects as $project)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('project.show', $project->id) }}" class="project-card">
                            @if ($project->is_featured)
                                <span class="project-badge">
                                    <i class="bi bi-star-fill"></i>
                                    Featured
                                </span>
                            @endif

                            <img src="{{ $project->featured_image ? asset('storage/' . $project->featured_image) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop' }}"
                                alt="{{ $project->title }}" class="project-image" loading="lazy">

                            <div class="project-content">
                                <div class="project-meta-top">
                                    @if ($project->category)
                                        <span class="project-category">
                                            {{ $project->category->name }}
                                        </span>
                                    @endif
                                    @php
                                        $statusClasses = [
                                            'active' => 'status-active',
                                            'completed' => 'status-completed',
                                        ];
                                    @endphp
                                    <span class="project-status {{ $statusClasses[$project->status] ?? 'status-active' }}">
                                        {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                                    </span>
                                </div>

                                <h3 class="project-title">{{ $project->title }}</h3>

                                <p class="project-desc">
                                    {{ Str::limit($project->description, 150) }}
                                </p>

                                @if ($project->techStacks->count() > 0)
                                    <div class="project-tech">
                                        @foreach ($project->techStacks->take(6) as $tech)
                                            <span class="tech-icon" style="color: {{ $tech->color ?? '#6b7280' }};"
                                                title="{{ $tech->name }}">
                                                @if ($tech->icon_class)
                                                    <i class="{{ $tech->icon_class }}"></i>
                                                @else
                                                    <i class="bi bi-code-slash"></i>
                                                @endif
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-folder-x empty-state-icon"></i>
                            <h3 class="empty-state-title">No projects found</h3>
                            <p class="empty-state-desc">
                                Try adjusting your search or filter criteria
                            </p>
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Pagination -->
        @if ($projects->hasPages())
            <section class="pagination-section">
                <div class="pagination">
                    @if ($projects->onFirstPage())
                        <span class="page-item disabled">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $projects->previousPageUrl() }}" class="page-item">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    @endif

                    @foreach (range(1, $projects->lastPage()) as $page)
                        @if ($page == $projects->currentPage())
                            <span class="page-item active">{{ $page }}</span>
                        @else
                            <a href="{{ $projects->url($page) }}" class="page-item">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if ($projects->hasMorePages())
                        <a href="{{ $projects->nextPageUrl() }}" class="page-item">
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
        document.addEventListener('DOMContentLoaded', function() {
            // Category Dropdown
            const categoryBtn = document.getElementById('categoryDropdownBtn');
            const categoryMenu = document.getElementById('categoryDropdownMenu');

            categoryBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                categoryMenu.classList.toggle('show');
                categoryBtn.classList.toggle('active');
                statusMenu.classList.remove('show');
                statusBtn.classList.remove('active');
            });

            // Status Dropdown
            const statusBtn = document.getElementById('statusDropdownBtn');
            const statusMenu = document.getElementById('statusDropdownMenu');

            statusBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                statusMenu.classList.toggle('show');
                statusBtn.classList.toggle('active');
                categoryMenu.classList.remove('show');
                categoryBtn.classList.remove('active');
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function(e) {
                if (!categoryBtn.contains(e.target) && !categoryMenu.contains(e.target)) {
                    categoryMenu.classList.remove('show');
                    categoryBtn.classList.remove('active');
                }
                if (!statusBtn.contains(e.target) && !statusMenu.contains(e.target)) {
                    statusMenu.classList.remove('show');
                    statusBtn.classList.remove('active');
                }
            });
        });
    </script>
@endpush
