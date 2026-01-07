@extends('layouts.pages')
@section('title', $project->title . ' - Projects')
@push('styles')
    <style>
        
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

        <!-- Header -->
        <div class="project-detail-header">
            <div class="row g-3 align-items-start">
                <div class="col-lg-8">
                    <div class="project-detail-meta">
                        <div class="project-detail-meta-item">
                            <i class="bi bi-calendar"></i>
                            <span>{{ $project->formatted_date }}</span>
                        </div>
                        <span class="project-detail-meta-divider">•</span>
                        <div class="project-detail-meta-item">
                            <i class="bi bi-eye"></i>
                            <span>{{ number_format($project->views) }} views</span>
                        </div>
                        @if ($project->role)
                            <span class="project-detail-meta-divider">•</span>
                            <div class="project-detail-meta-item">
                                <i class="bi bi-person"></i>
                                <span>{{ $project->role }}</span>
                            </div>
                        @endif
                    </div>
                    <h1 class="project-detail-title">{{ $project->title }}</h1>
                    @if ($project->category)
                        <div class="project-detail-category">
                            <i class="bi bi-folder"></i>
                            <span>{{ $project->category->name }}</span>
                            <span class="project-status-badge {{ $project->status_badge_class }}">
                                <i class="bi bi-circle-fill"></i>
                                {{ $project->status_label }}
                            </span>
                            @if ($project->is_featured)
                                <span class="project-featured-badge-detail">
                                    <i class="bi bi-star-fill"></i> Featured
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="d-flex gap-2 justify-content-lg-end flex-wrap">
                        @if ($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank"
                                class="project-action-btn project-action-github flex-fill flex-lg-grow-0">
                                <i class="bi bi-github"></i>
                                <span>GitHub</span>
                            </a>
                        @endif
                        @if ($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank"
                                class="project-action-btn project-action-demo flex-fill flex-lg-grow-0">
                                <i class="bi bi-box-arrow-up-right"></i>
                                <span>Live Demo</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Layout with Bootstrap Grid -->
        <div class="row g-4">
            <!-- Main Content Column (8 cols on large screens) -->
            <div class="col-lg-8">
                <!-- Gallery Slider -->
                @php
                    $allImages = collect();
                    if ($project->featured_image) {
                        $allImages->push(
                            (object) [
                                'image_path' => $project->featured_image,
                                'caption' => $project->title,
                            ],
                        );
                    }
                    $allImages = $allImages->merge($project->images);
                @endphp
                @if ($allImages->count() > 0)
                    <div class="project-gallery-slider">
                        <img src="{{ asset('storage/' . $allImages->first()->image_path) }}"
                            alt="{{ $allImages->first()->caption ?? $project->title }}" class="gallery-main-image"
                            id="mainGalleryImage">
                        @if ($allImages->count() > 1)
                            <button class="gallery-nav-btn gallery-nav-prev" id="prevBtn" onclick="changeImage(-1)">
                                <i class="bi bi-chevron-left"></i>
                            </button>
                            <button class="gallery-nav-btn gallery-nav-next" id="nextBtn" onclick="changeImage(1)">
                                <i class="bi bi-chevron-right"></i>
                            </button>
                            <div class="gallery-counter">
                                <span id="currentIndex">1</span> / <span id="totalImages">{{ $allImages->count() }}</span>
                            </div>
                        @endif
                        @if ($allImages->count() > 1)
                            <div class="gallery-thumbnails" id="thumbnailsContainer">
                                @foreach ($allImages as $index => $image)
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $image->caption ?? $project->title }}"
                                        class="gallery-thumbnail {{ $index === 0 ? 'active' : '' }}"
                                        onclick="goToImage({{ $index }})" loading="lazy">
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Description -->
                <div class="project-content-section">
                    <h2 class="project-section-title">
                        <i class="bi bi-file-text"></i>
                        Description
                    </h2>
                    <div class="project-content-text">
                        {!! html_entity_decode($project->content ?? $project->description) !!}
                    </div>
                </div>

                <!-- Features Section with Bootstrap Grid -->
                @if ($project->features->count() > 0)
                    <div class="project-content-section">
                        <h2 class="project-section-title">
                            <i class="bi bi-lightning"></i>
                            Key Features
                        </h2>
                        <div class="row g-3">
                            @foreach ($project->features as $feature)
                                <div class="col-md-6">
                                    <div class="feature-card">
                                        @if ($feature->icon_class)
                                            <div class="feature-header">
                                                <i class="{{ $feature->icon_class }} feature-icon"></i>
                                                <h3 class="feature-title">{{ $feature->title }}</h3>
                                            </div>
                                        @endif
                                        <p class="feature-desc">{{ $feature->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Tech Stack Section with Bootstrap Grid -->
                @if ($project->techStacks->count() > 0)
                    <div class="project-content-section">
                        <h2 class="project-section-title">
                            <i class="bi bi-code-slash"></i>
                            Tech Stack
                        </h2>
                        <div class="row g-3">
                            @foreach ($project->techStacks as $tech)
                                <div class="col-md-6 col-lg-4">
                                    <div class="tech-stack-card">
                                        <div class="tech-stack-icon">
                                            @if ($tech->icon_class)
                                                <i class="{{ $tech->icon_class }}"
                                                    style="color: {{ $tech->icon_color ?? '#9ca3af' }};"></i>
                                            @else
                                                <i class="bi bi-code-square"
                                                    style="color: {{ $tech->icon_color ?? '#9ca3af' }};"></i>
                                            @endif
                                        </div>
                                        <div class="tech-stack-info">
                                            <h3 class="tech-stack-title">{{ $tech->name }}</h3>
                                            @if ($tech->category)
                                                <p class="tech-stack-desc">{{ $tech->category }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar Column (4 cols on large screens) -->
            <div class="col-lg-4">
                <div class="sticky-sidebar">
                    <div class="d-flex flex-column gap-3">
                        <!-- Project Info -->
                        <div class="project-sidebar-card">
                            <h3 class="project-sidebar-title">
                                <i class="bi bi-info-circle"></i>
                                Project Info
                            </h3>
                            <div class="project-info-list">
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
                                            <i class="bi bi-folder"></i>
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
                                        <i class="bi bi-eye"></i>
                                        Views
                                    </span>
                                    <span class="project-info-value">{{ number_format($project->views) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Support Card -->
                        @php
                            $user = App\Models\User::first();
                        @endphp
                        @if ($user && $user->support_url)
                            <div class="project-support-card">
                                <div class="project-support-icon">
                                    <i class="bi bi-heart-fill"></i>
                                </div>
                                <h3 class="project-support-title">Support My Work</h3>
                                <p class="project-support-desc">
                                    If you find this project useful, consider buying me a coffee!
                                </p>
                                <a href="{{ $user->support_url }}" target="_blank" class="btn-support-full">
                                    <i class="bi bi-heart-fill"></i>
                                    <span>Support</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Projects with Bootstrap Grid -->
        @if ($related->count() > 0)
            <section class="related-section">
                <h2 class="section-title">Related Projects</h2>
                <div class="row g-4">
                    @foreach ($related as $rel)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('project.show', $rel->slug) }}" class="project-card">
                                @if ($rel->is_featured)
                                    <span class="project-featured-badge-corner">
                                        <i class="bi bi-star-fill"></i>
                                        Featured
                                    </span>
                                @endif
                                <img src="{{ $rel->featured_image ? asset('storage/' . $rel->featured_image) : 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=400&fit=crop' }}"
                                    alt="{{ $rel->title }}" class="project-image" loading="lazy">
                                <div class="project-content">
                                    <div class="project-meta-top">
                                        @if ($rel->category)
                                            <span class="project-category">
                                                {{ $rel->category->name }}
                                            </span>
                                        @endif
                                        <span class="project-status {{ $rel->status_badge_class }}">
                                            <i class="bi bi-circle-fill"></i>
                                            {{ $rel->status_label }}
                                        </span>
                                    </div>
                                    <h3 class="project-title">{{ $rel->title }}</h3>
                                    <p class="project-desc">
                                        {{ $rel->short_description }}
                                    </p>
                                    @if ($rel->techStacks->count() > 0)
                                        <div class="project-tech">
                                            @foreach ($rel->techStacks->take(5) as $tech)
                                                <span class="tech-icon" title="{{ $tech->name }}">
                                                    @if ($tech->icon_class)
                                                        <i class="{{ $tech->icon_class }}"
                                                            style="color: {{ $tech->icon_color ?? '#9ca3af' }};"></i>
                                                    @else
                                                        <i class="bi bi-code-slash"
                                                            style="color: {{ $tech->icon_color ?? '#9ca3af' }};"></i>
                                                    @endif
                                                </span>
                                            @endforeach
                                            @if ($rel->techStacks->count() > 5)
                                                <span class="tech-icon" title="{{ $rel->techStacks->count() - 5 }} more">
                                                    <span
                                                        style="font-size: 0.75rem; font-weight: 600; color: #9ca3af;">+{{ $rel->techStacks->count() - 5 }}</span>
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
@push('scripts')
    <script>
        // Gallery Slider - Fixed Version
        document.addEventListener('DOMContentLoaded', function() {
            const gallerySlider = document.querySelector('.project-gallery-slider');
            const mainImage = document.getElementById('mainGalleryImage');
            const currentIndexEl = document.getElementById('currentIndex');
            const totalImagesEl = document.getElementById('totalImages');
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const thumbnails = document.querySelectorAll('.gallery-thumbnail');
            if (!gallerySlider || !mainImage) return;

            let images = [];
            thumbnails.forEach((thumb) => {
                images.push(thumb.src);
            });
            let currentImageIndex = 0;

            function updateGallery() {
                if (images.length === 0) return;
                mainImage.src = images[currentImageIndex];
                if (currentIndexEl) {
                    currentIndexEl.textContent = currentImageIndex + 1;
                }
                thumbnails.forEach((thumb, index) => {
                    if (index === currentImageIndex) {
                        thumb.classList.add('active');
                        thumb.scrollIntoView({
                            behavior: 'smooth',
                            block: 'nearest',
                            inline: 'center'
                        });
                    } else {
                        thumb.classList.remove('active');
                    }
                });
                if (prevBtn) {
                    prevBtn.disabled = currentImageIndex === 0;
                    prevBtn.style.opacity = currentImageIndex === 0 ? '0.3' : '1';
                }
                if (nextBtn) {
                    nextBtn.disabled = currentImageIndex === images.length - 1;
                    nextBtn.style.opacity = currentImageIndex === images.length - 1 ? '0.3' : '1';
                }
            }

            window.changeImage = function(direction) {
                const newIndex = currentImageIndex + direction;
                if (newIndex >= 0 && newIndex < images.length) {
                    currentImageIndex = newIndex;
                    updateGallery();
                }
            };

            window.goToImage = function(index) {
                if (index >= 0 && index < images.length) {
                    currentImageIndex = index;
                    updateGallery();
                }
            };

            document.addEventListener('keydown', function(e) {
                if (images.length <= 1) return;
                if (e.key === 'ArrowRight' || e.key === 'Right') {
                    e.preventDefault();
                    changeImage(1);
                } else if (e.key === 'ArrowLeft' || e.key === 'Left') {
                    e.preventDefault();
                    changeImage(-1);
                }
            });

            let touchStartX = 0;
            let touchEndX = 0;
            let touchStartY = 0;
            let touchEndY = 0;
            gallerySlider.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                touchStartY = e.changedTouches[0].screenY;
            }, {
                passive: true
            });
            gallerySlider.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                touchEndY = e.changedTouches[0].screenY;
                handleSwipe();
            }, {
                passive: true
            });

            function handleSwipe() {
                const diffX = touchStartX - touchEndX;
                const diffY = touchStartY - touchEndY;
                if (Math.abs(diffX) > Math.abs(diffY)) {
                    if (Math.abs(diffX) > 50) {
                        if (diffX > 0) {
                            changeImage(1);
                        } else {
                            changeImage(-1);
                        }
                    }
                }
            }

            let isDragging = false;
            let startPos = 0;
            let currentTranslate = 0;
            let prevTranslate = 0;
            mainImage.addEventListener('mousedown', function(e) {
                if (images.length <= 1) return;
                isDragging = true;
                startPos = e.clientX;
                mainImage.style.cursor = 'grabbing';
                e.preventDefault();
            });
            mainImage.addEventListener('mousemove', function(e) {
                if (!isDragging) return;
                e.preventDefault();
                const currentPosition = e.clientX;
                currentTranslate = prevTranslate + currentPosition - startPos;
            });
            mainImage.addEventListener('mouseup', function(e) {
                if (!isDragging) return;
                isDragging = false;
                mainImage.style.cursor = 'grab';
                const movedBy = e.clientX - startPos;
                if (Math.abs(movedBy) > 50) {
                    if (movedBy < 0) {
                        changeImage(1);
                    } else {
                        changeImage(-1);
                    }
                }
                prevTranslate = 0;
                currentTranslate = 0;
            });
            mainImage.addEventListener('mouseleave', function() {
                if (isDragging) {
                    isDragging = false;
                    mainImage.style.cursor = 'grab';
                    prevTranslate = 0;
                    currentTranslate = 0;
                }
            });

            if (images.length > 1) {
                mainImage.style.cursor = 'grab';
            }

            thumbnails.forEach((thumb, index) => {
                thumb.addEventListener('click', function() {
                    goToImage(index);
                });
            });

            updateGallery();
        });
    </script>
@endpush
