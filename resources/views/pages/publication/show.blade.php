@extends('layouts.pages')

@section('title', 'Blog')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- Back Button -->
        <div class="blog-detail-back">
            <a href="blog.html" class="back-link">
                <i class="bi bi-arrow-left"></i>
                <span>Back to Blog</span>
            </a>
        </div>

        <!-- Blog Header Layout (2 Columns) -->
        <div class="blog-header-layout">
            <!-- Blog Header Main -->
            <section class="blog-detail-header blog-header-main">
                <div class="blog-detail-meta">
                    <div class="blog-detail-author">
                        <img src="img/hero.png" alt="Ananda Irfansyah" class="blog-detail-author-img">
                        <span class="blog-detail-author-name">
                            Ananda Irfansyah
                            <i class="bi bi-patch-check-fill"></i>
                        </span>
                    </div>
                    <span class="blog-detail-divider">•</span>
                    <span class="blog-detail-date">Mon June 30, 2025</span>
                    <span class="blog-detail-divider">•</span>
                    <span class="blog-detail-read-time">
                        <i class="bi bi-clock"></i>
                        5 min read
                    </span>
                </div>
                <h1 class="blog-detail-title">What Is an Exoplanet? – A Tale from Beyond Our Sky</h1>
                <p class="blog-detail-excerpt">
                    Once upon a time, in a corner of the universe lit by a humble yellow star, Earth's astronomers
                    gazed
                    up at the sky—and wondered: are we truly alone?
                </p>
            </section>

            <!-- Tags Section (Sidebar) -->
            <aside class="blog-header-sidebar">
                <div class="blog-tags-card">
                    <h3 class="blog-tags-title">Tags</h3>
                    <div class="blog-tags-list">
                        <a href="#" class="blog-tag-item">#astronomy</a>
                        <a href="#" class="blog-tag-item">#exoplanets</a>
                        <a href="#" class="blog-tag-item">#space-exploration</a>
                        <a href="#" class="blog-tag-item">#science-storytelling</a>
                    </div>
                </div>
            </aside>
        </div>

        <!-- Featured Image -->
        <img src="https://images.unsplash.com/photo-1614730321146-b6fa6a46bcb4?w=1200&h=600&fit=crop" alt="Exoplanet"
            class="blog-detail-featured-image">

        <!-- Blog Content Layout (2 Columns) -->
        <div class="blog-content-layout">
            <!-- Blog Content -->
            <article class="blog-detail-content">
                <p>Once upon a time, in a corner of the universe lit by a humble yellow star, Earth's astronomers
                    gazed up at the sky—and wondered: are we truly alone? As telescopes swept through the vast
                    cosmic ocean, they uncovered whispers of other worlds. Not within our Solar System, but far
                    beyond it, orbiting stars that also shine in the expanse of the cosmos. These distant and
                    mysterious realms came to be known as <strong>exoplanets</strong>—planets that exist beyond our
                    solar neighborhood.</p>

                <p>Some exoplanets are giant gas worlds, larger than Jupiter, shrouded in thick atmospheres and
                    raging storms. Others are small and rocky, like Earth, resting in what's known as the
                    <strong>habitable zone</strong>—where liquid water might flow across the surface. A few even
                    drift through the galaxy alone, without a star to orbit—solitary wanderers adrift in the dark.
                </p>

                <h2>The Hunt for Hidden Worlds</h2>

                <p>Scientists became <em>cosmic detectives</em>. By analyzing the faint flicker of starlight and
                    subtle wobbles in stellar motion, they began to catalogue these alien worlds—each discovery a
                    fresh clue, each orbit a puzzle. Over <strong>5,000 exoplanets</strong> have now been
                    confirmed—and that number keeps growing.</p>

                <p>And yet, beyond the numbers and diagrams, every exoplanet lights a spark that endures through
                    time: <em>human imagination</em>. Could there be life out there? Strange sunrises? Civilizations
                    gazing at their own stars, pondering the same questions?</p>

                <h2>A Universe Full of Stories</h2>

                <p>So, the next time night falls and you look up at the stars, remember—those glimmering dots may
                    cradle their own spinning worlds, filled with stories we've yet to read.</p>

                <blockquote>
                    "Somewhere, something incredible is waiting to be known." – Carl Sagan
                </blockquote>

                <p>The discovery of exoplanets has revolutionized our understanding of planetary systems. Here are
                    some fascinating facts:</p>

                <ul>
                    <li>The first confirmed exoplanet was discovered in 1992</li>
                    <li>Most exoplanets are discovered using the transit method</li>
                    <li>Some exoplanets orbit multiple stars (binary systems)</li>
                    <li>The closest known exoplanet is Proxima Centauri b, just 4.2 light-years away</li>
                </ul>

                <h3>The Search Continues</h3>

                <p>With missions like the James Webb Space Telescope and future observatories, we're on the brink of
                    analyzing exoplanet atmospheres in detail. Who knows what we'll discover next?</p>
            </article>

            <!-- Share Section (Sidebar) -->
            <aside class="blog-detail-share">
                <h3 class="blog-share-title">Share this article</h3>
                <div class="blog-share-buttons">
                    <a href="#" class="blog-share-btn" onclick="shareOnTwitter(); return false;">
                        <i class="bi bi-twitter-x"></i>
                        <span>Share on X</span>
                    </a>
                    <a href="#" class="blog-share-btn" onclick="shareOnLinkedIn(); return false;">
                        <i class="bi bi-linkedin"></i>
                        <span>LinkedIn</span>
                    </a>
                    <a href="#" class="blog-share-btn" onclick="shareOnFacebook(); return false;">
                        <i class="bi bi-facebook"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="#" class="blog-share-btn" onclick="copyLink(); return false;">
                        <i class="bi bi-link-45deg"></i>
                        <span>Copy Link</span>
                    </a>
                </div>
            </aside>
        </div>
    </div>
@endsection

@push('modal')
@endpush

@push('scripts')
@endpush
