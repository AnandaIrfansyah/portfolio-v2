@extends('layouts.app')
@section('title', 'About Management')
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .status-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .timeline-item {
            display: flex;
            align-items: start;
            gap: 1rem;
            padding: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            background: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .timeline-item:hover {
            background:
                #f8f9fa;
            border-color:
                #adb5bd;
        }

        .timeline-logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
            border-radius: 0.375rem;
            border: 1px solid #dee2e6;
            padding: 0.25rem;
        }

        .timeline-content {
            flex: 1;
        }

        .timeline-actions {
            display: flex;
            gap: 0.5rem;
        }

        .position-item {
            padding: 0.75rem;
            background:
                #f8f9fa;
            border-left: 3px solid #6777ef;
            margin-bottom: 0.75rem;
            border-radius: 0.25rem;
        }

        .achievement-item {
            display: flex;
            align-items: start;
            gap: 0.5rem;
            padding: 0.5rem;
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            margin-bottom: 0.5rem;
        }

        .achievement-item:hover {
            background:
                #f8f9fa;
        }

        .achievement-text {
            flex: 1;
            font-size: 0.9rem;
        }

        .modal-xl {
            max-width: 1000px;
        }

        /* CV Section Styling */
        .cv-preview {
            max-width: 200px;
            padding: 1rem;
            border: 2px dashed #dee2e6;
            border-radius: 0.375rem;
            text-align: center;
            background:
                #f8f9fa;
        }

        .cv-preview i {
            font-size: 3rem;
            color:
                #6777ef;
        }

        .copy-btn {
            cursor: pointer;
        }

        .copy-btn:hover {
            background:
                #6777ef;
            color: white;
        }

        /* Tab Navigation */
        .nav-tabs .nav-link {
            color:
                #6c757d;
            border: none;
            border-bottom: 3px solid transparent;
            padding: 0.75rem 1.5rem;
        }

        .nav-tabs .nav-link:hover {
            border-bottom-color:
                #6777ef;
            color:
                #6777ef;
        }

        .nav-tabs .nav-link.active {
            color:
                #6777ef;
            border-bottom-color:
                #6777ef;
            background: transparent;
            font-weight: 600;
        }

        /* Input Achievement Dynamic */
        .achievement-input-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.75rem;
        }

        .achievement-input-item textarea {
            flex: 1;
            min-height: 60px;
        }

        /* Position Input Dynamic */
        .position-input-item {
            padding: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            background:
                #f8f9fa;
        }

        .position-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #6777ef;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            {{-- Page Header --}}
            <div class="section-header">
                <h1>About Management</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="#">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">About</div>
                </div>
            </div>
            <div class="section-body">
                {{-- Title --}}
                <h2 class="section-title">Manage About Page Content</h2>
                <p class="section-lead">Kelola intro, pengalaman, pendidikan, dan sertifikat kamu.</p>
                {{-- CARD --}}
                <div class="card">
                    <div class="card-body">
                        {{-- TABS NAVIGATION --}}
                        <ul class="nav nav-tabs" id="aboutTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="intro-tab" data-toggle="tab" href="#intro-section"
                                    role="tab">
                                    <i class="bi bi-file-earmark-text"></i> Intro & CV
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="experiences-tab" data-toggle="tab" href="#experiences-section"
                                    role="tab">
                                    <i class="bi bi-briefcase"></i> Experiences
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="educations-tab" data-toggle="tab" href="#educations-section"
                                    role="tab">
                                    <i class="bi bi-mortarboard"></i> Educations
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="certifications-tab" data-toggle="tab" href="#certifications-section"
                                    role="tab">
                                    <i class="bi bi-award"></i> Certifications
                                </a>
                            </li>
                        </ul>
                        {{-- TABS CONTENT --}}
                        <div class="tab-content mt-4" id="aboutTabsContent">
                            {{-- TAB 1: INTRO & CV --}}
                            <div class="tab-pane fade show active" id="intro-section" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Intro & Curriculum Vitae</h5>
                                    <button class="btn btn-primary" onclick="loadIntro()">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>
                                </div>
                                <div id="introContent">
                                    <div class="text-center py-5">
                                        <i class="bi bi-info-circle" style="font-size: 3rem; color:#6c757d;"></i>
                                        <p class="mt-3 text-muted">Belum ada data intro. Klik "Edit" untuk menambahkan.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            {{-- TAB 2: EXPERIENCES --}}
                            <div class="tab-pane fade" id="experiences-section" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Work Experiences</h5>
                                    <button class="btn btn-primary" onclick="openExperienceModal()">
                                        <i class="bi bi-plus-lg"></i> Tambah Experience
                                    </button>
                                </div>
                                <div id="experiencesList">
                                    <div class="text-center py-5">
                                        <i class="bi bi-hourglass-split" style="font-size: 3rem; color:#6c757d;"></i>
                                        <p class="mt-3 text-muted">Loading...</p>
                                    </div>
                                </div>
                            </div>
                            {{-- TAB 3: EDUCATIONS --}}
                            <div class="tab-pane fade" id="educations-section" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Educational Background</h5>
                                    <button class="btn btn-primary" onclick="openEducationModal()">
                                        <i class="bi bi-plus-lg"></i> Tambah Education
                                    </button>
                                </div>
                                <div id="educationsList">
                                    <div class="text-center py-5">
                                        <i class="bi bi-hourglass-split" style="font-size: 3rem; color:#6c757d;"></i>
                                        <p class="mt-3 text-muted">Loading...</p>
                                    </div>
                                </div>
                            </div>
                            {{-- TAB 4: CERTIFICATIONS --}}
                            <div class="tab-pane fade" id="certifications-section" role="tabpanel">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Certifications & Licenses</h5>
                                    <button class="btn btn-primary" onclick="openCertificationModal()">
                                        <i class="bi bi-plus-lg"></i> Tambah Certification
                                    </button>
                                </div>
                                <div id="certificationsList">
                                    <div class="text-center py-5">
                                        <i class="bi bi-hourglass-split" style="font-size: 3rem; color:#6c757d;"></i>
                                        <p class="mt-3 text-muted">Loading...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
{{-- ====================== MODALS ====================== --}}
@push('modal')
    {{-- MODAL INTRO & CV --}}
    <div class="modal fade" id="intro-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-file-earmark-text"></i> Edit Intro & CV
                    </h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="introForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        {{-- Bio --}}
                        <div class="form-group">
                            <label>Bio <span class="text-danger">*</span></label>
                            <textarea id="intro_bio" class="form-control summernote-simple" rows="10"
                                placeholder="Tulis bio lengkap kamu..."></textarea>
                            <span class="text-danger error_bio"></span>
                        </div>
                        {{-- Status --}}
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select id="intro_status" class="form-control">
                                <option value="open_to_work">Open to Work</option>
                                <option value="not_available">Not Available</option>
                            </select>
                            <span class="text-danger error_status"></span>
                        </div>
                        <hr>
                        <h6 class="mb-3"><i class="bi bi-file-pdf"></i> Curriculum Vitae</h6>
                        <div class="row">
                            {{-- CV PDF --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload CV (PDF)</label>
                                    <input type="file" id="intro_cv_pdf" class="form-control"
                                        accept="application/pdf">
                                    <span class="text-danger error_cv_pdf_file"></span>
                                    <small class="text-muted">Max 5MB</small>
                                    <div id="pdfPreview" class="mt-2"></div>
                                </div>
                            </div>
                            {{-- CV Word URL --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>CV Google Docs URL</label>
                                    <div class="input-group">
                                        <input type="url" id="intro_cv_word_url" class="form-control"
                                            placeholder="https://docs.google.com/...">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary copy-btn" type="button"
                                                onclick="copyToClipboard('#intro_cv_word_url')">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <span class="text-danger error_cv_word_url"></span>
                                    <small class="text-muted">Link Google Docs untuk CV versi Word</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="saveIntroBtn">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL EXPERIENCE --}}
    <div class="modal fade" id="experience-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="experienceForm" enctype="multipart/form-data">
                    <input type="hidden" id="experience_id">
                    <input type="hidden" id="experience_type">
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Company Name --}}
                                <div class="form-group">
                                    <label>Company Name <span class="text-danger">*</span></label>
                                    <input type="text" id="exp_company_name" class="form-control"
                                        placeholder="Contoh: Copilot ID">
                                    <span class="text-danger error_company_name"></span>
                                </div>
                                {{-- Company Logo --}}
                                <div class="form-group">
                                    <label>Company Logo</label>
                                    <input type="file" id="exp_company_logo" class="form-control" accept="image/*">
                                    <span class="text-danger error_company_logo"></span>
                                    <small class="text-muted">Max 2MB (JPEG, PNG, JPG, WEBP)</small>
                                    <div id="expLogoPreview" class="mt-2"></div>
                                </div>
                                {{-- Company URL --}}
                                <div class="form-group">
                                    <label>Company URL</label>
                                    <input type="url" id="exp_company_url" class="form-control"
                                        placeholder="https://example.com">
                                    <span class="text-danger error_company_url"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Location --}}
                                <div class="form-group">
                                    <label>Location <span class="text-danger">*</span></label>
                                    <input type="text" id="exp_location" class="form-control"
                                        placeholder="Contoh: Boyolali, Indonesia">
                                    <span class="text-danger error_location"></span>
                                </div>
                                {{-- Location Type --}}
                                <div class="form-group">
                                    <label>Location Type <span class="text-danger">*</span></label>
                                    <select id="exp_location_type" class="form-control">
                                        <option value="">Pilih Tipe</option>
                                        <option value="on_site">On-site</option>
                                        <option value="remote">Remote</option>
                                        <option value="hybrid">Hybrid</option>
                                    </select>
                                    <span class="text-danger error_location_type"></span>
                                </div>
                                {{-- Order & Visibility --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order</label>
                                            <input type="number" id="exp_order" class="form-control" value="0"
                                                min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="exp_is_visible"
                                                    checked>
                                                <label class="custom-control-label" for="exp_is_visible">
                                                    Visible
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- POSITIONS SECTION --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6><i class="bi bi-person-badge"></i> Positions</h6>
                            <button type="button" class="btn btn-sm btn-primary" onclick="addPosition()">
                                <i class="bi bi-plus-lg"></i> Add Position
                            </button>
                        </div>
                        <span class="text-danger error_positions"></span>
                        <div id="positionsList"></div>
                    </div>
                </form>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="saveExperienceBtn">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL EDUCATION --}}
    <div class="modal fade" id="education-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="educationForm" enctype="multipart/form-data">
                    <input type="hidden" id="education_id">
                    <input type="hidden" id="education_type">
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Institution Name --}}
                                <div class="form-group">
                                    <label>Institution Name <span class="text-danger">*</span></label>
                                    <input type="text" id="edu_institution_name" class="form-control"
                                        placeholder="Contoh: Universitas Teknologi Yogyakarta">
                                    <span class="text-danger error_institution_name"></span>
                                </div>
                                {{-- Institution Logo --}}
                                <div class="form-group">
                                    <label>Institution Logo</label>
                                    <input type="file" id="edu_institution_logo" class="form-control"
                                        accept="image/*">
                                    <span class="text-danger error_institution_logo"></span>
                                    <small class="text-muted">Max 2MB (JPEG, PNG, JPG, WEBP)</small>
                                    <div id="eduLogoPreview" class="mt-2"></div>
                                </div>
                                {{-- Degree --}}
                                <div class="form-group">
                                    <label>Degree <span class="text-danger">*</span></label>
                                    <input type="text" id="edu_degree" class="form-control"
                                        placeholder="Contoh: S.Kom.">
                                    <span class="text-danger error_degree"></span>
                                </div>
                                {{-- Field of Study --}}
                                <div class="form-group">
                                    <label>Field of Study <span class="text-danger">*</span></label>
                                    <input type="text" id="edu_field_of_study" class="form-control"
                                        placeholder="Contoh: Informatics in Intelligence Systems">
                                    <span class="text-danger error_field_of_study"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Location --}}
                                <div class="form-group">
                                    <label>Location <span class="text-danger">*</span></label>
                                    <input type="text" id="edu_location" class="form-control"
                                        placeholder="Contoh: Sleman, Yogyakarta">
                                    <span class="text-danger error_location"></span>
                                </div>
                                {{-- Dates --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Start Date <span class="text-danger">*</span></label>
                                            <input type="date" id="edu_start_date" class="form-control">
                                            <span class="text-danger error_start_date"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <input type="date" id="edu_end_date" class="form-control">
                                            <span class="text-danger error_end_date"></span>
                                        </div>
                                    </div>
                                </div>
                                {{-- GPA --}}
                                <div class="form-group">
                                    <label>GPA</label>
                                    <input type="text" id="edu_gpa" class="form-control"
                                        placeholder="Contoh: 3.58">
                                    <span class="text-danger error_gpa"></span>
                                </div>
                                {{-- Order & Visibility --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order</label>
                                            <input type="number" id="edu_order" class="form-control" value="0"
                                                min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="edu_is_visible"
                                                    checked>
                                                <label class="custom-control-label" for="edu_is_visible">
                                                    Visible
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- ACHIEVEMENTS SECTION --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6><i class="bi bi-star"></i> Achievements</h6>
                            <button type="button" class="btn btn-sm btn-primary" onclick="addEducationAchievement()">
                                <i class="bi bi-plus-lg"></i> Add Achievement
                            </button>
                        </div>
                        <div id="eduAchievementsList"></div>
                    </div>
                </form>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="saveEducationBtn">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL CERTIFICATION --}}
    <div class="modal fade" id="certification-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="certificationForm" enctype="multipart/form-data">
                    <input type="hidden" id="certification_id">
                    <input type="hidden" id="certification_type">
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        <div class="row">
                            <div class="col-md-6">
                                {{-- Title --}}
                                <div class="form-group">
                                    <label>Certificate Title <span class="text-danger">*</span></label>
                                    <input type="text" id="cert_title" class="form-control"
                                        placeholder="Contoh: Machine Learning Professional">
                                    <span class="text-danger error_title"></span>
                                </div>
                                {{-- Issuing Organization --}}
                                <div class="form-group">
                                    <label>Issuing Organization <span class="text-danger">*</span></label>
                                    <input type="text" id="cert_issuing_organization" class="form-control"
                                        placeholder="Contoh: Dicoding Indonesia">
                                    <span class="text-danger error_issuing_organization"></span>
                                </div>
                                {{-- Organization Logo --}}
                                <div class="form-group">
                                    <label>Organization Logo</label>
                                    <input type="file" id="cert_organization_logo" class="form-control"
                                        accept="image/*">
                                    <span class="text-danger error_organization_logo"></span>
                                    <small class="text-muted">Max 2MB (JPEG, PNG, JPG, WEBP)</small>
                                    <div id="certLogoPreview" class="mt-2"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- Issue Date --}}
                                <div class="form-group">
                                    <label>Issue Date <span class="text-danger">*</span></label>
                                    <input type="date" id="cert_issue_date" class="form-control">
                                    <span class="text-danger error_issue_date"></span>
                                </div>
                                {{-- Credential URL --}}
                                <div class="form-group">
                                    <label>Credential URL</label>
                                    <input type="url" id="cert_credential_url" class="form-control"
                                        placeholder="https://credential.example.com/...">
                                    <span class="text-danger error_credential_url"></span>
                                </div>
                                {{-- LinkedIn Certifications URL --}}
                                <div class="form-group">
                                    <label>LinkedIn All Certifications URL</label>
                                    <input type="url" id="cert_linkedin_url" class="form-control"
                                        placeholder="https://linkedin.com/in/yourprofile/details/certifications">
                                    <span class="text-danger error_linkedin_certifications_url"></span>
                                    <small class="text-muted">Link ke halaman semua sertifikat di LinkedIn</small>
                                </div>
                                {{-- Order & Visibility --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Order</label>
                                            <input type="number" id="cert_order" class="form-control" value="0"
                                                min="0">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="cert_is_visible"
                                                    checked>
                                                <label class="custom-control-label" for="cert_is_visible">
                                                    Visible
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- ACHIEVEMENTS SECTION --}}
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6><i class="bi bi-star"></i> Achievements</h6>
                            <button type="button" class="btn btn-sm btn-primary"
                                onclick="addCertificationAchievement()">
                                <i class="bi bi-plus-lg"></i> Add Achievement
                            </button>
                        </div>
                        <div id="certAchievementsList"></div>
                    </div>
                </form>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="saveCertificationBtn">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000
        });
        const BASE_URL = "{{ route('abouts.index') }}";
        // ====================== TAB SWITCHING ======================
        $(document).ready(function() {
            // Load experiences when tab is shown
            $('#experiences-tab').on('shown.bs.tab', function() {
                loadExperiences();
            });
            // Load educations when tab is shown
            $('#educations-tab').on('shown.bs.tab', function() {
                loadEducations();
            });
            // Load certifications when tab is shown
            $('#certifications-tab').on('shown.bs.tab', function() {
                loadCertifications();
            });
            // Load intro on page load
            loadIntroDisplay();
        });
        // ====================== INTRO & CV FUNCTIONS ======================
        function loadIntroDisplay() {
            $.ajax({
                url: "{{ route('abouts.intro.show') }}",
                method: "GET",
                success: function(resp) {
                    // Jika data belum ada / status false
                    if (!resp.status) {
                        $("#introContent").html(`
                    <div class="text-center py-5">
                        <i class="bi bi-info-circle" style="font-size: 3rem; color: #6c757d;"></i>
                        <p class="mt-3 text-muted">Belum ada data intro. Klik "Edit" untuk menambahkan.</p>
                    </div>
                `);
                        return;
                    }

                    // Jika data ada
                    let d = resp.data;
                    let statusBadge = d.status === 'open_to_work' ?
                        '<span class="badge badge-success">Open to Work</span>' :
                        '<span class="badge badge-secondary">Not Available</span>';

                    let html = `
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <strong>Status:</strong> ${statusBadge}
                        </div>
                        <div class="mb-3">
                            <strong>Bio:</strong>
                            <div class="mt-2">
                                ${d.bio || '<span class="text-muted">No bio available</span>'}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <strong><i class="bi bi-file-pdf"></i> CV PDF:</strong>
                                ${d.cv_pdf_file ?
                                    `<div class="mt-2">
                                                                                                                <a href="/storage/${d.cv_pdf_file}" target="_blank" class="btn btn-sm btn-outline-danger">
                                                                                                                    <i class="bi bi-download"></i> Download PDF
                                                                                                                </a>
                                                                                                            </div>` :
                                    '<p class="text-muted mt-2">No PDF uploaded</p>'
                                }
                            </div>
                            <div class="col-md-6">
                                <strong><i class="bi bi-file-word"></i> CV Google Docs:</strong>
                                ${d.cv_word_url ?
                                    `<div class="mt-2">
                                                                                                                <a href="${d.cv_word_url}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                                                                    <i class="bi bi-box-arrow-up-right"></i> Open Google Docs
                                                                                                                </a>
                                                                                                            </div>` :
                                    '<p class="text-muted mt-2">No Google Docs URL</p>'
                                }
                            </div>
                        </div>
                    </div>
                </div>`;

                    $("#introContent").html(html);
                },
                error: function() {
                    $("#introContent").html(`
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle"></i> Gagal memuat data intro.
                </div>
            `);
                }
            });
        }

        function loadIntro() {
            $.ajax({
                url: "{{ route('abouts.intro.show') }}",
                method: "GET",
                success: function(resp) {
                    if (resp.status) {
                        let d = resp.data;
                        // Set value ke input form
                        $("#intro_bio").summernote('code', d.bio || '');
                        $("#intro_status").val(d.status);
                        $("#intro_cv_word_url").val(d.cv_word_url || '');

                        // Tampilkan preview PDF jika ada
                        if (d.cv_pdf_file) {
                            $("#pdfPreview").html(`
                        <div class="cv-preview">
                            <i class="bi bi-file-pdf" style="font-size: 2rem;"></i>
                            <p class="mb-0 mt-2"><small>Current PDF</small></p>
                            <a href="/storage/${d.cv_pdf_file}" target="_blank" class="btn btn-sm btn-outline-danger mt-2">
                                <i class="bi bi-eye" style="font-size: 1rem;"></i> View
                            </a>
                        </div>
                    `);
                        } else {
                            $("#pdfPreview").html('');
                        }
                    } else {
                        // Jika data belum ada (New Intro)
                        $("#intro_bio").summernote('code', '');
                        $("#intro_status").val('open_to_work');
                        $("#intro_cv_word_url").val('');
                        $("#pdfPreview").html('');
                    }
                    // Tampilkan Modal
                    $("#intro-modal").modal("show");
                },
                error: function() {
                    Toast.fire({
                        icon: "error",
                        title: "Gagal memuat data intro"
                    });
                }
            });
        }

        // Event Listener untuk Tombol Simpan
        $("#saveIntroBtn").click(function() {
            // Disable tombol biar gak diklik double
            let btn = $(this);
            btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Menyimpan...');

            let formData = new FormData();
            formData.append('bio', $("#intro_bio").val());
            formData.append('status', $("#intro_status").val());
            formData.append('cv_word_url', $("#intro_cv_word_url").val());

            // Cek apakah ada file PDF yang diupload
            if ($("#intro_cv_pdf")[0].files[0]) {
                formData.append('cv_pdf_file', $("#intro_cv_pdf")[0].files[0]);
            }

            formData.append('_token', "{{ csrf_token() }}");

            $.ajax({
                url: "{{ route('abouts.intro.update') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) {
                    $("#intro-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    loadIntroDisplay(); // Refresh tampilan depan
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showErrors(xhr.responseJSON.errors, 'intro');
                        Toast.fire({
                            icon: "error",
                            title: "Periksa input kamu."
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: xhr.responseJSON?.message || "Terjadi kesalahan"
                        });
                    }
                },
                complete: function() {
                    // Kembalikan tombol seperti semula
                    btn.prop('disabled', false).html('<i class="bi bi-save"></i> Simpan');
                }
            });
        });

        // Fungsi Copy Clipboard
        function copyToClipboard(selector) {
            let text = $(selector).val();
            if (text) {
                navigator.clipboard.writeText(text).then(() => {
                    Toast.fire({
                        icon: "success",
                        title: "Link copied to clipboard!"
                    });
                }).catch(err => {
                    // Fallback jika browser memblokir
                    Toast.fire({
                        icon: "error",
                        title: "Gagal menyalin link"
                    });
                });
            } else {
                Toast.fire({
                    icon: "error",
                    title: "No URL to copy"
                });
            }
        }

        // ====================== EXPERIENCE FUNCTIONS ======================

        let positionCounter = 0;
        let achievementCounter = {};

        function loadExperiences() {
            // Tampilkan Loading
            $("#experiencesList").html(`
        <div class="text-center py-5">
            <i class="bi bi-hourglass-split" style="font-size: 3rem; color: #6c757d;"></i>
            <p class="mt-3 text-muted">Loading...</p>
        </div>
    `);

            $.ajax({
                url: "{{ route('abouts.experiences.list') }}",
                method: "GET",
                success: function(resp) {
                    // Jika data kosong
                    if (resp.data.length === 0) {
                        $("#experiencesList").html(`
                    <div class="text-center py-5">
                        <i class="bi bi-briefcase" style="font-size: 3rem; color: #6c757d;"></i>
                        <p class="mt-3 text-muted">Belum ada experience. Klik "Tambah Experience" untuk menambahkan.</p>
                    </div>
                `);
                        return;
                    }

                    // Loop data
                    let html = '';
                    resp.data.forEach(exp => {
                        let visibleBadge = exp.is_visible ?
                            '<span class="badge badge-success">Visible</span>' :
                            '<span class="badge badge-secondary">Hidden</span>';

                        // Logic Logo
                        let logoHtml = exp.company_logo ?
                            `<img src="/storage/${exp.company_logo}" class="timeline-logo" alt="${exp.company_name}">` :
                            `<div class="timeline-logo bg-light d-flex align-items-center justify-content-center"><i class="bi bi-building" style="font-size: 2rem; color: #6c757d;"></i></div>`;

                        // Logic Positions (Nested Map)
                        let positionsHtml = exp.positions.map((pos, idx) => {
                            let achievementsHtml = pos.achievements.length > 0 ?
                                `<small class="text-muted d-block mt-1">${pos.achievements.length} achievement(s)</small>` :
                                '';

                            let badgeHtml = pos.badge_type ?
                                `<span class="badge badge-warning ml-2">${pos.badge_type}</span>` :
                                '';

                            let dateRange =
                                `${formatDate(pos.start_date)} - ${pos.is_current ? 'Present' : formatDate(pos.end_date)}`;

                            return `
                        <div class="position-item mt-2">
                            <div>
                                <strong>${pos.position_title}</strong> ${badgeHtml}
                                <p class="mb-1 text-muted small">
                                    <i class="bi bi-calendar"></i> ${dateRange} ·
                                    <span class="badge badge-secondary">${pos.employment_type.replace('_', ' ')}</span>
                                </p>
                                ${achievementsHtml}
                            </div>
                        </div>
                    `;
                        }).join('');

                        html += `
                    <div class="timeline-item">
                        ${logoHtml}
                        <div class="timeline-content">
                            <h6 class="mb-1">
                                ${exp.company_name} ${visibleBadge}
                            </h6>
                            <p class="mb-2 text-muted">
                                <i class="bi bi-geo-alt"></i> ${exp.location} ·
                                <span class="badge badge-info">${exp.location_type.replace('_', ' ')}</span> ·
                                ${exp.position_count} position(s)
                            </p>
                            <div class="pl-2 border-left">
                                ${positionsHtml}
                            </div>
                        </div>
                        <div class="timeline-actions">
                            <button class="btn btn-warning btn-sm" onclick="editExperience(${exp.id})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteExperience(${exp.id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
                    });
                    $("#experiencesList").html(html);
                }
            });
        }

        function openExperienceModal() {
            $("#experience-modal").modal("show");
            $(".modal-title").html('<i class="bi bi-briefcase"></i> Tambah Experience');
            $("#experience_type").val("create");
            $("#experience_id").val("");
            $("#experienceForm")[0].reset();
            $("#exp_is_visible").prop("checked", true);
            $("#expLogoPreview").html("");

            // Reset Positions
            positionCounter = 0;
            $("#positionsList").html("");
            clearErrors('exp');
            addPosition(); // Add 1 position by default
        }

        function addPosition() {
            positionCounter++;
            let html = `
        <div class="position-input-item card card-body mb-3 bg-light" id="position_${positionCounter}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="mb-0">Position #${positionCounter}</h6>
                <button type="button" class="btn btn-sm btn-danger" onclick="removePosition(${positionCounter})">
                    <i class="bi bi-trash"></i> Remove
                </button>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Position Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control position-title" placeholder="Contoh: Founder">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Employment Type <span class="text-danger">*</span></label>
                        <select class="form-control position-employment-type">
                            <option value="">Pilih Tipe</option>
                            <option value="full_time">Full-time</option>
                            <option value="part_time">Part-time</option>
                            <option value="self_employed">Self-employed</option>
                            <option value="freelance">Freelance</option>
                            <option value="internship">Internship</option>
                            <option value="contract">Contract</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Start Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control position-start-date">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" class="form-control position-end-date">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div class="custom-control custom-checkbox mt-2">
                            <input type="checkbox" class="custom-control-input position-is-current" id="is_current_${positionCounter}">
                            <label class="custom-control-label" for="is_current_${positionCounter}">Current Position</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Badge Type</label>
                <select class="form-control position-badge-type">
                    <option value="">None</option>
                    <option value="current">Current</option>
                    <option value="scholarship">Scholarship</option>
                </select>
            </div>

            <hr>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="mb-0">Achievements</label>
                <button type="button" class="btn btn-sm btn-outline-primary" onclick="addPositionAchievement(${positionCounter})">
                    <i class="bi bi-plus"></i> Add Achievement
                </button>
            </div>
            <div class="position-achievements-list" id="pos_achievements_${positionCounter}"></div>
        </div>
    `;
            $("#positionsList").append(html);
        }

        function removePosition(id) {
            $(`#position_${id}`).remove();
        }

        function addPositionAchievement(positionId) {
            if (!achievementCounter[positionId]) {
                achievementCounter[positionId] = 0;
            }
            achievementCounter[positionId]++;
            let achId = `${positionId}_${achievementCounter[positionId]}`;

            let html = `
        <div class="achievement-input-item input-group mb-2" id="achievement_${achId}">
            <textarea class="form-control position-achievement" rows="1" placeholder="Describe the achievement..."></textarea>
            <div class="input-group-append">
                <button type="button" class="btn btn-danger" onclick="removePositionAchievement('${achId}')">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>`;

            $(`#pos_achievements_${positionId}`).append(html);
        }

        function removePositionAchievement(id) {
            $(`#achievement_${id}`).remove();
        }

        // === SAVE EXPERIENCE ===
        $("#saveExperienceBtn").click(function() {
            let btn = $(this);
            btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Menyimpan...');

            let type = $("#experience_type").val();
            let id = $("#experience_id").val();

            // Perbaikan URL Logic
            let url = (type === "create") ?
                "{{ route('abouts.experiences.store') }}" :
                `${BASE_URL}/experiences/${id}/update`;

            let formData = new FormData();
            formData.append('company_name', $("#exp_company_name").val());
            formData.append('company_url', $("#exp_company_url").val());
            formData.append('location', $("#exp_location").val());
            formData.append('location_type', $("#exp_location_type").val());
            formData.append('order', $("#exp_order").val());
            formData.append('is_visible', $("#exp_is_visible").is(':checked') ? 1 : 0);

            if ($("#exp_company_logo")[0].files[0]) {
                formData.append('company_logo', $("#exp_company_logo")[0].files[0]);
            }

            // Collect positions data
            let positions = [];
            $(".position-input-item").each(function(index) {
                let positionData = {
                    position_title: $(this).find(".position-title").val(),
                    employment_type: $(this).find(".position-employment-type").val(),
                    start_date: $(this).find(".position-start-date").val(),
                    end_date: $(this).find(".position-end-date").val(),
                    is_current: $(this).find(".position-is-current").is(':checked'),
                    badge_type: $(this).find(".position-badge-type").val(),
                    achievements: []
                };

                // Collect achievements for this position
                $(this).find(".position-achievement").each(function() {
                    if ($(this).val().trim()) {
                        positionData.achievements.push($(this).val().trim());
                    }
                });

                positions.push(positionData);
            });

            formData.append('positions', JSON.stringify(positions));
            formData.append('_token', "{{ csrf_token() }}");

            if (type === "update") {
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) {
                    $("#experience-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    loadExperiences();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showErrors(xhr.responseJSON.errors, 'exp');
                        Toast.fire({
                            icon: "error",
                            title: "Periksa input kamu."
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: xhr.responseJSON?.message || "Terjadi kesalahan"
                        });
                    }
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="bi bi-save"></i> Simpan');
                }
            });
        });

        // ====================== EDIT & DELETE EXPERIENCE ======================

        function editExperience(id) {
            $.ajax({
                // PERBAIKAN: URL ditulis rapi dengan backticks
                url: `${BASE_URL}/experiences/${id}/show`,
                method: "GET",
                success: function(resp) {
                    if (!resp.status) {
                        Toast.fire({
                            icon: "error",
                            title: "Data tidak ditemukan"
                        });
                        return;
                    }

                    let d = resp.data;
                    $("#experience_id").val(d.id);
                    $("#experience_type").val("update");
                    $("#exp_company_name").val(d.company_name);
                    $("#exp_company_url").val(d.company_url);
                    $("#exp_location").val(d.location);
                    $("#exp_location_type").val(d.location_type);
                    $("#exp_order").val(d.order);
                    $("#exp_is_visible").prop("checked", d.is_visible);

                    // PERBAIKAN: HTML Image Preview
                    if (d.company_logo) {
                        $("#expLogoPreview").html(`
                    <img src="/storage/${d.company_logo}" class="img-thumbnail" style="max-width: 150px">
                `);
                    } else {
                        $("#expLogoPreview").html('');
                    }

                    // Load positions
                    positionCounter = 0;
                    $("#positionsList").html("");

                    // Loop setiap posisi yang ada
                    d.positions.forEach((pos, index) => {
                        addPosition(); // Tambah form kosong dulu

                        // Ambil elemen terakhir (yang baru saja ditambahkan)
                        let currentPos = $(".position-input-item").last();

                        // Isi datanya
                        currentPos.find(".position-title").val(pos.position_title);
                        currentPos.find(".position-employment-type").val(pos.employment_type);
                        currentPos.find(".position-start-date").val(pos.start_date);
                        currentPos.find(".position-end-date").val(pos.end_date);
                        currentPos.find(".position-is-current").prop("checked", pos.is_current);
                        currentPos.find(".position-badge-type").val(pos.badge_type);

                        // Load achievements untuk posisi ini
                        pos.achievements.forEach(ach => {
                            addPositionAchievement(positionCounter);
                            currentPos.find(".position-achievement").last().val(ach
                                .achievement_text);
                        });
                    });

                    $("#experience-modal").modal("show");
                    $(".modal-title").html('<i class="bi bi-pencil"></i> Edit Experience');
                },
                error: function(err) {
                    Toast.fire({
                        icon: "error",
                        title: "Gagal mengambil data experience"
                    });
                }
            });
        }

        function deleteExperience(id) {
            Swal.fire({
                title: "Hapus Experience?",
                text: "Data tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        // PERBAIKAN: URL yang benar
                        url: `${BASE_URL}/experiences/${id}/destroy`,
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: resp => {
                            Toast.fire({
                                icon: "success",
                                title: resp.message
                            });
                            loadExperiences();
                        },
                        error: function(err) {
                            Toast.fire({
                                icon: "error",
                                title: "Gagal menghapus data"
                            });
                        }
                    });
                }
            });
        }

        // ====================== EDUCATION FUNCTIONS ======================

        function loadEducations() {
            // Loading State
            $("#educationsList").html(`
        <div class="text-center py-5">
            <i class="bi bi-hourglass-split" style="font-size: 3rem; color: #6c757d;"></i>
            <p class="mt-3 text-muted">Loading...</p>
        </div>
    `);

            $.ajax({
                url: "{{ route('abouts.educations.list') }}",
                method: "GET",
                success: function(resp) {
                    // State jika Kosong
                    if (resp.data.length === 0) {
                        $("#educationsList").html(`
                    <div class="text-center py-5">
                        <i class="bi bi-mortarboard" style="font-size: 3rem; color: #6c757d;"></i>
                        <p class="mt-3 text-muted">Belum ada education. Klik "Tambah Education" untuk menambahkan.</p>
                    </div>
                `);
                        return;
                    }

                    let html = '';
                    resp.data.forEach(edu => {
                        let visibleBadge = edu.is_visible ?
                            '<span class="badge badge-success">Visible</span>' :
                            '<span class="badge badge-secondary">Hidden</span>';

                        let logoHtml = edu.institution_logo ?
                            `<img src="/storage/${edu.institution_logo}" class="timeline-logo" alt="${edu.institution_name}">` :
                            `<div class="timeline-logo bg-light d-flex align-items-center justify-content-center"><i class="bi bi-mortarboard" style="font-size: 2rem; color: #6c757d;"></i></div>`;

                        let achievementHtml = edu.achievements.length > 0 ?
                            `<small class="text-muted d-block mt-1">${edu.achievements.length} achievement(s)</small>` :
                            '';

                        let gpaHtml = edu.gpa ? `· GPA ${edu.gpa}` : '';

                        html += `
                    <div class="timeline-item">
                        ${logoHtml}
                        <div class="timeline-content">
                            <h6 class="mb-1">
                                ${edu.degree} ${visibleBadge}
                            </h6>
                            <p class="mb-1">
                                <strong>${edu.institution_name}</strong>
                            </p>
                            <p class="mb-2 text-muted">
                                ${edu.field_of_study} · <i class="bi bi-geo-alt"></i> ${edu.location}
                            </p>
                            <p class="mb-1 text-muted small">
                                <i class="bi bi-calendar"></i>
                                ${formatDate(edu.start_date)} - ${edu.end_date ? formatDate(edu.end_date) : 'Present'}
                                ${gpaHtml}
                            </p>
                            ${achievementHtml}
                        </div>
                        <div class="timeline-actions">
                            <button class="btn btn-warning btn-sm" onclick="editEducation(${edu.id})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteEducation(${edu.id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>`;
                    });
                    $("#educationsList").html(html);
                },
                error: function() {
                    $("#educationsList").html(`
                <div class="alert alert-danger text-center">Gagal memuat data education.</div>
            `);
                }
            });
        }

        let eduAchievementCounter = 0;

        function openEducationModal() {
            $("#education-modal").modal("show");
            $(".modal-title").html('<i class="bi bi-mortarboard"></i> Tambah Education');
            $("#education_type").val("create");
            $("#education_id").val("");
            $("#educationForm")[0].reset();
            $("#edu_is_visible").prop("checked", true);
            $("#eduLogoPreview").html("");
            $("#eduAchievementsList").html("");

            // Reset counter dan error
            eduAchievementCounter = 0;
            clearErrors('edu');
        }

        function addEducationAchievement() {
            eduAchievementCounter++;
            let html = `
        <div class="achievement-input-item input-group mb-2" id="edu_achievement_${eduAchievementCounter}">
            <textarea class="form-control edu-achievement" rows="2" placeholder="Describe the achievement..."></textarea>
            <div class="input-group-append">
                <button type="button" class="btn btn-danger" onclick="removeEducationAchievement(${eduAchievementCounter})">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>`;
            $("#eduAchievementsList").append(html);
        }

        function removeEducationAchievement(id) {
            $(`#edu_achievement_${id}`).remove();
        }

        // === SAVE EDUCATION ===
        $("#saveEducationBtn").click(function() {
            let btn = $(this);
            btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Menyimpan...');

            let type = $("#education_type").val();
            let id = $("#education_id").val();

            // PERBAIKAN: URL Logic yang benar
            let url = (type === "create") ?
                "{{ route('abouts.educations.store') }}" :
                `${BASE_URL}/educations/${id}/update`;

            let formData = new FormData();
            formData.append('institution_name', $("#edu_institution_name").val());
            formData.append('degree', $("#edu_degree").val());
            formData.append('field_of_study', $("#edu_field_of_study").val());
            formData.append('location', $("#edu_location").val());
            formData.append('start_date', $("#edu_start_date").val());
            formData.append('end_date', $("#edu_end_date").val());
            formData.append('gpa', $("#edu_gpa").val());
            formData.append('order', $("#edu_order").val());
            formData.append('is_visible', $("#edu_is_visible").is(':checked') ? 1 : 0);

            if ($("#edu_institution_logo")[0].files[0]) {
                formData.append('institution_logo', $("#edu_institution_logo")[0].files[0]);
            }

            // Collect achievements
            let achievements = [];
            $(".edu-achievement").each(function() {
                if ($(this).val().trim()) {
                    achievements.push($(this).val().trim());
                }
            });
            formData.append('achievements', JSON.stringify(achievements));
            formData.append('_token', "{{ csrf_token() }}");

            if (type === "update") {
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) {
                    $("#education-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    loadEducations();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showErrors(xhr.responseJSON.errors, 'edu');
                        Toast.fire({
                            icon: "error",
                            title: "Periksa input kamu."
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: xhr.responseJSON?.message || "Terjadi kesalahan"
                        });
                    }
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="bi bi-save"></i> Simpan');
                }
            });
        });

        // === EDIT EDUCATION ===
        function editEducation(id) {
            $.ajax({
                // PERBAIKAN: URL Backtick
                url: `${BASE_URL}/educations/${id}/show`,
                method: "GET",
                success: function(resp) {
                    if (!resp.status) {
                        Toast.fire({
                            icon: "error",
                            title: "Data tidak ditemukan"
                        });
                        return;
                    }
                    let d = resp.data;
                    $("#education_id").val(d.id);
                    $("#education_type").val("update");
                    $("#edu_institution_name").val(d.institution_name);
                    $("#edu_degree").val(d.degree);
                    $("#edu_field_of_study").val(d.field_of_study);
                    $("#edu_location").val(d.location);
                    $("#edu_start_date").val(d.start_date);
                    $("#edu_end_date").val(d.end_date);
                    $("#edu_gpa").val(d.gpa);
                    $("#edu_order").val(d.order);
                    $("#edu_is_visible").prop("checked", d.is_visible);

                    if (d.institution_logo) {
                        $("#eduLogoPreview").html(`
                    <img src="/storage/${d.institution_logo}" class="img-thumbnail" style="max-width: 150px">
                `);
                    } else {
                        $("#eduLogoPreview").html('');
                    }

                    // Load achievements
                    eduAchievementCounter = 0;
                    $("#eduAchievementsList").html("");
                    d.achievements.forEach(ach => {
                        addEducationAchievement();
                        // Set value ke input terakhir yang baru dibuat
                        $(".edu-achievement").last().val(ach.achievement_text);
                    });

                    $("#education-modal").modal("show");
                    $(".modal-title").html('<i class="bi bi-pencil"></i> Edit Education');
                },
                error: function(err) {
                    Toast.fire({
                        icon: "error",
                        title: "Gagal memuat data"
                    });
                }
            });
        }

        // === DELETE EDUCATION ===
        function deleteEducation(id) {
            Swal.fire({
                title: "Hapus Education?",
                text: "Data tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        // PERBAIKAN: URL Delete Correct
                        url: `${BASE_URL}/educations/${id}/destroy`,
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: resp => {
                            Toast.fire({
                                icon: "success",
                                title: resp.message
                            });
                            loadEducations();
                        },
                        error: function(err) {
                            Toast.fire({
                                icon: "error",
                                title: "Gagal menghapus data"
                            });
                        }
                    });
                }
            });
        }

        // ====================== CERTIFICATION FUNCTIONS ======================

        let certAchievementCounter = 0;

        function loadCertifications() {
            // Tampilkan Loading
            $("#certificationsList").html(`
        <div class="text-center py-5">
            <i class="bi bi-hourglass-split" style="font-size: 3rem; color: #6c757d;"></i>
            <p class="mt-3 text-muted">Loading...</p>
        </div>
    `);

            $.ajax({
                url: "{{ route('abouts.certifications.list') }}",
                method: "GET",
                success: function(resp) {
                    // Jika data kosong
                    if (resp.data.length === 0) {
                        $("#certificationsList").html(`
                    <div class="text-center py-5">
                        <i class="bi bi-award" style="font-size: 3rem; color: #6c757d;"></i>
                        <p class="mt-3 text-muted">Belum ada certification. Klik "Tambah Certification" untuk menambahkan.</p>
                    </div>
                `);
                        return;
                    }

                    let html = '';
                    resp.data.forEach(cert => {
                        let visibleBadge = cert.is_visible ?
                            '<span class="badge badge-success">Visible</span>' :
                            '<span class="badge badge-secondary">Hidden</span>';

                        let logoHtml = cert.organization_logo ?
                            `<img src="/storage/${cert.organization_logo}" class="timeline-logo" alt="${cert.issuing_organization}">` :
                            `<div class="timeline-logo bg-light d-flex align-items-center justify-content-center"><i class="bi bi-award" style="font-size: 2rem; color: #6c757d;"></i></div>`;

                        let credentialLink = cert.credential_url ?
                            ` · <a href="${cert.credential_url}" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Credential</a>` :
                            '';

                        let achievementHtml = cert.achievements.length > 0 ?
                            `<small class="text-muted d-block mt-1">${cert.achievements.length} achievement(s)</small>` :
                            '';

                        html += `
                    <div class="timeline-item">
                        ${logoHtml}
                        <div class="timeline-content">
                            <h6 class="mb-1">
                                ${cert.title} ${visibleBadge}
                            </h6>
                            <p class="mb-1">
                                <strong>${cert.issuing_organization}</strong>
                            </p>
                            <p class="mb-2 text-muted small">
                                <i class="bi bi-calendar"></i> Issued ${formatDateMonth(cert.issue_date)}
                                ${credentialLink}
                            </p>
                            ${achievementHtml}
                        </div>
                        <div class="timeline-actions">
                            <button class="btn btn-warning btn-sm" onclick="editCertification(${cert.id})">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="deleteCertification(${cert.id})">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>`;
                    });
                    $("#certificationsList").html(html);
                }
            });
        }

        function openCertificationModal() {
            $("#certification-modal").modal("show");
            $(".modal-title").html('<i class="bi bi-award"></i> Tambah Certification');
            $("#certification_type").val("create");
            $("#certification_id").val("");
            $("#certificationForm")[0].reset();
            $("#cert_is_visible").prop("checked", true);
            $("#certLogoPreview").html("");
            $("#certAchievementsList").html("");

            // Reset Counter
            certAchievementCounter = 0;
            clearErrors('cert');
        }

        function addCertificationAchievement() {
            certAchievementCounter++;
            let html = `
        <div class="achievement-input-item input-group mb-2" id="cert_achievement_${certAchievementCounter}">
            <textarea class="form-control cert-achievement" rows="2" placeholder="Describe the achievement..."></textarea>
            <div class="input-group-append">
                <button type="button" class="btn btn-danger" onclick="removeCertificationAchievement(${certAchievementCounter})">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>`;
            $("#certAchievementsList").append(html);
        }

        function removeCertificationAchievement(id) {
            $(`#cert_achievement_${id}`).remove();
        }

        // === SAVE CERTIFICATION ===
        $("#saveCertificationBtn").click(function() {
            let btn = $(this);
            btn.prop('disabled', true).html('<i class="bi bi-hourglass-split"></i> Menyimpan...');

            let type = $("#certification_type").val();
            let id = $("#certification_id").val();

            // PERBAIKAN: URL Logic
            let url = (type === "create") ?
                "{{ route('abouts.certifications.store') }}" :
                `${BASE_URL}/certifications/${id}/update`;

            let formData = new FormData();
            formData.append('title', $("#cert_title").val());
            formData.append('issuing_organization', $("#cert_issuing_organization").val());
            formData.append('issue_date', $("#cert_issue_date").val());
            formData.append('credential_url', $("#cert_credential_url").val());
            formData.append('linkedin_certifications_url', $("#cert_linkedin_url").val());
            formData.append('order', $("#cert_order").val());
            formData.append('is_visible', $("#cert_is_visible").is(':checked') ? 1 : 0);

            if ($("#cert_organization_logo")[0].files[0]) {
                formData.append('organization_logo', $("#cert_organization_logo")[0].files[0]);
            }

            // Collect achievements
            let achievements = [];
            $(".cert-achievement").each(function() {
                if ($(this).val().trim()) {
                    achievements.push($(this).val().trim());
                }
            });
            formData.append('achievements', JSON.stringify(achievements));
            formData.append('_token', "{{ csrf_token() }}");

            if (type === "update") {
                formData.append('_method', 'PUT');
            }

            $.ajax({
                url: url,
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(resp) {
                    $("#certification-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    loadCertifications();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showErrors(xhr.responseJSON.errors, 'cert');
                        Toast.fire({
                            icon: "error",
                            title: "Periksa input kamu."
                        });
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: xhr.responseJSON?.message || "Terjadi kesalahan"
                        });
                    }
                },
                complete: function() {
                    btn.prop('disabled', false).html('<i class="bi bi-save"></i> Simpan');
                }
            });
        });

        // === EDIT CERTIFICATION ===
        function editCertification(id) {
            $.ajax({
                // PERBAIKAN: URL Syntax
                url: `${BASE_URL}/certifications/${id}/show`,
                method: "GET",
                success: function(resp) {
                    if (!resp.status) {
                        Toast.fire({
                            icon: "error",
                            title: "Data tidak ditemukan"
                        });
                        return;
                    }
                    let d = resp.data;
                    $("#certification_id").val(d.id);
                    $("#certification_type").val("update");
                    $("#cert_title").val(d.title);
                    $("#cert_issuing_organization").val(d.issuing_organization);
                    $("#cert_issue_date").val(d.issue_date);
                    $("#cert_credential_url").val(d.credential_url);
                    $("#cert_linkedin_url").val(d.linkedin_certifications_url);
                    $("#cert_order").val(d.order);
                    $("#cert_is_visible").prop("checked", d.is_visible);

                    if (d.organization_logo) {
                        $("#certLogoPreview").html(`
                    <img src="/storage/${d.organization_logo}" class="img-thumbnail" style="max-width: 150px">
                `);
                    } else {
                        $("#certLogoPreview").html('');
                    }

                    // Load achievements
                    certAchievementCounter = 0;
                    $("#certAchievementsList").html("");
                    d.achievements.forEach(ach => {
                        addCertificationAchievement();
                        $(".cert-achievement").last().val(ach.achievement_text);
                    });

                    $("#certification-modal").modal("show");
                    $(".modal-title").html('<i class="bi bi-pencil"></i> Edit Certification');
                },
                error: function() {
                    Toast.fire({
                        icon: "error",
                        title: "Gagal memuat data"
                    });
                }
            });
        }

        // === DELETE CERTIFICATION ===
        function deleteCertification(id) {
            Swal.fire({
                title: "Hapus Certification?",
                text: "Data tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        // PERBAIKAN: URL Delete
                        url: `${BASE_URL}/certifications/${id}/destroy`,
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: resp => {
                            Toast.fire({
                                icon: "success",
                                title: resp.message
                            });
                            loadCertifications();
                        },
                        error: function() {
                            Toast.fire({
                                icon: "error",
                                title: "Gagal menghapus data"
                            });
                        }
                    });
                }
            });
        }

        // ====================== HELPER FUNCTIONS ======================

        function formatDate(date) {
            if (!date) return '';
            let d = new Date(date);
            if (isNaN(d.getTime())) return '';
            return d.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short'
            });
        }

        function formatDateMonth(date) {
            if (!date) return '';
            let d = new Date(date);
            if (isNaN(d.getTime())) return '';
            return d.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'long'
            });
        }

        function showErrors(errors, prefix) {
            clearErrors(prefix);
            $.each(errors, function(key, value) {
                // PERHATIKAN: Jangan ada spasi antara $ dan { di dalam backtick
                // Gunakan selector jQuery yang benar: $(`.error_${key}`)
                $(`.error_${key}`).html(value[0]);
            });
        }

        function clearErrors(prefix = '') {
            if (prefix) {
                // PERHATIKAN: Ini juga diperbaiki
                $(`.error_${prefix}`).html("");
            }
            $(".text-danger[class^='error_']").html("");
        }
    </script>
@endpush
