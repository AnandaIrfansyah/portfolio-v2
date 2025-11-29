@extends('layouts.pages')
@section('title', $publication->title)
@push('styles')
    <style>
        /* Publication Detail Styles */
        .pub-detail-back {
            margin-bottom: 2rem;
        }

        .pub-detail-back .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #9ca3af;
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
        }

        .pub-detail-back .back-link:hover {
            color: #ffffff;
        }

        /* Publication Header */
        .pub-detail-header {
            margin-bottom: 2.5rem;
        }

        .pub-detail-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .pub-detail-meta-item {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            color: #9ca3af;
            font-size: 0.875rem;
        }

        .pub-detail-meta-item i {
            color: #6b7280;
        }

        .pub-detail-meta-divider {
            color: #374151;
        }

        .pub-detail-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #ffffff;
            line-height: 1.2;
            margin-bottom: 1rem;
        }

        .pub-detail-venue {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #2563eb;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
        }

        .pub-detail-venue i {
            font-size: 1.125rem;
        }

        .pub-detail-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .pub-type-badge {
            background-color: #1a1a1a;
            color: #9ca3af;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.025em;
        }

        .pub-featured-badge {
            background-color: #fbbf24;
            color: #000000;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
        }

        .status-badge-inline {
            padding: 0.25rem 0.625rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .status-published {
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-accepted {
            background-color: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(59, 130, 246, 0.2);
        }

        .status-under-review {
            background-color: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .status-preprint {
            background-color: rgba(107, 114, 128, 0.1);
            color: #9ca3af;
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        /* Sidebar Layout */
        .pub-detail-layout {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 3rem;
            align-items: start;
        }

        .pub-detail-main {
            min-width: 0;
        }

        .pub-detail-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            position: sticky;
            top: 2rem;
        }

        /* Featured Image */
        .blog-detail-featured-image {
            width: 100%;
            height: auto;
            border-radius: 0.75rem;
            border: 1px solid #1a1a1a;
        }

        /* Sidebar Card */
        .pub-sidebar-card {
            background-color: #0f0f0f;
            border: 1px solid #1a1a1a;
            border-radius: 0.75rem;
            padding: 1.5rem;
        }

        .pub-sidebar-title {
            color: #ffffff;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .pub-sidebar-title i {
            color: #2563eb;
            font-size: 1.125rem;
        }

        /* External Links */
        .pub-links {
            display: flex;
            flex-direction: column;
            gap: 0.625rem;
        }

        .pub-link-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pub-link-doi {
            background-color: #1a1a1a;
            border: 1px solid #262626;
            color: #3b82f6;
        }

        .pub-link-doi:hover {
            background-color: rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }

        .pub-link-url {
            background-color: #1a1a1a;
            border: 1px solid #262626;
            color: #10b981;
        }

        .pub-link-url:hover {
            background-color: rgba(16, 185, 129, 0.1);
            border-color: #10b981;
        }

        .pub-link-pdf {
            background-color: #1a1a1a;
            border: 1px solid #262626;
            color: #ef4444;
        }

        .pub-link-pdf:hover {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: #ef4444;
        }

        /* Tags */
        .pub-tags-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .pub-tag-link {
            background-color: #1a1a1a;
            border: 1px solid #262626;
            color: #9ca3af;
            padding: 0.5rem 0.875rem;
            border-radius: 0.5rem;
            font-size: 0.8125rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }

        .pub-tag-link:hover {
            background-color: #262626;
            border-color: #2563eb;
            color: #2563eb;
        }

        /* Authors List */
        .pub-authors-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .pub-author-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #d1d5db;
            font-size: 0.875rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid #1a1a1a;
        }

        .pub-author-item:last-child {
            border-bottom: none;
        }

        .pub-author-item i {
            color: #6b7280;
        }

        /* Content Section */
        .pub-content-section {
            background-color: #0f0f0f;
            border: 1px solid #1a1a1a;
            border-radius: 0.75rem;
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .pub-section-title {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .pub-section-title i {
            color: #2563eb;
            font-size: 1.375rem;
        }

        .pub-content-text {
            color: #d1d5db;
            font-size: 0.9375rem;
            line-height: 1.8;
        }

        /* Share Buttons */
        .pub-share-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.625rem;
        }

        .pub-share-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            background-color: #1a1a1a;
            border: 1px solid #262626;
            color: #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s;
        }

        .pub-share-btn:hover {
            background-color: #262626;
            border-color: #374151;
            color: #ffffff;
        }

        /* Related Publications Section */
        .related-section {
            margin-top: 4rem;
            padding-top: 3rem;
            border-top: 1px solid #1a1a1a;
        }

        .section-title {
            color: #ffffff;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        /* Related Publication Card - Same as Index */
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

        @media (max-width: 991px) {
            .pub-detail-layout {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .pub-detail-sidebar {
                position: relative;
                top: 0;
            }

            .pub-detail-title {
                font-size: 2rem;
            }
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid px-0">
        <!-- Back Button -->
        <div class="pub-detail-back">
            <a href="{{ route('publication.index') }}" class="back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Back to Publications</span>
            </a>
        </div>
        <!-- Header -->
        <div class="pub-detail-header">
            <div class="pub-detail-meta">
                <div class="pub-detail-meta-item">
                    <i class="bi bi-calendar"></i>
                    <span>{{ $publication->formatted_date }}</span>
                </div>
                <span class="pub-detail-meta-divider">•</span>
                <div class="pub-detail-meta-item">
                    <i class="bi bi-clock"></i>
                    <span>{{ $publication->read_time }}</span>
                </div>
                <span class="pub-detail-meta-divider">•</span>
                <div class="pub-detail-meta-item">
                    <i class="bi bi-eye"></i>
                    <span>{{ $publication->views }} views</span>
                </div>
                @if ($publication->citation_count > 0)
                    <span class="pub-detail-meta-divider">•</span>
                    <div class="pub-detail-meta-item">
                        <i class="bi bi-quote"></i>
                        <span>{{ $publication->citation_count }} citations</span>
                    </div>
                @endif
            </div>
            <h1 class="pub-detail-title">{{ $publication->title }}</h1>
            @if ($publication->venue)
                <div class="pub-detail-venue">
                    <i class="bi bi-building"></i>
                    <span>Published in {{ $publication->venue }}</span>
                </div>
            @endif
            <div class="pub-detail-badges">
                <span class="pub-type-badge">
                    {{ ucfirst(str_replace('_', ' ', $publication->publication_type)) }}
                </span>
                @php
                    $statusClasses = [
                        'published' => 'status-published',
                        'accepted' => 'status-accepted',
                        'under_review' => 'status-under-review',
                        'preprint' => 'status-preprint',
                    ];
                @endphp
                <span class="status-badge-inline {{ $statusClasses[$publication->status] ?? 'status-preprint' }}">
                    {{ ucfirst(str_replace('_', ' ', $publication->status)) }}
                </span>
                @if ($publication->is_featured)
                    <span class="pub-featured-badge">
                        <i class="bi bi-star-fill"></i> Featured
                    </span>
                @endif
            </div>
        </div>
        <!-- Layout -->
        <div class="pub-detail-layout">
            <!-- Main Content -->
            <div class="pub-detail-main">
                <!-- Featured Image -->
                @if ($publication->featured_image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $publication->featured_image) }}" alt="{{ $publication->title }}"
                            class="blog-detail-featured-image">
                    </div>
                @endif
                <!-- Abstract -->
                <div class="pub-content-section">
                    <h2 class="pub-section-title">
                        <i class="bi bi-file-text"></i>
                        Abstract
                    </h2>
                    <div class="pub-content-text">
                        {!! $publication->abstract !!}
                    </div>
                </div>
                <!-- Full Content -->
                @if ($publication->content)
                    <div class="pub-content-section">
                        <h2 class="pub-section-title">
                            <i class="bi bi-article"></i>
                            Full Content
                        </h2>
                        <div class="pub-content-text">
                            {!! $publication->content !!}
                        </div>
                    </div>
                @endif
            </div>
            <!-- Sidebar -->
            <div class="pub-detail-sidebar">
                <!-- External Links -->
                @if ($publication->doi || $publication->url || $publication->pdf_url)
                    <div class="pub-sidebar-card">
                        <h3 class="pub-sidebar-title">
                            <i class="bi bi-link-45deg"></i>
                            External Links
                        </h3>
                        <div class="pub-links">
                            @if ($publication->doi)
                                <a href="{{ $publication->doi }}" target="_blank" class="pub-link-btn pub-link-doi">
                                    <i class="bi bi-fingerprint"></i>
                                    View DOI
                                </a>
                            @endif
                            @if ($publication->url)
                                <a href="{{ $publication->url }}" target="_blank" class="pub-link-btn pub-link-url">
                                    <i class="bi bi-globe"></i>
                                    View Publication
                                </a>
                            @endif
                            @if ($publication->pdf_url)
                                <a href="{{ $publication->pdf_url }}" target="_blank" class="pub-link-btn pub-link-pdf">
                                    <i class="bi bi-file-pdf"></i>
                                    Download PDF
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
                <!-- Authors -->
                <div class="pub-sidebar-card">
                    <h3 class="pub-sidebar-title">
                        <i class="bi bi-people"></i>
                        Authors
                    </h3>
                    <ul class="pub-authors-list">
                        @foreach ($publication->authors as $author)
                            <li class="pub-author-item">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ $author->name }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Tags -->
                @if ($publication->tags->count() > 0)
                    <div class="pub-sidebar-card">
                        <h3 class="pub-sidebar-title">
                            <i class="bi bi-tags"></i>
                            Tags
                        </h3>
                        <div class="pub-tags-list">
                            @foreach ($publication->tags as $tag)
                                <a href="{{ route('publication.index', ['tag' => $tag->slug]) }}" class="pub-tag-link">
                                    #{{ $tag->slug }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                <!-- Share -->
                <div class="pub-sidebar-card">
                    <h3 class="pub-sidebar-title">
                        <i class="bi bi-share"></i>
                        Share
                    </h3>
                    <div class="pub-share-buttons">
                        <a href="#" class="pub-share-btn"
                            onclick="shareOnTwitter('{{ $publication->title }}', '{{ route('publication.show', $publication->slug) }}'); return false;">
                            <i class="bi bi-twitter-x"></i>
                            Share on X
                        </a>
                        <a href="#" class="pub-share-btn"
                            onclick="shareOnLinkedIn('{{ route('publication.show', $publication->slug) }}'); return false;">
                            <i class="bi bi-linkedin"></i>
                            LinkedIn
                        </a>
                        <a href="#" class="pub-share-btn"
                            onclick="copyLink('{{ route('publication.show', $publication->slug) }}'); return false;">
                            <i class="bi bi-link-45deg"></i>
                            Copy Link
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Related Publications -->
        @if ($related->count() > 0)
            <section class="related-section">
                <h2 class="section-title">Related Publications</h2>
                <div class="row g-4">
                    @foreach ($related as $rel)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{ route('publication.show', $rel->slug) }}" class="publication-card">
                                <!-- Featured Badge -->
                                @if ($rel->is_featured)
                                    <span class="pub-featured-badge-corner">
                                        <i class="bi bi-star-fill"></i>
                                        Featured
                                    </span>
                                @endif

                                <!-- Image -->
                                @if ($rel->featured_image)
                                    <img src="{{ asset('storage/' . $rel->featured_image) }}" alt="{{ $rel->title }}"
                                        class="blog-image">
                                @endif

                                <!-- Content -->
                                <div class="publication-content">
                                    <!-- Tags -->
                                    <div class="blog-tags">
                                        @foreach ($rel->tags->take(2) as $tag)
                                            <span class="tag">#{{ $tag->slug }}</span>
                                        @endforeach
                                    </div>

                                    <!-- Title -->
                                    <h3 class="publication-title">{{ $rel->title }}</h3>

                                    <!-- Venue -->
                                    @if ($rel->venue)
                                        <div class="publication-venue">
                                            <i class="bi bi-building"></i>
                                            <span>{{ Str::limit($rel->venue, 40) }}</span>
                                        </div>
                                    @endif

                                    <!-- Abstract -->
                                    <p class="publication-abstract">
                                        {{ strip_tags($rel->short_abstract) }}
                                    </p>

                                    <!-- Meta -->
                                    <div class="publication-meta">
                                        <div class="publication-authors">
                                            <i class="bi bi-person"></i>
                                            <span>
                                                {{ $rel->authors->first()->name ?? 'Anonymous' }}
                                                @if ($rel->authors->count() > 1)
                                                    et al.
                                                @endif
                                            </span>
                                        </div>
                                        <span class="publication-year">{{ $rel->formatted_date }}</span>
                                    </div>
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
        function shareOnTwitter(title, url) {
            window.open(`https://twitter.com/intent/tweet?text=${encodeURIComponent(title)}&url=${encodeURIComponent(url)}`,
                '_blank');
        }

        function shareOnLinkedIn(url) {
            window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`, '_blank');
        }

        function copyLink(url) {
            navigator.clipboard.writeText(url).then(() => {
                alert('Link copied to clipboard!');
            });
        }
    </script>
@endpush
