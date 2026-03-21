@extends('layouts.pages')
@section('title', 'Career Opportunities')
@push('styles')
    <style>
        .career-header {
            padding: 2rem 0 0.5rem;
        }

        .career-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.5rem;
        }

        .career-subtitle {
            color: #9ca3af;
            font-size: 1rem;
        }

        .career-section {
            background: #0f0f0f;
            border: 1px solid #1a1a1a;
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1rem;
        }

        .career-section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 1.25rem;
        }

        .career-section-title i {
            color: #2563eb;
            font-size: 1.1rem;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.625rem 0;
            border-bottom: 1px solid #1a1a1a;
            font-size: 0.875rem;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            color: #9ca3af;
        }

        .info-value {
            color: #e5e7eb;
            font-weight: 500;
            text-align: right;
        }

        .info-value.highlight {
            color: #10b981;
        }

        .info-value.blue {
            color: #2563eb;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            background: #1a1a1a;
            border: 1px solid #262626;
            color: #e5e7eb;
            padding: 0.3rem 0.75rem;
            border-radius: 0.375rem;
            font-size: 0.8rem;
            font-weight: 500;
            margin: 0.2rem;
        }

        .tag-blue {
            background: rgba(37, 99, 235, 0.1);
            border-color: rgba(37, 99, 235, 0.3);
            color: #60a5fa;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.375rem 1rem;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .status-actively {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        .status-open {
            background: rgba(37, 99, 235, 0.1);
            color: #3b82f6;
            border: 1px solid rgba(37, 99, 235, 0.2);
        }

        .status-not {
            background: rgba(107, 114, 128, 0.1);
            color: #9ca3af;
            border: 1px solid rgba(107, 114, 128, 0.2);
        }

        .location-group {
            margin-bottom: 1rem;
        }

        .location-group:last-child {
            margin-bottom: 0;
        }

        .location-group-title {
            font-size: 0.8rem;
            font-weight: 600;
            color: #2563eb;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .tools-table {
            width: 100%;
            font-size: 0.875rem;
        }

        .tools-table tr {
            border-bottom: 1px solid #1a1a1a;
        }

        .tools-table tr:last-child {
            border-bottom: none;
        }

        .tools-table td {
            padding: 0.625rem 0;
            vertical-align: top;
        }

        .tools-table td:first-child {
            color: #9ca3af;
            width: 35%;
            padding-right: 1rem;
        }

        .tools-table td:last-child {
            color: #e5e7eb;
        }

        .cv-note {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            font-size: 0.8rem;
            margin-bottom: 1rem;
            padding: 0.5rem 0.75rem;
            background: #0a0a0a;
            border-radius: 0.5rem;
            border: 1px solid #1a1a1a;
        }

        .cv-note i {
            color: #2563eb;
        }

        .cv-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .empty-state {
            text-align: center;
            padding: 4rem 1rem;
            color: #6b7280;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
            display: block;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-0">

        @if (!$career)
            <section class="career-header">
                <h1 class="career-title">Career <span style="color:#2563eb">Opportunities</span></h1>
            </section>
            <div class="career-section">
                <div class="empty-state">
                    <i class="bi bi-briefcase"></i>
                    <p>No career information available yet.</p>
                </div>
            </div>
        @else
            {{-- Header --}}
            <section class="career-header">
                <h1 class="career-title">Career <span style="color:#2563eb">Opportunities</span></h1>
                <p class="career-subtitle">Currently open to new opportunities and exciting challenges.</p>
            </section>

            {{-- 1. CV & Status --}}
            <div class="career-section">
                @php
                    $statusClass = match ($career->status) {
                        'actively_looking' => 'status-actively',
                        'open' => 'status-open',
                        default => 'status-not',
                    };
                @endphp
                <div class="career-section-title d-flex align-items-center">
                    <div>
                        <i class="bi bi-file-earmark-text"></i> Curriculum Vitae
                    </div>

                    <span class="status-badge {{ $statusClass }} ms-auto">
                        <i class="bi bi-circle-fill" style="font-size:0.4rem"></i>
                        {{ $career->status_label }}
                    </span>
                </div>

                @if ($intro && ($intro->cv_pdf_file || $intro->cv_word_url))
                    <div class="cv-note">
                        <i class="bi bi-info-circle"></i>
                        <span>Access my CV in different formats</span>
                    </div>
                    <div class="cv-buttons">
                        @if ($intro->cv_pdf_file)
                            <a href="{{ asset('storage/' . $intro->cv_pdf_file) }}" class="btn btn-outline" target="_blank">
                                <i class="bi bi-file-pdf"></i> PDF
                            </a>
                        @endif
                        @if ($intro->cv_word_url)
                            <a href="{{ $intro->cv_word_url }}" class="btn btn-outline" target="_blank">
                                <i class="bi bi-file-word"></i> Word
                            </a>
                        @endif
                    </div>
                @else
                    <p class="text-muted small">No CV available yet.</p>
                @endif
            </div>

            {{-- 2. Status & Availability --}}
            @if ($career->availability || $career->employment_type || $career->remote_work || $career->relocation)
                <div class="career-section">
                    <div class="career-section-title"><i class="bi bi-calendar-check"></i> Status & Availability</div>
                    @if ($career->availability)
                        <div class="info-row">
                            <span class="info-label">Availability</span>
                            <span class="info-value">{{ $career->availability }}</span>
                        </div>
                    @endif
                    @if ($career->employment_type)
                        <div class="info-row">
                            <span class="info-label">Employment Type</span>
                            <span class="info-value">{{ $career->employment_type }}</span>
                        </div>
                    @endif
                    @if ($career->remote_work)
                        <div class="info-row">
                            <span class="info-label">Remote Work</span>
                            <span class="info-value highlight">{{ $career->remote_work }}</span>
                        </div>
                    @endif
                    @if ($career->relocation)
                        <div class="info-row">
                            <span class="info-label">Relocation</span>
                            <span class="info-value blue">{{ $career->relocation }}</span>
                        </div>
                    @endif
                </div>
            @endif

            {{-- 3. Preferred Roles --}}
            @if ($career->preferred_roles && count($career->preferred_roles) > 0)
                <div class="career-section">
                    <div class="career-section-title"><i class="bi bi-stars"></i> Preferred Roles</div>
                    <div>
                        @foreach ($career->preferred_roles as $role)
                            <span class="tag tag-blue">{{ trim($role) }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- 4. Skills Highlight --}}
            @if ($career->skills && count($career->skills) > 0)
                <div class="career-section">
                    <div class="career-section-title"><i class="bi bi-lightning-charge"></i> Skills Highlight</div>
                    <div>
                        @foreach ($career->skills as $skill)
                            <span class="tag">{{ trim($skill) }}</span>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- 5. Professional Details --}}
            @if ($career->experience_level || $career->salary_expectation || $career->notice_period || $career->work_authorization)
                <div class="career-section">
                    <div class="career-section-title"><i class="bi bi-person-badge"></i> Professional Details</div>
                    @if ($career->experience_level)
                        <div class="info-row">
                            <span class="info-label">Experience Level</span>
                            <span class="info-value">{{ $career->experience_level }}</span>
                        </div>
                    @endif
                    @if ($career->salary_expectation)
                        <div class="info-row">
                            <span class="info-label">Salary Expectation</span>
                            <span class="info-value">{{ $career->salary_expectation }}</span>
                        </div>
                    @endif
                    @if ($career->notice_period)
                        <div class="info-row">
                            <span class="info-label">Notice Period</span>
                            <span class="info-value">{{ $career->notice_period }}</span>
                        </div>
                    @endif
                    @if ($career->work_authorization)
                        <div class="info-row">
                            <span class="info-label">Work Authorization</span>
                            <span class="info-value">{{ $career->work_authorization }}</span>
                        </div>
                    @endif
                </div>
            @endif

            {{-- 6. Languages & Preferences --}}
            @if ($career->languages || $career->contact_preference || $career->interview_availability)
                <div class="career-section">
                    <div class="career-section-title"><i class="bi bi-translate"></i> Languages & Preferences</div>
                    @if ($career->languages)
                        <div class="info-row">
                            <span class="info-label">Languages</span>
                            <span class="info-value">{{ $career->languages }}</span>
                        </div>
                    @endif
                    @if ($career->contact_preference)
                        <div class="info-row">
                            <span class="info-label">Contact Preference</span>
                            <span class="info-value">{{ $career->contact_preference }}</span>
                        </div>
                    @endif
                    @if ($career->interview_availability)
                        <div class="info-row">
                            <span class="info-label">Interview Availability</span>
                            <span class="info-value">{{ $career->interview_availability }}</span>
                        </div>
                    @endif
                </div>
            @endif

            {{-- 7. Location Preferences --}}
            @if (
                ($career->work_arrangements && count($career->work_arrangements) > 0) ||
                    ($career->onsite_locations && count($career->onsite_locations) > 0) ||
                    ($career->remote_locations && count($career->remote_locations) > 0))
                <div class="career-section">
                    <div class="career-section-title"><i class="bi bi-geo-alt"></i> Location Preferences</div>
                    @if ($career->work_arrangements && count($career->work_arrangements) > 0)
                        <div class="location-group">
                            <div class="location-group-title">Work Arrangements</div>
                            @foreach ($career->work_arrangements as $arr)
                                <span class="tag">{{ $arr }}</span>
                            @endforeach
                        </div>
                    @endif
                    @if ($career->onsite_locations && count($career->onsite_locations) > 0)
                        <div class="location-group">
                            <div class="location-group-title">On-site Locations</div>
                            @foreach ($career->onsite_locations as $loc)
                                <span class="tag">{{ trim($loc) }}</span>
                            @endforeach
                        </div>
                    @endif
                    @if ($career->remote_locations && count($career->remote_locations) > 0)
                        <div class="location-group">
                            <div class="location-group-title">Remote Locations</div>
                            @foreach ($career->remote_locations as $loc)
                                <span class="tag">{{ trim($loc) }}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            {{-- 8. Tools & Technologies --}}
            @if ($career->tools_technologies && count($career->tools_technologies) > 0)
                <div class="career-section">
                    <div class="career-section-title"><i class="bi bi-tools"></i> Tools & Technologies</div>
                    <table class="tools-table">
                        <tbody>
                            @foreach ($career->tools_technologies as $tool)
                                <tr>
                                    <td>{{ $tool['category'] }}</td>
                                    <td>{{ $tool['tools'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        @endif
    </div>
@endsection
