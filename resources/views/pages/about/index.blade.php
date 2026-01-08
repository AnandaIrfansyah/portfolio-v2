@extends('layouts.pages')
@section('title', 'About')

@push('styles')
    <style>
        /* Tambahkan style jika diperlukan */
        .timeline-logo {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- About Header -->
        <section class="about-header">
            <h1 class="about-title">
                About <span class="highlight">Me</span>
            </h1>
            <p class="about-subtitle">
                Built on belief and shaped through code. This is the path I've taken, and the trace I continue leaving.
            </p>
        </section>

        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <a href="#intro" class="tab-item active" data-tab="intro">Intro</a>
            <a href="#experiences" class="tab-item" data-tab="experiences">Experiences</a>
            <a href="#educations" class="tab-item" data-tab="educations">Educations</a>
            <a href="#certifications" class="tab-item" data-tab="certifications">Certifications</a>
        </div>

        <!-- Intro Section -->
        <div class="content-section active" id="intro-section">
            @if ($intro)
                <!-- CV Download -->
                @if ($intro->cv_pdf_file || $intro->cv_word_url)
                    <div class="cv-section">
                        <div class="cv-header">
                            <i class="bi bi-file-earmark-text cv-icon"></i>
                            <h3 class="cv-title">Curriculum Vitae</h3>
                        </div>
                        <p class="cv-subtitle">Access my CV in different formats</p>
                        <div class="cv-note">
                            <i class="bi bi-info-circle"></i>
                            <span>View in PDF, Word format, or get the editable template</span>
                        </div>
                        <div class="cv-buttons">
                            @if ($intro->cv_pdf_file)
                                <a href="{{ asset('storage/' . $intro->cv_pdf_file) }}" class="btn btn-outline"
                                    target="_blank">
                                    <i class="bi bi-file-pdf"></i>
                                    <span>PDF</span>
                                </a>
                            @endif
                            @if ($intro->cv_word_url)
                                <a href="{{ $intro->cv_word_url }}" class="btn btn-outline" target="_blank">
                                    <i class="bi bi-file-word"></i>
                                    <span>Latest (Word)</span>
                                </a>
                            @endif
                            @if ($intro->cv_word_url)
                                <a href="#" class="btn btn-outline"
                                    onclick="makeGoogleDocsCopy('{{ $intro->cv_word_url }}'); return false;">
                                    <i class="bi bi-files"></i>
                                    <span>Make a Copy</span>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Introduction -->
                <div class="content-card">
                    @if ($intro->status === 'open_to_work')
                        <div class="status-tag">
                            <i class="bi bi-circle-fill"></i>
                            <span>Currently Open to Work</span>
                        </div>
                    @endif

                    {{-- Static Opening --}}
                    <h2 class="content-title">Assalamu'alaikum</h2>

                    {{-- Dynamic Bio Content --}}
                    <div class="bio-content">
                        {!! $intro->bio !!}
                    </div>

                    {{-- Static Closing --}}
                    <h3 class="content-closing">Wassalamu'alaikum!</h3>
                </div>
            @else
                <div class="content-card">
                    {{-- Static Opening tetap muncul meskipun belum ada data --}}
                    <h2 class="content-title">Assalamu'alaikum</h2>
                    <p class="text-muted">No introduction available yet.</p>
                    <h3 class="content-closing">Wassalamu'alaikum!</h3>
                </div>
            @endif
        </div>

        <!-- Experiences Section -->
        <div class="content-section" id="experiences-section" style="display: none;">
            @forelse($experiences as $experience)
                <div class="timeline-item">
                    <div class="timeline-header">
                        @if ($experience->company_logo)
                            <img src="{{ asset('storage/' . $experience->company_logo) }}"
                                alt="{{ $experience->company_name }}" class="timeline-logo">
                        @else
                            <div class="timeline-logo bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-building" style="font-size: 2rem;"></i>
                            </div>
                        @endif

                        <div class="timeline-info">
                            <div class="timeline-title">
                                {{ $experience->company_name }}
                                @if ($experience->company_url)
                                    <a href="{{ $experience->company_url }}" target="_blank">
                                        <i class="bi bi-box-arrow-up-right timeline-link"></i>
                                    </a>
                                @endif
                            </div>
                            <div class="timeline-location">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $experience->position_count }} position(s)</span>
                            </div>
                        </div>
                    </div>

                    @foreach ($experience->positions as $position)
                        <div class="timeline-role">
                            {{ $position->position_title }}
                            @if ($position->badge_type)
                                <span class="timeline-badge">
                                    <i class="bi bi-circle-fill"></i>
                                    {{ ucfirst($position->badge_type) }}
                                </span>
                            @endif
                        </div>

                        <div class="timeline-meta">
                            <span class="meta-item">
                                <i class="bi bi-calendar"></i>
                                {{ $position->formatted_date_range }}
                            </span>
                            <span class="meta-item">
                                <i class="bi bi-briefcase"></i>
                                {{ $position->getEmploymentTypeLabel() }}
                            </span>
                            <span class="meta-item">
                                <i class="bi bi-laptop"></i>
                                {{ $experience->getLocationTypeLabel() }} · {{ $experience->location }}
                            </span>
                        </div>

                        @if ($position->achievements->count() > 0)
                            <button class="achievements-toggle" onclick="toggleAchievements(this)">
                                <i class="bi bi-chevron-down"></i>
                                <span>Show Achievements</span>
                            </button>
                            <div class="achievements-list">
                                @foreach ($position->achievements as $achievement)
                                    <div class="achievement-item">{{ $achievement->achievement_text }}</div>
                                @endforeach
                            </div>
                        @endif

                        @if (!$loop->last)
                            <div class="timeline-divider"></div>
                        @endif
                    @endforeach
                </div>
            @empty
                <div class="content-card">
                    <p class="text-white text-center">No experiences added yet.</p>
                </div>
            @endforelse
        </div>

        <!-- Educations Section -->
        <div class="content-section" id="educations-section" style="display: none;">
            @forelse($educations as $education)
                <div class="timeline-item">
                    <div class="timeline-header">
                        @if ($education->institution_logo)
                            <div class="timeline-logo">
                                <img src="{{ asset('storage/' . $education->institution_logo) }}"
                                    alt="{{ $education->institution_name }}">
                            </div>
                        @else
                            <div class="timeline-logo bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-mortarboard" style="font-size: 2rem;"></i>
                            </div>
                        @endif

                        <div class="timeline-info">
                            <div class="timeline-title">{{ $education->field_of_study }} ({{ $education->degree }})</div>
                            <div class="timeline-company">{{ $education->institution_name }}</div>
                            <div class="timeline-location">
                                <i class="bi bi-geo-alt"></i>
                                <span>{{ $education->location }}</span>
                            </div>
                        </div>
                        <div class="timeline-date">{{ $education->formatted_date_range }}</div>
                    </div>

                    @if ($education->gpa)
                        <p class="mb-2" style="color: #9ca3af">
                            <i>GPA : {{ $education->gpa }}</i>
                        </p>
                    @endif

                    @if ($education->achievements->count() > 0)
                        <button class="achievements-toggle" onclick="toggleAchievements(this)">
                            <i class="bi bi-chevron-down"></i>
                            <span>Show Achievements</span>
                        </button>
                        <div class="achievements-list">
                            @foreach ($education->achievements as $achievement)
                                <div class="achievement-item">{{ $achievement->achievement_text }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="content-card ">
                    <p class="text-white text-center">No education records added yet.</p>
                </div>
            @endforelse
        </div>

        <!-- Certifications Section -->
        <div class="content-section" id="certifications-section" style="display: none;">
            @if ($linkedinCertUrl)
                <div class="cv-section">
                    <div class="cv-header">
                        <i class="bi bi-linkedin cv-icon"></i>
                        <h3 class="cv-title">View All {{ $certifications->count() }}+ Certifications</h3>
                    </div>
                    <p class="cv-subtitle">See my complete certification portfolio on LinkedIn</p>
                    <div class="cv-buttons">
                        <a href="{{ $linkedinCertUrl }}" class="btn btn-outline" target="_blank">
                            <i class="bi bi-box-arrow-up-right"></i>
                            <span>View on LinkedIn</span>
                        </a>
                    </div>
                </div>
            @endif

            @forelse($certifications as $certification)
                <div class="timeline-item">
                    <div class="timeline-header">
                        @if ($certification->organization_logo)
                            <img src="{{ asset('storage/' . $certification->organization_logo) }}"
                                alt="{{ $certification->issuing_organization }}" class="timeline-logo">
                        @else
                            <div class="timeline-logo bg-light d-flex align-items-center justify-content-center">
                                <i class="bi bi-award" style="font-size: 2rem;"></i>
                            </div>
                        @endif

                        <div class="timeline-info">
                            <div class="timeline-title">{{ $certification->title }}</div>
                            <div class="timeline-company">{{ $certification->issuing_organization }}</div>
                        </div>
                        <div class="timeline-date">{{ $certification->formatted_issue_date }}</div>
                    </div>

                    @if ($certification->achievements->count() > 0 || $certification->credential_url)
                        <div class="credential-actions">
                            @if ($certification->achievements->count() > 0)
                                <button class="achievements-toggle" onclick="toggleAchievements(this)">
                                    <i class="bi bi-chevron-down"></i>
                                    <span>Show Achievements</span>
                                </button>
                            @endif

                            @if ($certification->credential_url)
                                <a href="{{ $certification->credential_url }}"
                                    class="btn btn-outline achievements-toggle" target="_blank">
                                    <i class="bi bi-box-arrow-up-right"></i>
                                    <span>View Credential</span>
                                </a>
                            @endif
                        </div>
                    @endif

                    @if ($certification->achievements->count() > 0)
                        <div class="achievements-list">
                            @foreach ($certification->achievements as $achievement)
                                <div class="achievement-item">{{ $achievement->achievement_text }}</div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="content-card">
                    <p class="text-white text-center">No certifications added yet.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Tab switching
        document.querySelectorAll('.tab-item').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.preventDefault();
                // Remove active class from all tabs
                document.querySelectorAll('.tab-item').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.content-section').forEach(s => s.style.display = 'none');
                // Add active class to clicked tab
                this.classList.add('active');
                const targetId = this.getAttribute('data-tab') + '-section';
                document.getElementById(targetId).style.display = 'block';
            });
        });

        // Toggle achievements
        function toggleAchievements(button) {
            const achievementsList = button.nextElementSibling;
            const icon = button.querySelector('i');
            const text = button.querySelector('span');

            if (achievementsList.classList.contains('show')) {
                achievementsList.classList.remove('show');
                icon.classList.remove('bi-chevron-up');
                icon.classList.add('bi-chevron-down');
                text.textContent = 'Show Achievements';
            } else {
                achievementsList.classList.add('show');
                icon.classList.remove('bi-chevron-down');
                icon.classList.add('bi-chevron-up');
                text.textContent = 'Hide Achievements';
            }
        }

        // Make a copy of Google Docs
        function makeGoogleDocsCopy(url) {
            // Extract document ID from URL
            const patterns = [
                /\/document\/d\/([a-zA-Z0-9-_]+)/, // Standard format
                /\/file\/d\/([a-zA-Z0-9-_]+)/, // Google Drive format
                /id=([a-zA-Z0-9-_]+)/, // Query parameter format
            ];

            let documentId = null;

            for (let pattern of patterns) {
                const match = url.match(pattern);
                if (match) {
                    documentId = match[1];
                    break;
                }
            }

            if (documentId) {
                // Open "Make a copy" link in new tab
                const copyUrl = `https://docs.google.com/document/d/${documentId}/copy`;
                window.open(copyUrl, '_blank');
            } else {
                // Fallback: just open the original URL
                window.open(url, '_blank');
            }
        }

        // Copy link to clipboard (jika masih mau fitur ini)
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('CV link copied to clipboard!');
            }).catch(err => {
                console.error('Failed to copy:', err);
            });
        }
    </script>
@endpush
