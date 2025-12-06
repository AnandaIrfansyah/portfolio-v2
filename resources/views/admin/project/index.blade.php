@extends('layouts.app')
@section('title', 'Projects')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        /* Badge Styling */
        .project-type-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .tech-stack-badge {
            font-size: 0.75rem;
            margin-right: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .featured-star {
            color: #ffc107;
        }

        /* Modal Sizing */
        .modal-xl {
            max-width: 1200px;
        }

        /* Item Lists (Features, Gallery, Tech Stacks) */
        .item-list {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            margin-bottom: 0.75rem;
            background: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        }

        .item-list:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
        }

        .item-info {
            flex: 1;
        }

        .item-info strong {
            font-size: 0.95rem;
            color: #495057;
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .order-input {
            width: 70px;
            text-align: center;
        }

        .order-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-right: 0.25rem;
        }

        /* Gallery Preview */
        .gallery-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
        }

        .gallery-item {
            position: relative;
            width: 120px;
            height: 120px;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gallery-item .remove-gallery {
            position: absolute;
            top: 5px;
            right: 5px;
            background: rgba(220, 53, 69, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gallery-item .order-badge {
            position: absolute;
            bottom: 5px;
            left: 5px;
            background: rgba(0, 123, 255, 0.9);
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
        }

        /* Modal auto-height */
        #project-modal .modal-dialog {
            display: flex;
            align-items: center;
            min-height: calc(100vh - 3.5rem);
        }

        #project-modal .modal-content {
            width: 100%;
            max-height: calc(100vh - 3.5rem);
            display: flex;
            flex-direction: column;
        }

        #project-modal .modal-body {
            flex: 1;
            overflow-y: auto;
            max-height: calc(100vh - 200px);
        }

        #project-modal .modal-footer {
            flex-shrink: 0;
            border-top: 1px solid #dee2e6;
        }

        /* Lists dengan scroll */
        #techStacksList,
        #featuresList,
        #galleryPreview {
            max-height: 300px;
            overflow-y: auto;
        }

        /* View Modal - 2 Column Layout */
        #view-modal .modal-xl {
            max-width: 1200px;
        }

        #view-modal .modal-body {
            padding: 0 !important;
        }

        .project-detail .detail-header h4 {
            color: #2c3e50;
            font-weight: 600;
            line-height: 1.4;
        }

        .project-detail .card {
            border: 1px solid #e0e0e0;
        }

        .project-detail .card-header {
            background: #f8f9fa;
            border-bottom: 2px solid #e0e0e0;
        }

        .project-detail h5 {
            color: #34495e;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .project-detail .badge {
            font-size: 0.8rem;
            padding: 0.35rem 0.65rem;
            font-weight: 500;
        }

        .project-detail img {
            border: 1px solid #e0e0e0;
        }

        .project-detail a.btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .project-detail .col-md-4.bg-light {
            background-color: #f8f9fa !important;
        }

        .project-detail .card-body small.text-muted {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }

        /* Scrollbar styling */
        #viewContent::-webkit-scrollbar {
            width: 8px;
        }

        #viewContent::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        #viewContent::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        #viewContent::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Gallery Carousel in View Modal */
        .gallery-carousel {
            position: relative;
            max-height: 400px;
            overflow: hidden;
            border-radius: 8px;
        }

        .gallery-carousel img {
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: contain;
        }

        /* Feature Card Styling */
        .feature-card {
            border-left: 3px solid #007bff;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-left-color: #0056b3;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            {{-- Page Header --}}
            <div class="section-header">
                <h1>Projects</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="#">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Projects</div>
                </div>
            </div>

            <div class="section-body">
                {{-- Title --}}
                <h2 class="section-title">Manage Projects</h2>
                <p class="section-lead">Kelola daftar project portfolio kamu.</p>

                {{-- CARD --}}
                <div class="card">
                    <div class="card-header">
                        <a href="javascript:void(0)" onclick="openModal()" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Tambah Project
                        </a>
                    </div>

                    <div class="card-body">
                        {{-- FILTERS --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                                        Active</option>
                                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>
                                        Completed</option>
                                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>
                                        Archived</option>
                                    <option value="on_hold" {{ request('status') == 'on_hold' ? 'selected' : '' }}>
                                        On Hold</option>
                                    <option value="in_development"
                                        {{ request('status') == 'in_development' ? 'selected' : '' }}>
                                        In Development</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" id="categoryFilter">
                                    <option value="">Semua Kategori</option>
                                    {{-- Will be populated via AJAX --}}
                                </select>
                            </div>
                        </div>

                        {{-- SORT --}}
                        <div class="float-left">
                            <select class="form-control selectric" id="sort">
                                @foreach ([10, 25, 50, 100] as $opt)
                                    <option value="{{ $opt }}" {{ request('sort') == $opt ? 'selected' : '' }}>
                                        {{ $opt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- SEARCH --}}
                        <div class="float-right">
                            <form>
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                                <input type="hidden" name="status" value="{{ request('status') }}">
                                <input type="hidden" name="category" value="{{ request('category') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="Search projects..." value="{{ request('search') }}">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="clearfix mb-3"></div>

                        {{-- TABLE --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="bg-primary">
                                    <tr>
                                        <th class="text-center text-white" width="5%">No</th>
                                        <th class="text-white" width="30%">Title</th>
                                        <th class="text-white" width="12%">Category</th>
                                        <th class="text-white" width="10%">Role</th>
                                        <th class="text-center text-white" width="8%">Year</th>
                                        <th class="text-center text-white" width="10%">Status</th>
                                        <th class="text-center text-white" width="5%">Featured</th>
                                        <th class="text-center text-white" width="5%">Views</th>
                                        <th class="text-center text-white" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = ($projects->currentPage() - 1) * $projects->perPage() + 1; @endphp
                                    @forelse ($projects as $item)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>
                                                <strong>{{ $item->title }}</strong>
                                                @if ($item->description)
                                                    <br><small
                                                        class="text-muted">{{ Str::limit($item->description, 60) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->category)
                                                    <span class="badge badge-info">
                                                        @if ($item->category->icon_class)
                                                            <i class="{{ $item->category->icon_class }} mr-1"></i>
                                                        @endif
                                                        {{ $item->category->name }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $item->role ?? '-' }}</small>
                                            </td>
                                            <td class="text-center">{{ $item->formatted_date }}</td>
                                            <td class="text-center">
                                                @php
                                                    $statusColors = [
                                                        'active' => 'success',
                                                        'completed' => 'primary',
                                                        'archived' => 'secondary',
                                                        'on_hold' => 'warning',
                                                        'in_development' => 'danger',
                                                    ];
                                                @endphp
                                                <span
                                                    class="badge badge-{{ $statusColors[$item->status] ?? 'secondary' }}">
                                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                @if ($item->is_featured)
                                                    <i class="fas fa-star featured-star"></i>
                                                @else
                                                    <i class="far fa-star text-muted"></i>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <small class="text-muted">{{ $item->views }}</small>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-info btn-sm mt-1"
                                                    onclick="viewModal('{{ $item->id }}')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm mt-1"
                                                    onclick="editModal('{{ $item->id }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm mt-1"
                                                    onclick="deleteItem('{{ $item->id }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Tidak ada data project.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="float-right">
                            {{ $projects->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- ====================== MODAL CREATE/EDIT ====================== --}}
@push('modal')
    {{-- ====================== MODAL CREATE/EDIT ====================== --}}
    <div class="modal fade" id="project-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="form" enctype="multipart/form-data">
                    <input type="hidden" id="id">
                    <input type="hidden" id="type">
                    <div class="modal-body">
                        {{-- TABS NAVIGATION --}}
                        <ul class="nav nav-tabs" id="projectTabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="basic-tab" data-toggle="tab" href="#basic"
                                    role="tab">
                                    <i class="fas fa-info-circle"></i> Basic Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="content-tab" data-toggle="tab" href="#content-section"
                                    role="tab">
                                    <i class="fas fa-file-alt"></i> Content
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tech-tab" data-toggle="tab" href="#tech-section"
                                    role="tab">
                                    <i class="fas fa-code"></i> Tech Stacks
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="features-tab" data-toggle="tab" href="#features-section"
                                    role="tab">
                                    <i class="fas fa-star"></i> Features
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="media-tab" data-toggle="tab" href="#media-section"
                                    role="tab">
                                    <i class="fas fa-images"></i> Media
                                </a>
                            </li>
                        </ul>

                        {{-- TABS CONTENT --}}
                        <div class="tab-content mt-3" id="projectTabsContent">
                            {{-- TAB 1: BASIC INFO --}}
                            <div class="tab-pane fade show active" id="basic" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Title --}}
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text" id="title" class="form-control"
                                                placeholder="Nama project">
                                            <span class="text-danger error_title"></span>
                                        </div>

                                        {{-- Category --}}
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <label>Category</label>
                                                <button type="button" class="btn btn-success btn-sm mb-2"
                                                    onclick="openCategoryModal()">
                                                    <i class="fas fa-plus"></i> New Category
                                                </button>
                                            </div>
                                            <select id="category_id" class="form-control select2">
                                                <option value="">Pilih Kategori...</option>
                                            </select>
                                            <span class="text-danger error_category_id"></span>
                                        </div>

                                        {{-- Role --}}
                                        <div class="form-group">
                                            <label>Role</label>
                                            <input type="text" id="role" class="form-control"
                                                placeholder="Contoh: Full Stack Developer">
                                            <span class="text-danger error_role"></span>
                                        </div>

                                        {{-- Status --}}
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select id="status" class="form-control">
                                                <option value="">Pilih Status</option>
                                                <option value="active">Active</option>
                                                <option value="completed">Completed</option>
                                                <option value="archived">Archived</option>
                                                <option value="on_hold">On Hold</option>
                                                <option value="in_development">In Development</option>
                                            </select>
                                            <span class="text-danger error_status"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- Year & Month --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Year <span class="text-danger">*</span></label>
                                                    <input type="number" id="year" class="form-control"
                                                        placeholder="2024" min="1900" max="2030">
                                                    <span class="text-danger error_year"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Month</label>
                                                    <select id="month" class="form-control">
                                                        <option value="">Pilih Bulan</option>
                                                        @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $index => $monthName)
                                                            <option value="{{ $index + 1 }}">{{ $monthName }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger error_month"></span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- GitHub URL --}}
                                        <div class="form-group">
                                            <label>GitHub URL</label>
                                            <input type="url" id="github_url" class="form-control"
                                                placeholder="https://github.com/username/repo">
                                            <span class="text-danger error_github_url"></span>
                                        </div>

                                        {{-- Demo URL --}}
                                        <div class="form-group">
                                            <label>Demo URL</label>
                                            <input type="url" id="demo_url" class="form-control"
                                                placeholder="https://demo.example.com">
                                            <span class="text-danger error_demo_url"></span>
                                        </div>

                                        {{-- Order & Is Featured --}}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Order</label>
                                                    <input type="number" id="order" class="form-control"
                                                        value="0" min="0">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>&nbsp;</label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="is_featured">
                                                        <label class="custom-control-label" for="is_featured">
                                                            <i class="fas fa-star text-warning"></i> Featured Project
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- TAB 2: CONTENT --}}
                            <div class="tab-pane fade" id="content-section" role="tabpanel">
                                {{-- Description --}}
                                <div class="form-group">
                                    <label>Short Description <span class="text-danger">*</span></label>
                                    <textarea id="description" class="form-control" rows="3"
                                        placeholder="Deskripsi singkat untuk card preview..."></textarea>
                                    <span class="text-danger error_description"></span>
                                    <small class="text-muted">Deskripsi singkat untuk card (150-200 karakter)</small>
                                </div>

                                {{-- Content --}}
                                <div class="form-group">
                                    <label>Full Content (Optional)</label>
                                    <textarea id="content" class="form-control summernote-simple" placeholder="Isi lengkap project (bisa HTML)..."></textarea>
                                    <span class="text-danger error_content"></span>
                                    <small class="text-muted">Deskripsi lengkap untuk detail page</small>
                                </div>
                            </div>

                            {{-- TAB 3: TECH STACKS --}}
                            <div class="tab-pane fade" id="tech-section" role="tabpanel">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label>Tech Stacks</label>
                                        <button type="button" class="btn btn-primary btn-sm mb-2"
                                            onclick="addTechStack()">
                                            <i class="fas fa-plus"></i> Add Tech Stack
                                        </button>
                                    </div>
                                    <div class="input-group mb-2">
                                        <select id="techStackSelect" class="form-control select2">
                                            <option value="">Pilih Tech Stack...</option>
                                        </select>
                                    </div>
                                    <span class="text-danger error_tech_stacks"></span>
                                    <div id="techStacksList"></div>
                                </div>
                            </div>

                            {{-- TAB 4: FEATURES --}}
                            <div class="tab-pane fade" id="features-section" role="tabpanel">
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label>Project Features</label>
                                        <button type="button" class="btn btn-primary btn-sm mb-2"
                                            onclick="openFeatureModal()">
                                            <i class="fas fa-plus"></i> Add Feature
                                        </button>
                                    </div>
                                    <div id="featuresList"></div>
                                    <span class="text-danger error_features"></span>
                                </div>
                            </div>

                            {{-- TAB 5: MEDIA --}}
                            <div class="tab-pane fade" id="media-section" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Featured Image --}}
                                        <div class="form-group">
                                            <label>Featured Image</label>
                                            <input type="file" id="featured_image" class="form-control"
                                                accept="image/*">
                                            <span class="text-danger error_featured_image"></span>
                                            <small class="text-muted">Max 2MB (JPEG, PNG, JPG, WEBP)</small>
                                            <div id="featuredPreview" class="mt-3"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        {{-- Gallery Images --}}
                                        <div class="form-group">
                                            <label>Gallery Images (Multiple)</label>
                                            <input type="file" id="gallery_images" class="form-control"
                                                accept="image/*" multiple>
                                            <span class="text-danger error_gallery_images"></span>
                                            <small class="text-muted">Upload multiple images</small>
                                            <div id="galleryPreview" class="gallery-preview mt-3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer bg-whitesmoke br">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="storeBtn">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ====================== MODAL VIEW DETAIL ====================== --}}
    <div class="modal fade" id="view-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-white">
                    <h5 class="modal-title text-primary mb-2">
                        Project Detail
                    </h5>
                    <button class="close text-primary" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-0" id="viewContent" style="max-height: 75vh; overflow-y: auto;">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ====================== MODAL ADD CATEGORY ====================== --}}
    <div class="modal fade" id="category-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-folder-plus"></i> Tambah Category Baru
                    </h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="categoryForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Category</label>
                            <input type="text" id="category_name" class="form-control"
                                placeholder="Contoh: Web Development">
                            <span class="text-danger error_category_name"></span>
                        </div>
                        <div class="form-group">
                            <label>Icon Class (Optional)</label>
                            <input type="text" id="category_icon" class="form-control"
                                placeholder="Contoh: bi bi-code-slash">
                            <small class="text-muted">Bootstrap Icons class</small>
                        </div>
                        <div class="form-group">
                            <label>Description (Optional)</label>
                            <textarea id="category_description" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="saveCategoryBtn">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- ====================== MODAL ADD FEATURE ====================== --}}
    <div class="modal fade" id="feature-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-star"></i> Tambah Feature Baru
                    </h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="featureForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" id="feature_title" class="form-control"
                                placeholder="Contoh: High Performance">
                            <span class="text-danger error_feature_title"></span>
                        </div>
                        <div class="form-group">
                            <label>Description <span class="text-danger">*</span></label>
                            <textarea id="feature_description" class="form-control" rows="3" placeholder="Deskripsi feature..."></textarea>
                            <span class="text-danger error_feature_description"></span>
                        </div>
                        <div class="form-group">
                            <label>Icon Class (Optional)</label>
                            <input type="text" id="feature_icon" class="form-control"
                                placeholder="Contoh: bi bi-lightning">
                            <small class="text-muted">Bootstrap Icons class</small>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="saveFeatureBtn">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
@endpush

{{-- ====================== JAVASCRIPT ====================== --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000
        });

        const BASE = "{{ route('projects.index') }}";

        let selectedTechStacks = [];
        let selectedFeatures = [];
        let galleryFiles = [];

        // ========================= INITIALIZE =========================
        $(document).ready(function() {
            loadCategories();
            loadTechStacks();

            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });

            // Tab change handler
            $('#projectTabs a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $('#project-modal').modal('handleUpdate');
            });
        });

        // ========================= SORT & FILTER =========================
        $("#sort, #statusFilter, #categoryFilter").change(function() {
            let url = BASE + "?sort=" + $("#sort").val();
            if ($("#statusFilter").val()) url += "&status=" + $("#statusFilter").val();
            if ($("#categoryFilter").val()) url += "&category=" + $("#categoryFilter").val();
            window.location.href = url;
        });

        // ========================= LOAD DROPDOWNS =========================
        function loadCategories() {
            $.ajax({
                url: "{{ route('project-categories.list') }}",
                method: "GET",
                success: function(resp) {
                    let options = '<option value="">Pilih Kategori...</option>';
                    resp.data.forEach(cat => {
                        let icon = cat.icon_class ? `<i class="${cat.icon_class}"></i> ` : '';
                        options += `<option value="${cat.id}">${cat.name}</option>`;
                    });
                    $("#category_id").html(options);
                    $("#categoryFilter").html('<option value="">Semua Kategori</option>' + options);
                }
            });
        }

        function loadTechStacks() {
            $.ajax({
                url: "{{ route('tech-stacks.list') }}",
                method: "GET",
                success: function(resp) {
                    let options = '<option value="">Pilih Tech Stack...</option>';
                    resp.data.forEach(tech => {
                        options += `<option value="${tech.id}">${tech.name}</option>`;
                    });
                    $("#techStackSelect").html(options);
                }
            });
        }

        // ========================= OPEN CREATE MODAL =========================
        function openModal() {
            $("#project-modal").modal("show");
            $(".modal-title").html("Tambah Project");
            $("#type").val("create");
            $("#id").val("");
            $("#form")[0].reset();
            $("#is_featured").prop("checked", false);

            // Reset arrays
            selectedTechStacks = [];
            selectedFeatures = [];
            galleryFiles = [];

            // Clear lists
            $("#techStacksList").html("");
            $("#featuresList").html("");
            $("#featuredPreview").html("");
            $("#galleryPreview").html("");

            // Reset Summernote
            $("#content").summernote('code', '');

            clearErrors();
        }

        // ========================= TECH STACKS MANAGEMENT =========================
        function addTechStack() {
            let techId = $("#techStackSelect").val();
            let techName = $("#techStackSelect option:selected").text();

            if (!techId) {
                Toast.fire({
                    icon: "error",
                    title: "Pilih tech stack terlebih dahulu"
                });
                return;
            }

            if (selectedTechStacks.find(t => t.id == techId)) {
                Toast.fire({
                    icon: "error",
                    title: "Tech stack sudah ditambahkan"
                });
                return;
            }

            selectedTechStacks.push({
                id: techId,
                name: techName
            });

            renderTechStacksList();
        }

        function renderTechStacksList() {
            let html = '';
            selectedTechStacks.forEach((tech, index) => {
                html += `
                    <div class="item-list">
                        <div class="item-info">
                            <span class="badge badge-primary" style="font-size: 0.9rem; padding: 0.5rem 0.75rem;">
                                <i class="fas fa-code mr-1"></i> ${tech.name}
                            </span>
                        </div>
                        <div class="item-actions">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeTechStack(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            });

            if (selectedTechStacks.length === 0) {
                html = '<div class="alert alert-info mb-0">Belum ada tech stack yang ditambahkan.</div>';
            }

            $("#techStacksList").html(html);
        }

        function removeTechStack(index) {
            selectedTechStacks.splice(index, 1);
            renderTechStacksList();
        }

        // ========================= FEATURES MANAGEMENT =========================
        function openFeatureModal() {
            $("#feature-modal").modal("show");
            $("#feature_title").val("");
            $("#feature_description").val("");
            $("#feature_icon").val("");
            $(".error_feature_title, .error_feature_description").html("");
        }

        $("#saveFeatureBtn").click(function() {
            let title = $("#feature_title").val();
            let description = $("#feature_description").val();
            let icon = $("#feature_icon").val();

            if (!title || !description) {
                Toast.fire({
                    icon: "error",
                    title: "Title dan Description wajib diisi"
                });
                return;
            }

            selectedFeatures.push({
                title: title,
                description: description,
                icon_class: icon
            });

            $("#feature-modal").modal("hide");
            renderFeaturesList();
        });

        function renderFeaturesList() {
            let html = '';
            selectedFeatures.forEach((feature, index) => {
                html += `
                    <div class="item-list">
                        <div class="item-info">
                            <strong>
                                ${feature.icon_class ? `<i class="${feature.icon_class}"></i> ` : ''}
                                ${feature.title}
                            </strong>
                            <br>
                            <small class="text-muted">${feature.description.substring(0, 80)}...</small>
                        </div>
                        <div class="item-actions">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeFeature(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            });

            if (selectedFeatures.length === 0) {
                html = '<div class="alert alert-info mb-0">Belum ada feature yang ditambahkan.</div>';
            }

            $("#featuresList").html(html);
        }

        function removeFeature(index) {
            selectedFeatures.splice(index, 1);
            renderFeaturesList();
        }

        // ========================= IMAGE PREVIEW =========================
        $("#featured_image").change(function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#featuredPreview").html(
                        `<img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px">`
                    );
                }
                reader.readAsDataURL(file);
            }
        });

        $("#gallery_images").change(function() {
            galleryFiles = Array.from(this.files);
            renderGalleryPreview();
        });

        function renderGalleryPreview() {
            let html = '';
            galleryFiles.forEach((file, index) => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    html += `
                        <div class="gallery-item">
                            <img src="${e.target.result}" alt="Gallery ${index + 1}">
                            <span class="order-badge">#${index + 1}</span>
                            <button type="button" class="remove-gallery" onclick="removeGalleryImage(${index})">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `;
                    $("#galleryPreview").html(html);
                }
                reader.readAsDataURL(file);
            });
        }

        function removeGalleryImage(index) {
            galleryFiles.splice(index, 1);
            renderGalleryPreview();
        }

        // ========================= STORE/UPDATE PROJECT =========================
        $("#storeBtn").click(function() {
            $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Menyimpan...');

            let type = $("#type").val();
            let id = $("#id").val();
            let url = type === "create" ? "{{ route('projects.store') }}" : `${BASE}/${id}/update`;

            let formData = new FormData();

            // Basic Info
            formData.append('title', $("#title").val());
            formData.append('category_id', $("#category_id").val());
            formData.append('role', $("#role").val());
            formData.append('status', $("#status").val());
            formData.append('year', $("#year").val());
            formData.append('month', $("#month").val());
            formData.append('github_url', $("#github_url").val());
            formData.append('demo_url', $("#demo_url").val());
            formData.append('order', $("#order").val() || 0);
            formData.append('is_featured', $("#is_featured").is(':checked') ? 1 : 0);

            // Content
            formData.append('description', $("#description").val());
            formData.append('content', $("#content").val());

            // Tech Stacks
            selectedTechStacks.forEach((tech, index) => {
                formData.append(`tech_stacks[${index}]`, tech.id);
            });

            // Features
            selectedFeatures.forEach((feature, index) => {
                formData.append(`features[${index}][title]`, feature.title);
                formData.append(`features[${index}][description]`, feature.description);
                formData.append(`features[${index}][icon_class]`, feature.icon_class || '');
            });

            // Featured Image
            if ($("#featured_image")[0].files[0]) {
                formData.append('featured_image', $("#featured_image")[0].files[0]);
            }

            // Gallery Images
            galleryFiles.forEach((file, index) => {
                formData.append(`gallery_images[${index}]`, file);
            });

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
                    $("#project-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message || 'Berhasil menyimpan project'
                    });
                    setTimeout(() => location.reload(), 1000);
                },
                error: function(xhr) {
                    $("#storeBtn").prop('disabled', false).html('<i class="fas fa-save"></i> Simpan');
                    if (xhr.status === 422) {
                        showErrors(xhr.responseJSON.errors);
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
                }
            });
        });

        // ========================= EDIT MODAL =========================
        function editModal(id) {
            $.ajax({
                url: BASE + "/" + id + "/show",
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

                    $("#id").val(d.id);
                    $("#type").val("update");
                    $("#title").val(d.title);
                    $("#category_id").val(d.category_id);
                    $("#role").val(d.role);
                    $("#status").val(d.status);
                    $("#year").val(d.year);
                    $("#month").val(d.month);
                    $("#github_url").val(d.github_url);
                    $("#demo_url").val(d.demo_url);
                    $("#order").val(d.order);
                    $("#is_featured").prop("checked", d.is_featured);

                    // Content
                    $("#description").val(d.description);
                    $("#content").summernote('code', d.content || '');

                    // Tech Stacks
                    selectedTechStacks = d.tech_stacks.map(tech => ({
                        id: tech.id,
                        name: tech.name
                    }));
                    renderTechStacksList();

                    // Features
                    selectedFeatures = d.features.map(feature => ({
                        title: feature.title,
                        description: feature.description,
                        icon_class: feature.icon_class
                    }));
                    renderFeaturesList();

                    // Featured Image
                    if (d.featured_image) {
                        $("#featuredPreview").html(
                            `<img src="/storage/${d.featured_image}" class="img-thumbnail" style="max-width: 200px">`
                        );
                    }

                    // Gallery Images (preview existing)
                    if (d.images && d.images.length > 0) {
                        let galleryHtml = '';
                        d.images.forEach((img, index) => {
                            galleryHtml += `
                                <div class="gallery-item">
                                    <img src="/storage/${img.image_path}" alt="Gallery ${index + 1}">
                                    <span class="order-badge">#${img.order}</span>
                                </div>
                            `;
                        });
                        $("#galleryPreview").html(galleryHtml);
                    }

                    $("#project-modal").modal("show");
                    $(".modal-title").html("Edit Project");
                }
            });
        }

        // ========================= VIEW MODAL =========================
        function viewModal(id) {
            $("#view-modal .modal-title").html('Project Detail');

            $("#viewContent").html(`
                <div class="text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
                    <p class="mt-3">Loading...</p>
                </div>
            `);

            $("#view-modal").modal("show");

            $.ajax({
                url: BASE + "/" + id + "/show",
                method: "GET",
                success: function(resp) {
                    if (!resp.status) {
                        Toast.fire({
                            icon: "error",
                            title: "Data tidak ditemukan"
                        });
                        $("#view-modal").modal("hide");
                        return;
                    }

                    let d = resp.data;

                    // Status Badge
                    const statusColors = {
                        'active': 'success',
                        'completed': 'primary',
                        'archived': 'secondary',
                        'on_hold': 'warning',
                        'in_development': 'danger'
                    };
                    let statusBadge =
                        `<span class="badge badge-${statusColors[d.status] || 'secondary'}">${d.status.replace('_', ' ').toUpperCase()}</span>`;
                    let featuredStar = d.is_featured ? '<i class="fas fa-star text-warning ml-2"></i>' : '';

                    // Tech Stacks
                    let techStacksList = '';
                    if (d.tech_stacks && d.tech_stacks.length > 0) {
                        techStacksList = d.tech_stacks.map(t =>
                            `<span class="badge badge-primary mr-1 mb-1"><i class="fas fa-code mr-1"></i>${t.name}</span>`
                        ).join(' ');
                    } else {
                        techStacksList = '<span class="text-muted">No tech stacks</span>';
                    }

                    // Features
                    let featuresList = '';
                    if (d.features && d.features.length > 0) {
                        d.features.forEach(f => {
                            featuresList += `
                                <div class="card feature-card mb-3">
                                    <div class="card-body">
                                        <h6 class="mb-2">
                                            ${f.icon_class ? `<i class="${f.icon_class} text-primary mr-2"></i>` : ''}
                                            ${f.title}
                                        </h6>
                                        <p class="mb-0 text-muted" style="font-size: 0.9rem;">${f.description}</p>
                                    </div>
                                </div>
                            `;
                        });
                    } else {
                        featuresList = '<p class="text-muted">No features listed</p>';
                    }

                    // Gallery
                    let galleryHtml = '';
                    if (d.images && d.images.length > 0) {
                        galleryHtml = '<div class="row">';
                        d.images.forEach(img => {
                            galleryHtml += `
                                <div class="col-md-4 mb-3">
                                    <img src="/storage/${img.image_path}" class="img-fluid rounded shadow-sm" alt="${img.caption || 'Gallery'}">
                                    ${img.caption ? `<small class="text-muted d-block mt-1">${img.caption}</small>` : ''}
                                </div>
                            `;
                        });
                        galleryHtml += '</div>';
                    } else {
                        galleryHtml = '<p class="text-muted">No gallery images</p>';
                    }

                    let html = `
                        <div class="project-detail">
                            <!-- Header -->
                            <div class="detail-header bg-light p-4 border-bottom">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <div>
                                        ${d.category ? `<span class="badge badge-info mr-2">${d.category.icon_class ? `<i class="${d.category.icon_class}"></i> ` : ''}${d.category.name}</span>` : ''}
                                        ${statusBadge}
                                        ${featuredStar}
                                    </div>
                                    <div class="text-muted">
                                        <small><i class="fas fa-eye mr-1"></i> ${d.views || 0} views</small>
                                    </div>
                                </div>
                                <h4 class="mb-2">${d.title}</h4>
                                ${d.role ? `<p class="text-muted mb-0"><i class="fas fa-user-tag mr-1"></i> ${d.role}</p>` : ''}
                            </div>

                            <!-- Main Content -->
                            <div class="row m-0">
                                <!-- LEFT COLUMN -->
                                <div class="col-md-8 p-4 border-right">
                                    <!-- Featured Image -->
                                    ${d.featured_image ? `
                                                <div class="mb-4">
                                                    <img src="/storage/${d.featured_image}" class="img-fluid rounded shadow-sm" alt="${d.title}">
                                                </div>
                                            ` : ''}

                                    <!-- Description -->
                                    <div class="mb-4">
                                        <h5 class="border-bottom pb-2 mb-3">
                                            <i class="fas fa-align-left text-primary mr-2"></i>Description
                                        </h5>
                                        <p class="text-justify" style="line-height: 1.8;">${d.description}</p>
                                    </div>

                                    <!-- Full Content -->
                                    ${d.content ? `
                                                <div class="mb-4">
                                                    <h5 class="border-bottom pb-2 mb-3">
                                                        <i class="fas fa-file-alt text-primary mr-2"></i>Full Content
                                                    </h5>
                                                    <div class="text-justify" style="line-height: 1.8;">${d.content}</div>
                                                </div>
                                            ` : ''}

                                    <!-- Features -->
                                    ${d.features && d.features.length > 0 ? `
                                                <div class="mb-4">
                                                    <h5 class="border-bottom pb-2 mb-3">
                                                        <i class="fas fa-star text-primary mr-2"></i>Features
                                                    </h5>
                                                    ${featuresList}
                                                </div>
                                            ` : ''}

                                    <!-- Gallery -->
                                    ${d.images && d.images.length > 0 ? `
                                                <div class="mb-4">
                                                    <h5 class="border-bottom pb-2 mb-3">
                                                        <i class="fas fa-images text-primary mr-2"></i>Gallery
                                                    </h5>
                                                    ${galleryHtml}
                                                </div>
                                            ` : ''}
                                </div>

                                <!-- RIGHT COLUMN -->
                                <div class="col-md-4 p-4 bg-light">
                                    <!-- Project Info -->
                                    <div class="card mb-3 shadow-sm">
                                        <div class="card-header bg-white">
                                            <h6 class="mb-0"><i class="fas fa-info-circle text-primary mr-2"></i>Project Info</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <small class="text-muted d-block mb-1"><i class="fas fa-calendar mr-1"></i> Date:</small>
                                                <p class="mb-0">${d.formatted_date}</p>
                                            </div>
                                            ${d.category ? `
                                                        <div class="mb-3">
                                                            <small class="text-muted d-block mb-1"><i class="fas fa-folder mr-1"></i> Category:</small>
                                                            <p class="mb-0">${d.category.name}</p>
                                                        </div>
                                                    ` : ''}
                                            ${d.role ? `
                                                        <div class="mb-0">
                                                            <small class="text-muted d-block mb-1"><i class="fas fa-user-tag mr-1"></i> Role:</small>
                                                            <p class="mb-0">${d.role}</p>
                                                        </div>
                                                    ` : ''}
                                        </div>
                                    </div>

                                    <!-- Tech Stacks -->
                                    <div class="card mb-3 shadow-sm">
                                        <div class="card-header bg-white">
                                            <h6 class="mb-0"><i class="fas fa-code text-primary mr-2"></i>Tech Stacks</h6>
                                        </div>
                                        <div class="card-body">
                                            ${techStacksList}
                                        </div>
                                    </div>

                                    <!-- Links -->
                                    ${(d.github_url || d.demo_url) ? `
                                                <div class="card shadow-sm">
                                                    <div class="card-header bg-white">
                                                        <h6 class="mb-0"><i class="fas fa-link text-primary mr-2"></i>Links</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        ${d.github_url ? `
                                                    <a href="${d.github_url}" target="_blank" class="btn btn-sm btn-dark btn-block mb-2">
                                                        <i class="fab fa-github mr-1"></i> GitHub
                                                    </a>
                                                ` : ''}
                                                        ${d.demo_url ? `
                                                    <a href="${d.demo_url}" target="_blank" class="btn btn-sm btn-primary btn-block">
                                                        <i class="fas fa-external-link-alt mr-1"></i> Live Demo
                                                    </a>
                                                ` : ''}
                                                    </div>
                                                </div>
                                            ` : ''}
                                </div>
                            </div>
                        </div>
                    `;

                    $("#viewContent").html(html);
                },
                error: function(xhr) {
                    $("#viewContent").html(`
                        <div class="alert alert-danger m-4">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Failed to load project details.
                        </div>
                    `);
                }
            });
        }

        // ========================= DELETE PROJECT =========================
        function deleteItem(id) {
            Swal.fire({
                title: "Hapus Project?",
                text: "Data tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${BASE}/${id}/destroy`,
                        method: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: resp => {
                            Toast.fire({
                                icon: "success",
                                title: resp.message
                            });
                            setTimeout(() => location.reload(), 700);
                        }
                    });
                }
            });
        }

        // ========================= QUICK ADD CATEGORY =========================
        function openCategoryModal() {
            $("#category-modal").modal("show");
            $("#category_name").val("");
            $("#category_icon").val("");
            $("#category_description").val("");
            $(".error_category_name").html("");
        }

        $("#saveCategoryBtn").click(function() {
            $.ajax({
                url: "{{ route('project-categories.store') }}",
                method: "POST",
                data: {
                    name: $("#category_name").val(),
                    icon_class: $("#category_icon").val(),
                    description: $("#category_description").val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(resp) {
                    $("#category-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    loadCategories();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $(".error_category_name").html(xhr.responseJSON.errors.name[0]);
                    }
                }
            });
        });

        // ========================= UTILITY FUNCTIONS =========================
        function showErrors(errors) {
            clearErrors();
            $.each(errors, function(key, value) {
                $(`.error_${key}`).html(value[0]);
            });
        }

        function clearErrors() {
            $(".text-danger[class^='error_']").html("");
        }
    </script>
@endpush
