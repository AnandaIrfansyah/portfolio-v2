@extends('layouts.app')
@section('title', 'Career Management')
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .section-card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .section-card-title {
            font-size: 1rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #6777ef;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tools-row {
            display: flex;
            gap: 0.75rem;
            align-items: center;
            margin-bottom: 0.75rem;
        }

        .tools-row input {
            flex: 1;
        }

        .tag-hint {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Career Management</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Career</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Manage Career Opportunities Page</h2>
                <p class="section-lead">Kelola informasi career dan open to work kamu.</p>

                <form id="careerForm">
                    @csrf

                    {{-- 1. CV & Status --}}
                    <div class="section-card">
                        <div class="section-card-title"><i class="bi bi-briefcase"></i> Status & Availability</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status">
                                        <option value="actively_looking"
                                            {{ $career?->status === 'actively_looking' ? 'selected' : '' }}>Actively Looking
                                        </option>
                                        <option value="open" {{ $career?->status === 'open' ? 'selected' : '' }}>Open to
                                            Opportunities</option>
                                        <option value="not_available"
                                            {{ $career?->status === 'not_available' ? 'selected' : '' }}>Not Available
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Availability</label>
                                    <input type="text" class="form-control" name="availability"
                                        value="{{ $career?->availability }}" placeholder="e.g. Within 1 month">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Employment Type</label>
                                    <input type="text" class="form-control" name="employment_type"
                                        value="{{ $career?->employment_type }}"
                                        placeholder="e.g. Full-time, Contract, Part-time">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Remote Work</label>
                                    <input type="text" class="form-control" name="remote_work"
                                        value="{{ $career?->remote_work }}" placeholder="e.g. Available">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Relocation</label>
                                    <input type="text" class="form-control" name="relocation"
                                        value="{{ $career?->relocation }}" placeholder="e.g. Open to Relocate">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Visible</label>
                                    <div class="custom-control custom-checkbox mt-2">
                                        <input type="checkbox" class="custom-control-input" id="is_visible"
                                            name="is_visible" {{ $career?->is_visible !== false ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="is_visible">Tampilkan halaman
                                            career</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 2. Preferred Roles & Skills --}}
                    <div class="section-card">
                        <div class="section-card-title"><i class="bi bi-stars"></i> Preferred Roles & Skills</div>
                        <div class="form-group">
                            <label>Preferred Roles</label>
                            <input type="text" class="form-control" name="preferred_roles"
                                value="{{ $career ? implode(', ', $career->preferred_roles ?? []) : '' }}"
                                placeholder="e.g. Full Stack Developer, Backend Engineer">
                            <small class="tag-hint">Pisahkan dengan koma</small>
                        </div>
                        <div class="form-group">
                            <label>Skills Highlight</label>
                            <input type="text" class="form-control" name="skills"
                                value="{{ $career ? implode(', ', $career->skills ?? []) : '' }}"
                                placeholder="e.g. Laravel, Vue.js, MySQL">
                            <small class="tag-hint">Pisahkan dengan koma</small>
                        </div>
                    </div>

                    {{-- 3. Professional Details --}}
                    <div class="section-card">
                        <div class="section-card-title"><i class="bi bi-person-badge"></i> Professional Details</div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Experience Level</label>
                                    <input type="text" class="form-control" name="experience_level"
                                        value="{{ $career?->experience_level }}" placeholder="e.g. Mid-Level (2-4 years)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Salary Expectation</label>
                                    <input type="text" class="form-control" name="salary_expectation"
                                        value="{{ $career?->salary_expectation }}"
                                        placeholder="e.g. Competitive / Negotiable">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Notice Period</label>
                                    <input type="text" class="form-control" name="notice_period"
                                        value="{{ $career?->notice_period }}" placeholder="e.g. 1 month">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Work Authorization</label>
                                    <input type="text" class="form-control" name="work_authorization"
                                        value="{{ $career?->work_authorization }}" placeholder="e.g. Indonesian Citizen">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 4. Languages & Preferences --}}
                    <div class="section-card">
                        <div class="section-card-title"><i class="bi bi-translate"></i> Languages & Preferences</div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Languages</label>
                                    <input type="text" class="form-control" name="languages"
                                        value="{{ $career?->languages }}"
                                        placeholder="e.g. Indonesian (Native), English (Professional)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Contact Preference</label>
                                    <input type="text" class="form-control" name="contact_preference"
                                        value="{{ $career?->contact_preference }}" placeholder="e.g. LinkedIn, Email">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Interview Availability</label>
                                    <input type="text" class="form-control" name="interview_availability"
                                        value="{{ $career?->interview_availability }}" placeholder="e.g. Flexible">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 5. Location Preferences --}}
                    <div class="section-card">
                        <div class="section-card-title"><i class="bi bi-geo-alt"></i> Location Preferences</div>
                        <div class="form-group">
                            <label>Work Arrangements</label>
                            <div class="d-flex gap-3 mt-1">
                                @foreach (['On-site', 'Hybrid', 'Remote'] as $arr)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="arr_{{ $arr }}"
                                            name="work_arrangements[]" value="{{ $arr }}"
                                            {{ in_array($arr, $career?->work_arrangements ?? []) ? 'checked' : '' }}>
                                        <label class="custom-control-label"
                                            for="arr_{{ $arr }}">{{ $arr }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label>On-site Locations</label>
                            <input type="text" class="form-control" name="onsite_locations"
                                value="{{ $career ? implode(', ', $career->onsite_locations ?? []) : '' }}"
                                placeholder="e.g. Jakarta Indonesia, Bandung Indonesia">
                            <small class="tag-hint">Pisahkan dengan koma</small>
                        </div>
                        <div class="form-group">
                            <label>Remote Locations</label>
                            <input type="text" class="form-control" name="remote_locations"
                                value="{{ $career ? implode(', ', $career->remote_locations ?? []) : '' }}"
                                placeholder="e.g. Indonesia, Malaysia, Singapore">
                            <small class="tag-hint">Pisahkan dengan koma</small>
                        </div>
                    </div>

                    {{-- 6. Tools & Technologies --}}
                    <div class="section-card">
                        <div class="section-card-title">
                            <i class="bi bi-tools"></i> Tools & Technologies
                            <button type="button" class="btn btn-sm btn-primary ml-auto" onclick="addToolRow()">
                                <i class="bi bi-plus"></i> Add Row
                            </button>
                        </div>
                        <div class="row mb-2">
                            <div class="col-4"><small class="text-muted font-weight-bold">CATEGORY</small></div>
                            <div class="col-7"><small class="text-muted font-weight-bold">TOOLS</small></div>
                        </div>
                        <div id="toolsContainer">
                            @if ($career && $career->tools_technologies)
                                @foreach ($career->tools_technologies as $tool)
                                    <div class="tools-row">
                                        <input type="text" class="form-control col-4" name="tools_category[]"
                                            value="{{ $tool['category'] }}" placeholder="e.g. Languages">
                                        <input type="text" class="form-control col-7" name="tools_list[]"
                                            value="{{ $tool['tools'] }}" placeholder="e.g. PHP, JavaScript, Python">
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="this.closest('.tools-row').remove()">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-primary px-4" onclick="saveCareer()">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000
        });

        function addToolRow() {
            const html = `
            <div class="tools-row">
                <input type="text" class="form-control col-4" name="tools_category[]" placeholder="e.g. Languages">
                <input type="text" class="form-control col-7" name="tools_list[]" placeholder="e.g. PHP, JavaScript">
                <button type="button" class="btn btn-danger btn-sm" onclick="this.closest('.tools-row').remove()">
                    <i class="bi bi-trash"></i>
                </button>
            </div>`;
            document.getElementById('toolsContainer').insertAdjacentHTML('beforeend', html);
        }

        function saveCareer() {
            const btn = event.target;
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Menyimpan...';

            const formData = new FormData(document.getElementById('careerForm'));

            fetch("{{ route('careers.store') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        Toast.fire({
                            icon: 'success',
                            title: data.message
                        });
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.message || 'Gagal menyimpan.'
                        });
                    }
                })
                .catch(() => Toast.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan.'
                }))
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="bi bi-save"></i> Simpan';
                });
        }
    </script>
@endpush
