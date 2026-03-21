@extends('layouts.pages')

@section('title', 'Home')

@push('styles')
    <style>
        .blog-tags {
            display: flex;
            gap: 6px;
            flex-wrap: nowrap;
            overflow: hidden;
        }

        .blog-tags .tag {
            max-width: 120px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .project-support-card {
            margin: auto;
            padding: 40px 30px;
            text-align: center;
            border-radius: 16px;

            background: linear-gradient(135deg, #020617, #020617 40%, #0f0226);
            border: 1px solid rgba(120, 120, 255, 0.2);

            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.6);
        }

        .project-support-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: linear-gradient(135deg, #4f46e5, #9333ea);
            color: white;
            font-size: 26px;

            box-shadow: 0 6px 20px rgba(147, 51, 234, 0.5);
        }

        .project-support-title {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #ffffff;
        }

        .project-support-desc {
            max-width: 600px;
            margin: 0 auto 30px;

            font-size: 15px;
            color: #9ca3af;
            line-height: 1.6;
        }

        .btn-support-full {
            max-width: 900px;
            display: center;
            align-items: center;
            justify-content: center;
            gap: 10px;

            width: 100%;
            padding: 14px 20px;

            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            color: white;

            background: linear-gradient(90deg, #3b82f6, #6366f1, #9333ea);

            transition: all .25s ease;
        }

        .btn-support-full:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        }
    </style>
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
                        <a href="{{ route('career.index') }}" class="btn btn-success">
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
                            <span data-lang="section-publications">Publications</span>
                        </h2>
                        <a href="{{ route('publication.index') }}" class="view-all-link">
                            <span data-lang="view-all">View All</span>
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Desktop Grid View -->
            <div class="row g-4 d-none d-lg-flex">
                @forelse($publications as $pub)
                    <div class="col-lg-4 col-md-6">
                        <a href="{{ route('publication.show', $pub->slug) }}" class="blog-card publication-card-home">
                            <!-- Tags -->
                            <div class="blog-tags">
                                @foreach ($pub->tags->take(2) as $tag)
                                    <span class="tag" title="#{{ $tag->slug }}">
                                        #{{ $tag->slug }}
                                    </span>
                                @endforeach

                                @if ($pub->tags->count() > 2)
                                    <span class="tag more-tags">
                                        +{{ $pub->tags->count() - 2 }}
                                    </span>
                                @endif
                            </div>


                            <!-- Image -->
                            <img src="{{ asset('storage/' . $pub->featured_image) }}" alt="{{ $pub->title }}"
                                class="blog-image">

                            <!-- Title -->
                            <h3 class="blog-title">{{ $pub->title }}</h3>

                            <!-- Excerpt -->
                            <p class="blog-excerpt">
                                {{ strip_tags($pub->short_abstract) }}
                            </p>

                            <!-- Meta -->
                            <div class="blog-meta">
                                <div class="blog-author">
                                    <i class="bi bi-person"></i>
                                    <span class="author-name">
                                        {{ $pub->authors->first()->name ?? 'Anonymous' }}
                                        @if ($pub->authors->count() > 1)
                                            et al.
                                        @endif
                                    </span>
                                </div>
                                <span class="blog-date">{{ $pub->formatted_date }}</span>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <p class="text-muted text-center">No publications available yet.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Mobile Carousel View -->
            <div class="blog-mobile d-lg-none">
                @if ($publications->count() > 0)
                    <div id="blogCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
                        <div class="carousel-inner">
                            @foreach ($publications as $index => $pub)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <a href="{{ route('publication.show', $pub->slug) }}"
                                        class="blog-card publication-card-home">
                                        <!-- Tags -->
                                        <div class="blog-tags">
                                            @foreach ($pub->tags->take(2) as $tag)
                                                <span class="tag" title="#{{ $tag->slug }}">
                                                    #{{ $tag->slug }}
                                                </span>
                                            @endforeach

                                            @if ($pub->tags->count() > 2)
                                                <span class="tag more-tags">
                                                    +{{ $pub->tags->count() - 2 }}
                                                </span>
                                            @endif
                                        </div>

                                        <!-- Image -->
                                        <img src="{{ asset('storage/' . $pub->featured_image) }}"
                                            alt="{{ $pub->title }}" class="blog-image">

                                        <!-- Title -->
                                        <h3 class="blog-title">{{ $pub->title }}</h3>

                                        <!-- Excerpt -->
                                        <p class="blog-excerpt">
                                            {{ strip_tags($pub->short_abstract) }}
                                        </p>

                                        <!-- Meta -->
                                        <div class="blog-meta">
                                            <div class="blog-author">
                                                <img src="{{ asset('pages/img/hero.png') }}" alt="Author"
                                                    class="author-avatar">
                                                <span class="author-name">
                                                    {{ $pub->authors->first()->name ?? 'Anonymous' }}
                                                    @if ($pub->authors->count() > 1)
                                                        et al.
                                                    @endif
                                                </span>
                                            </div>
                                            <span class="blog-date">{{ $pub->formatted_date }}</span>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!-- Controls -->
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

                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            @foreach ($publications as $index => $pub)
                                <button type="button" data-bs-target="#blogCarousel"
                                    data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                    aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-label="Slide {{ $index + 1 }}">
                                </button>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="empty-state">
                        <p class="text-muted text-center">No publications available yet.</p>
                    </div>
                @endif
            </div>
        </section>

        <div class="divider"></div>

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
                            <i class="{{ $tool->icon_class }}" style="color: {{ $tool->icon_color ?? '#ffffff' }}"></i>
                            {{ $tool->name }}
                        </span>
                    @endforeach
                </div>
                <div class="tools-row">
                    @foreach ($techStacks->reverse() as $tool)
                        <span class="tool-badge">
                            <i class="{{ $tool->icon_class }}" style="color: {{ $tool->icon_color ?? '#ffffff' }}"></i>
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
                    <div class="project-support-card">
                        <div class="project-support-icon">
                            <i class="bi bi-heart-fill"></i>
                        </div>

                        <h3 class="project-support-title" data-lang="support-title">
                            Support My Work
                        </h3>

                        <p class="project-support-desc" data-lang="support-desc">
                            Help me continue creating open source projects and sharing knowledge with the community!
                        </p>

                        <a href="{{ $user->support_url }}" target="_blank" class="btn-support-full">
                            <i class="bi bi-heart-fill"></i>
                            <span data-lang="btn-support">Support</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('modal')
@endpush

@push('scripts')
@endpush
