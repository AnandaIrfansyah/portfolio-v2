@extends('layouts.pages')
@section('title', $project->title . ' - Projects')

@push('styles')
    <style>
        .gallery-thumbnail {
            cursor: pointer;
            opacity: 0.6;
            transition: opacity 0.3s;
        }

        .gallery-thumbnail.active {
            opacity: 1;
            border: 2px solid var(--primary-color);
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- Back Button -->
        <div class="project-detail-back">
            <a href="{{ route('project.index') }}" class="back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Back to Projects</span>
            </a>
        </div>

        <!-- Project Header -->
        <section class="project-detail-header">
            <div class="project-detail-title-wrapper">
                <h1 class="project-detail-title">{{ $project->title }}</h1>

                <div class="project-detail-actions">
                    @if ($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline">
                            <i class="bi bi-github"></i>
                            <span>GitHub</span>
                        </a>
                    @endif

                    @if ($project->demo_url)
                        <a href="{{ $project->demo_url }}" target="_blank" class="btn btn-primary">
                            <i class="bi bi-box-arrow-up-right"></i>
                            <span>Live Demo</span>
                        </a>
                    @endif
                </div>
            </div>

            <p class="project-detail-excerpt">
                {{ $project->description }}
            </p>
        </section>

        <!-- Project Images Gallery -->
        @if ($project->images->count() > 0 || $project->featured_image)
            <section class="project-detail-gallery">
                <div class="gallery-main">
                    <img src="{{ $project->featured_image ? asset('storage/' . $project->featured_image) : asset('storage/' . $project->images->first()->image_path) }}"
                        alt="{{ $project->title }}" class="gallery-main-img" id="mainGalleryImg">

                    @if ($project->images->count() > 1)
                        <div class="gallery-nav">
                            <button class="gallery-nav-btn" onclick="previousImage()">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <span class="gallery-counter">
                                <span id="currentImageIndex">1</span> / <span
                                    id="totalImages">{{ $project->images->count() }}</span>
                            </span>
                            <button class="gallery-nav-btn" onclick="nextImage()">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                        </div>
                    @endif
                </div>

                @if ($project->images->count() > 0)
                    <div class="gallery-caption">
                        {{ $project->images->count() }} images • Use arrows or click thumbnails to navigate
                    </div>
                @endif
            </section>
        @endif

        <!-- Project Content Grid -->
        <div class="project-detail-grid">
            <!-- Left Column - Description -->
            <div class="project-detail-main">
                <!-- Description Section -->
                <section class="project-detail-section">
                    <div class="section-header-simple">
                        <i class="bi bi-file-text section-icon"></i>
                        <h2 class="section-title-simple">Description</h2>
                    </div>
                    <div class="project-detail-content">
                        {!! $project->content ?? $project->description !!}
                    </div>
                </section>

                <!-- Features Section -->
                @if ($project->features->count() > 0)
                    <section class="project-detail-section">
                        <div class="section-header-simple">
                            <i class="bi bi-lightning section-icon"></i>
                            <h2 class="section-title-simple">Features</h2>
                        </div>
                        <div class="feature-grid">
                            @foreach ($project->features as $feature)
                                <div class="feature-card">
                                    @if ($feature->icon_class)
                                        <i class="{{ $feature->icon_class }} feature-icon"></i>
                                    @endif
                                    <h3 class="feature-title">{{ $feature->title }}</h3>
                                    <p class="feature-desc">{{ $feature->description }}</p>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif

                <!-- Tech Stack Section -->
                @if ($project->techStacks->count() > 0)
                    <section class="project-detail-section">
                        <div class="section-header-simple">
                            <i class="bi bi-code-slash section-icon"></i>
                            <h2 class="section-title-simple">Tech Stack</h2>
                        </div>
                        <div class="tech-stack-grid">
                            @foreach ($project->techStacks as $tech)
                                <div class="tech-stack-card">
                                    <div class="tech-stack-icon"
                                        style="background: {{ $tech->color ?? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' }};">
                                        @if ($tech->icon_class)
                                            <i class="{{ $tech->icon_class }}"></i>
                                        @else
                                            <i class="bi bi-code-square"></i>
                                        @endif
                                    </div>
                                    <div class="tech-stack-info">
                                        <h3 class="tech-stack-title">{{ $tech->name }}</h3>
                                        @if ($tech->description)
                                            <p class="tech-stack-desc">{{ $tech->description }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>
                @endif
            </div>

            <!-- Right Column - Sidebar Info -->
            <div class="project-detail-sidebar">
                <!-- Project Info Card -->
                <div class="project-info-card">
                    <h3 class="project-info-title">Project Info</h3>

                    <div class="project-info-item">
                        <span class="project-info-label">
                            <i class="bi bi-calendar3"></i>
                            Date
                        </span>
                        <span class="project-info-value">{{ $project->formatted_date }}</span>
                    </div>

                    @if ($project->category)
                        <div class="project-info-item">
                            <span class="project-info-label">
                                <i class="bi bi-tag"></i>
                                Category
                            </span>
                            <span class="project-info-value">{{ $project->category->name }}</span>
                        </div>
                    @endif

                    @if ($project->role)
                        <div class="project-info-item">
                            <span class="project-info-label">
                                <i class="bi bi-person"></i>
                                Role
                            </span>
                            <span class="project-info-value">{{ $project->role }}</span>
                        </div>
                    @endif

                    <div class="project-info-item">
                        <span class="project-info-label">
                            <i class="bi bi-code-slash"></i>
                            Status
                        </span>
                        <span class="project-status-badge {{ $project->status }}">
                            <i class="bi bi-circle-fill"></i>
                            {{ ucfirst(str_replace('_', ' ', $project->status)) }}
                        </span>
                    </div>

                    <div class="project-info-item">
                        <span class="project-info-label">
                            <i class="bi bi-eye"></i>
                            Views
                        </span>
                        <span class="project-info-value">{{ number_format($project->views) }}</span>
                    </div>
                </div>

                <!-- Support Card -->
                <div class="project-support-card">
                    <div class="project-support-icon">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                    <h3 class="project-support-title">Support My Work</h3>
                    <p class="project-support-desc">
                        If you find this project useful and want to support, consider buying me a coffee!
                    </p>
                    <a href="#" class="btn btn-support-full">
                        <i class="bi bi-heart-fill"></i>
                        <span>Support</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const galleryImages = @json($project->images->pluck('image_path'));
        let currentIndex = 0;

        function updateGalleryImage(index) {
            if (galleryImages.length === 0) return;

            currentIndex = index;
            const mainImg = document.getElementById('mainGalleryImg');
            mainImg.src = '/storage/' + galleryImages[currentIndex];
            document.getElementById('currentImageIndex').textContent = currentIndex + 1;
        }

        function nextImage() {
            if (currentIndex < galleryImages.length - 1) {
                updateGalleryImage(currentIndex + 1);
            }
        }

        function previousImage() {
            if (currentIndex > 0) {
                updateGalleryImage(currentIndex - 1);
            }
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') previousImage();
        });
    </script>
@endpush
