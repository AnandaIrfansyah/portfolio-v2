@extends('layouts.app')
@section('title', 'Publications')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        .publication-type-badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }

        .author-list {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .tag-badge {
            font-size: 0.75rem;
            margin-right: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .featured-star {
            color: #ffc107;
        }

        .modal-lg {
            max-width: 900px;
        }

        .author-item {
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

        .author-order-input {
            width: 70px;
            text-align: center;
        }

        .author-item:hover {
            background: #f8f9fa;
            border-color: #adb5bd;
        }

        .author-info {
            flex: 1;
        }

        .author-info strong {
            font-size: 0.95rem;
            color: #495057;
        }

        .author-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .author-order-label {
            font-size: 0.8rem;
            color: #6c757d;
            margin-right: 0.25rem;
        }

        /* Modal auto-height based on content */
        #publication-modal .modal-dialog {
            display: flex;
            align-items: center;
            min-height: calc(100vh - 3.5rem);
        }

        #publication-modal .modal-content {
            width: 100%;
            max-height: calc(100vh - 3.5rem);
            display: flex;
            flex-direction: column;
        }

        #publication-modal .modal-body {
            flex: 1;
            overflow-y: auto;
            max-height: calc(100vh - 200px);
        }

        #publication-modal .modal-footer {
            flex-shrink: 0;
            border-top: 1px solid #dee2e6;
        }

        /* Authors & Tags list dengan scroll jika panjang */
        #authorsList,
        #tagsList {
            max-height: 300px;
            overflow-y: auto;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            {{-- Page Header --}}
            <div class="section-header">
                <h1>Publications</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="#">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Publications</div>
                </div>
            </div>

            <div class="section-body">
                {{-- Title --}}
                <h2 class="section-title">Manage Publications</h2>
                <p class="section-lead">Kelola daftar publikasi penelitian, paper, dan karya ilmiah kamu.</p>

                {{-- CARD --}}
                <div class="card">
                    <div class="card-header">
                        <a href="javascript:void(0)" onclick="openModal()" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Tambah Publikasi
                        </a>
                    </div>
                    <div class="card-body">
                        {{-- FILTERS --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control" id="typeFilter">
                                    <option value="">Semua Tipe</option>
                                    <option value="journal" {{ request('type') == 'journal' ? 'selected' : '' }}>Journal
                                    </option>
                                    <option value="conference" {{ request('type') == 'conference' ? 'selected' : '' }}>
                                        Conference</option>
                                    <option value="preprint" {{ request('type') == 'preprint' ? 'selected' : '' }}>Preprint
                                    </option>
                                    <option value="thesis" {{ request('type') == 'thesis' ? 'selected' : '' }}>Thesis
                                    </option>
                                    <option value="book_chapter" {{ request('type') == 'book_chapter' ? 'selected' : '' }}>
                                        Book Chapter</option>
                                    <option value="workshop" {{ request('type') == 'workshop' ? 'selected' : '' }}>Workshop
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>
                                        Published</option>
                                    <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>
                                        Accepted</option>
                                    <option value="under_review"
                                        {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
                                    <option value="preprint" {{ request('status') == 'preprint' ? 'selected' : '' }}>
                                        Preprint</option>
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
                                <input type="hidden" name="type" value="{{ request('type') }}">
                                <input type="hidden" name="status" value="{{ request('status') }}">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="Search publications..." value="{{ request('search') }}">
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
                                        <th class="text-white" width="35%">Title</th>
                                        <th class="text-white" width="15%">Authors</th>
                                        <th class="text-center text-white" width="10%">Type</th>
                                        <th class="text-center text-white" width="10%">Year</th>
                                        <th class="text-center text-white" width="10%">Status</th>
                                        <th class="text-center text-white" width="5%">Featured</th>
                                        <th class="text-center text-white" width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = ($publications->currentPage() - 1) * $publications->perPage() + 1; @endphp
                                    @forelse ($publications as $item)
                                        <tr>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>
                                                <strong>{{ $item->title }}</strong>
                                                @if ($item->venue)
                                                    <br><small class="text-muted">{{ $item->venue }}</small>
                                                @endif
                                                @if ($item->tags->count() > 0)
                                                    <br>
                                                    @foreach ($item->tags as $tag)
                                                        <span class="badge badge-info tag-badge">{{ $tag->name }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td class="author-list">
                                                {{ $item->authors_string }}
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-secondary publication-type-badge">
                                                    {{ ucfirst(str_replace('_', ' ', $item->publication_type)) }}
                                                </span>
                                            </td>
                                            <td class="text-center">{{ $item->formatted_date }}</td>
                                            <td class="text-center">
                                                @php
                                                    $statusColors = [
                                                        'published' => 'success',
                                                        'accepted' => 'info',
                                                        'under_review' => 'warning',
                                                        'preprint' => 'secondary',
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
                                                <button class="btn btn-info btn-sm"
                                                    onclick="viewModal('{{ $item->id }}')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm"
                                                    onclick="editModal('{{ $item->id }}')">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleteItem('{{ $item->id }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data publikasi.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="float-right">
                            {{ $publications->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

{{-- ====================== MODAL CREATE/EDIT ====================== --}}
@push('modal')
    {{-- MODAL CREATE/EDIT --}}
    <div class="modal fade" id="publication-modal" tabindex="-1" role="dialog">
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
                        <ul class="nav nav-tabs" id="publicationTabs" role="tablist">
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
                                <a class="nav-link" id="authors-tab" data-toggle="tab" href="#authors-section"
                                    role="tab">
                                    <i class="fas fa-users"></i> Authors & Tags
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="links-tab" data-toggle="tab" href="#links-section"
                                    role="tab">
                                    <i class="fas fa-link"></i> Links & Media
                                </a>
                            </li>
                        </ul>

                        {{-- TABS CONTENT --}}
                        <div class="tab-content mt-3" id="publicationTabsContent">
                            {{-- TAB 1: BASIC INFO --}}
                            <div class="tab-pane fade show active" id="basic" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- Title --}}
                                        <div class="form-group">
                                            <label>Title <span class="text-danger">*</span></label>
                                            <input type="text" id="title" class="form-control"
                                                placeholder="Judul publikasi">
                                            <span class="text-danger error_title"></span>
                                        </div>

                                        {{-- Publication Type --}}
                                        <div class="form-group">
                                            <label>Publication Type <span class="text-danger">*</span></label>
                                            <select id="publication_type" class="form-control">
                                                <option value="">Pilih Tipe</option>
                                                <option value="journal">Journal</option>
                                                <option value="conference">Conference</option>
                                                <option value="preprint">Preprint</option>
                                                <option value="thesis">Thesis</option>
                                                <option value="book_chapter">Book Chapter</option>
                                                <option value="workshop">Workshop</option>
                                            </select>
                                            <span class="text-danger error_publication_type"></span>
                                        </div>

                                        {{-- Venue --}}
                                        <div class="form-group">
                                            <label>Venue (Journal/Conference Name)</label>
                                            <input type="text" id="venue" class="form-control"
                                                placeholder="Contoh: IEEE Transactions">
                                            <span class="text-danger error_venue"></span>
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

                                        {{-- Status --}}
                                        <div class="form-group">
                                            <label>Status <span class="text-danger">*</span></label>
                                            <select id="status" class="form-control">
                                                <option value="">Pilih Status</option>
                                                <option value="published">Published</option>
                                                <option value="accepted">Accepted</option>
                                                <option value="under_review">Under Review</option>
                                                <option value="preprint">Preprint</option>
                                            </select>
                                            <span class="text-danger error_status"></span>
                                        </div>

                                        {{-- Citation Count --}}
                                        <div class="form-group">
                                            <label>Citation Count</label>
                                            <input type="number" id="citation_count" class="form-control"
                                                value="0" min="0">
                                        </div>

                                        {{-- Is Featured --}}
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="is_featured">
                                                <label class="custom-control-label" for="is_featured">
                                                    <i class="fas fa-star text-warning"></i> Featured Publication
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- TAB 2: CONTENT --}}
                            <div class="tab-pane fade" id="content-section" role="tabpanel">
                                {{-- Abstract --}}
                                <div class="form-group">
                                    <label>Abstract <span class="text-danger">*</span></label>
                                    <textarea id="abstract" class="form-control" rows="5" placeholder="Ringkasan publikasi..."></textarea>
                                    <span class="text-danger error_abstract"></span>
                                </div>

                                {{-- Content --}}
                                <div class="form-group">
                                    <label>Full Content (Optional)</label>
                                    <textarea id="content" class="form-control" rows="8" placeholder="Isi lengkap publikasi (bisa HTML)..."></textarea>
                                    <span class="text-danger error_content"></span>
                                    <small class="text-muted">Tip: Kamu bisa pakai HTML tags untuk formatting</small>
                                </div>
                            </div>

                            {{-- TAB 3: AUTHORS & TAGS --}}
                            <div class="tab-pane fade" id="authors-section" role="tabpanel">
                                {{-- Authors Section --}}
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label>Authors <span class="text-danger">*</span></label>
                                        <div class="input-group-append mb-2" style="position: static;">
                                            <button type="button" class="btn btn-primary btn-sm mr-2"
                                                onclick="addAuthor()">
                                                <i class="fas fa-plus"></i> Add
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="openAuthorModal()">
                                                <i class="fas fa-user-plus"></i> New
                                            </button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-2">
                                        <select id="authorSelect" class="form-control select2">
                                            <option value="">Pilih Author...</option>
                                        </select>
                                    </div>
                                    <span class="text-danger error_authors"></span>
                                    <div id="authorsList" style="max-height: 300px; overflow-y: auto;"></div>
                                </div>

                                <hr>

                                {{-- Tags Section --}}
                                <div class="form-group">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label>Tags</label>
                                        <div class="input-group-append mb-2" style="position: static;">
                                            <button type="button" class="btn btn-primary btn-sm mr-2"
                                                onclick="addTag()">
                                                <i class="fas fa-plus"></i> Add
                                            </button>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="openTagModal()">
                                                <i class="fas fa-tag"></i> New Tag
                                            </button>
                                        </div>
                                    </div>
                                    <div class="input-group mb-2">
                                        <select id="tagSelect" class="form-control select2">
                                            <option value="">Pilih Tag...</option>
                                        </select>
                                    </div>
                                    <span class="text-danger error_tags"></span>
                                    <div id="tagsList" style="max-height: 300px; overflow-y: auto;"></div>
                                </div>
                            </div>

                            {{-- TAB 4: LINKS & MEDIA --}}
                            <div class="tab-pane fade" id="links-section" role="tabpanel">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{-- DOI --}}
                                        <div class="form-group">
                                            <label>DOI</label>
                                            <input type="text" id="doi" class="form-control"
                                                placeholder="10.1109/CVPR.2024.12345">
                                            <span class="text-danger error_doi"></span>
                                        </div>

                                        {{-- URL --}}
                                        <div class="form-group">
                                            <label>Publication URL</label>
                                            <input type="url" id="url" class="form-control"
                                                placeholder="https://example.com/paper">
                                            <span class="text-danger error_url"></span>
                                        </div>

                                        {{-- PDF URL --}}
                                        <div class="form-group">
                                            <label>PDF URL</label>
                                            <input type="url" id="pdf_url" class="form-control"
                                                placeholder="https://example.com/paper.pdf">
                                            <span class="text-danger error_pdf_url"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        {{-- Featured Image --}}
                                        <div class="form-group">
                                            <label>Featured Image</label>
                                            <input type="file" id="featured_image" class="form-control"
                                                accept="image/*">
                                            <span class="text-danger error_featured_image"></span>
                                            <small class="text-muted">Max 2MB (JPEG, PNG, JPG, WEBP)</small>
                                            <div id="imagePreview" class="mt-3"></div>
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

    {{-- MODAL VIEW DETAIL --}}
    <div class="modal fade" id="view-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-file-alt"></i> Publication Detail
                    </h5>
                    <button class="close text-white" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" id="viewContent">
                    <!-- Content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL ADD AUTHOR --}}
    <div class="modal fade" id="author-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-user-plus"></i> Tambah Author Baru
                    </h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="authorForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Author</label>
                            <input type="text" id="author_name" class="form-control" placeholder="Contoh: John Doe">
                            <span class="text-danger error_author_name"></span>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="saveAuthorBtn">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL ADD TAG --}}
    <div class="modal fade" id="tag-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-tag"></i> Tambah Tag Baru
                    </h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <form id="tagForm">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Tag</label>
                            <input type="text" id="tag_name" class="form-control"
                                placeholder="Contoh: Machine Learning">
                            <span class="text-danger error_tag_name"></span>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button class="btn btn-primary" id="saveTagBtn">
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

        const BASE = "{{ route('publications.index') }}";
        let selectedAuthors = [];
        let selectedTags = [];

        // Initialize Select2
        $(document).ready(function() {
            loadAuthors();
            loadTags();

            $('#publicationTabs a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                $('#publication-modal').modal('handleUpdate');
            }); 
        });

        // Sort & Filter
        $("#sort, #typeFilter, #statusFilter").change(function() {
            let url = BASE + "?sort=" + $(" #sort ").val();
            if ($("#typeFilter").val()) url += "&type=" + $(" #typeFilter ").val();
            if ($("#statusFilter").val()) url += "&status=" + $(" #statusFilter ").val();
            window.location.href = url;
        });

        // Load Authors for Select2
        function loadAuthors() {
            $.ajax({
                url: "{{ route('authors.list') }}",
                method: "GET",
                success: function(resp) {
                    let options = '<option value="">Pilih Author...</option>';
                    resp.data.forEach(author => {
                        options += `<option value="${author.id}">${author.name}</option>`;
                    });
                    $("#authorSelect").html(options);
                }
            });
        }

        // Load Tags for Select2
        function loadTags() {
            $.ajax({
                url: "{{ route('tags.list') }}",
                method: "GET",
                success: function(resp) {
                    let options = '<option value="">Pilih Tag...</option>';
                    resp.data.forEach(tag => {
                        options += `<option value="${tag.id}">${tag.name}</option>`;
                    });
                    $("#tagSelect").html(options);
                }
            });
        }

        function addTag() {
            let tagId = $("#tagSelect").val();
            let tagName = $("#tagSelect option:selected").text();

            if (!tagId) {
                Toast.fire({
                    icon: "error",
                    title: "Pilih tag terlebih dahulu"
                });
                return;
            }

            // Check if already added
            if (selectedTags.find(t => t.id == tagId)) {
                Toast.fire({
                    icon: "error",
                    title: "Tag sudah ditambahkan"
                });
                return;
            }

            selectedTags.push({
                id: tagId,
                name: tagName
            });

            renderTagsList();
        }

        function renderTagsList() {
            let html = '';
            selectedTags.forEach((tag, index) => {
                html += `
                    <div class="author-item">
                        <div class="author-info">
                            <span class="badge badge-info" style="font-size: 0.9rem; padding: 0.5rem 0.75rem;">
                                <i class="fas fa-tag mr-1"></i> ${tag.name}
                            </span>
                        </div>
                        <div class="author-actions">
                            <button type="button" class="btn btn-danger btn-sm" onclick="removeTag(${index})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            });

            if (selectedTags.length === 0) {
                html = '<div class="alert alert-info mb-0">Belum ada tag yang ditambahkan.</div>';
            }

            $("#tagsList").html(html);
        }

        // Remove Tag
        function removeTag(index) {
            selectedTags.splice(index, 1);
            renderTagsList();
        }

        // Open Create Modal
        function openModal() {
            $("#publication-modal").modal("show");
            $(".modal-title").html("Tambah Publikasi");
            $("#type").val("create");
            $("#id").val("");
            $("#form")[0].reset();
            $("#is_featured").prop("checked", false);
            selectedAuthors = [];
            selectedTags = []; // TAMBAHKAN INI
            $("#authorsList").html("");
            $("#tagsList").html(""); // TAMBAHKAN INI
            $("#imagePreview").html("");
            clearErrors();
        }

        // Add Author to List
        function addAuthor() {
            let authorId = $("#authorSelect").val();
            let authorName = $("#authorSelect option:selected").text();

            if (!authorId) {
                Toast.fire({
                    icon: "error",
                    title: "Pilih author terlebih dahulu"
                });
                return;
            }

            // Check if already added
            if (selectedAuthors.find(a => a.id == authorId)) {
                Toast.fire({
                    icon: "error",
                    title: "Author sudah ditambahkan"
                });
                return;
            }

            let order = selectedAuthors.length + 1;
            selectedAuthors.push({
                id: authorId,
                name: authorName,
                order: order
            });
            renderAuthorsList();
        }

        // Render Authors List
        function renderAuthorsList() {
            let html = '';
            selectedAuthors.forEach((author, index) => {
                html += `
            <div class="author-item">
                <div class="author-info">
                    <strong>${author.name}</strong>
                </div>
                <div class="author-actions">
                    <span class="author-order-label">Order:</span>
                    <input type="number" class="form-control form-control-sm author-order-input"
                        value="${author.order}" min="1"
                        onchange="updateAuthorOrder(${index}, this.value)">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeAuthor(${index})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
            });

            if (selectedAuthors.length === 0) {
                html = '<div class="alert alert-info mb-0">Belum ada author yang ditambahkan.</div>';
            }

            $("#authorsList").html(html);
        }

        // Update Author Order
        function updateAuthorOrder(index, newOrder) {
            selectedAuthors[index].order = parseInt(newOrder);
        }

        // Remove Author
        function removeAuthor(index) {
            selectedAuthors.splice(index, 1);
            renderAuthorsList();
        }

        // Preview Image
        $("#featured_image").change(function() {
            let file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $("#imagePreview").html(
                        `<img src="${e.target.result}" class="img-thumbnail" style="max-width: 200px">`);
                }
                reader.readAsDataURL(file);
            }
        });

        // Store/Update Publication
        $("#storeBtn").click(function() {
            let type = $("#type").val();
            let id = $("#id").val();
            let url = type === "create" ? "{{ route('publications.store') }}" : `/publications/${id}/update`;

            let formData = new FormData();
            formData.append('title', $("#title").val());
            formData.append('publication_type', $("#publication_type").val());
            formData.append('venue', $("#venue").val());
            formData.append('year', $("#year").val());
            formData.append('month', $("#month").val());
            formData.append('abstract', $("#abstract").val());
            formData.append('content', $("#content").val());
            formData.append('doi', $("#doi").val());
            formData.append('url', $("#url").val());
            formData.append('pdf_url', $("#pdf_url").val());
            formData.append('status', $("#status").val());
            formData.append('is_featured', $("#is_featured").is(':checked') ? 1 : 0);
            formData.append('citation_count', $("#citation_count").val() || 0);

            // Authors
            selectedAuthors.forEach((author, index) => {
                formData.append(`authors[${index}][id]`, author.id);
                formData.append(`authors[${index}][order]`, author.order);
            });

            // Tags
            selectedTags.forEach((tag, index) => {
                formData.append(`tags[${index}]`, tag.id);
            });

            // Image
            if ($("#featured_image")[0].files[0]) {
                formData.append('featured_image', $("#featured_image")[0].files[0]);
            }

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
                    $("#publication-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    setTimeout(() => location.reload(), 800);
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        showErrors(xhr.responseJSON.errors);
                        Toast.fire({
                            icon: "error",
                            title: "Periksa input kamu."
                        });
                    }
                }
            });
        });

        // Edit Modal
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
                    $("#publication_type").val(d.publication_type);
                    $("#venue").val(d.venue);
                    $("#year").val(d.year);
                    $("#month").val(d.month);
                    $("#abstract").val(d.abstract);
                    $("#content").val(d.content);
                    $("#doi").val(d.doi);
                    $("#url").val(d.url);
                    $("#pdf_url").val(d.pdf_url);
                    $("#status").val(d.status);
                    $("#citation_count").val(d.citation_count);
                    $("#is_featured").prop("checked", d.is_featured);
                    // Load authors
                    selectedAuthors = d.authors.map(author => ({
                        id: author.id,
                        name: author.name,
                        order: author.pivot.author_order
                    }));
                    renderAuthorsList();

                    // Load tags
                    selectedTags = d.tags.map(tag => ({
                        id: tag.id,
                        name: tag.name
                    }));
                    renderTagsList();

                    // Load image preview
                    if (d.featured_image) {
                        $("#imagePreview").html(
                            `<img src="/storage/${d.featured_image}" class="img-thumbnail" style="max-width: 200px">`
                        );
                    }

                    $("#publication-modal").modal("show");
                    $(".modal-title").html("Edit Publikasi");
                }
            });
        }

        // View Modal
        function viewModal(id) {
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
                    let html = `
                    <div class="row">
                        <div class="col-md-12">
                            <h4>${d.title}</h4>
                            <p class="text-muted">
                                <strong>Authors:</strong> ${d.authors.map(a => a.name).join(', ')}<br>
                                <strong>Type:</strong> ${d.publication_type}<br>
                                <strong>Year:</strong> ${d.formatted_date || d.year}<br>
                                ${d.venue ? `<strong>Venue:</strong> ${d.venue}<br>` : ''}
                                ${d.doi ? `<strong>DOI:</strong> ${d.doi}<br>` : ''}
                                <strong>Status:</strong> ${d.status}
                            </p>
                            ${d.featured_image ? `<img src="/storage/${d.featured_image}" class="img-fluid mb-3">` : ''}
                            <h5>Abstract</h5>
                            <p>${d.abstract}</p>
                            ${d.tags.length > 0 ? `
                                                                                                                                <div class="mt-3">
                                                                                                                                    <strong>Tags:</strong><br>
                                                                                                                                    ${d.tags.map(t => `<span class="badge badge-info">${t.name}</span>`).join(' ')}
                                                                                                                                </div>
                                                                                                                            ` : ''}
                        </div>
                    </div>
                `;
                    $("#viewContent").html(html);
                    $("#view-modal").modal("show");
                }
            });
        }

        // Delete
        function deleteItem(id) {
            Swal.fire({
                title: "Hapus Publikasi?",
                text: "Data tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/publications/${id}/destroy`,
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

        // Open Author Modal
        function openAuthorModal() {
            $("#author-modal").modal("show");
            $("#author_name").val("");
            $(".error_author_name").html("");
        }

        // Save Author
        $("#saveAuthorBtn").click(function() {
            $.ajax({
                url: "{{ route('authors.store') }}",
                method: "POST",
                data: {
                    name: $("#author_name").val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(resp) {
                    $("#author-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    loadAuthors();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $(".error_author_name").html(xhr.responseJSON.errors.name[0]);
                    }
                }
            });
        });

        // Open Tag Modal
        function openTagModal() {
            $("#tag-modal").modal("show");
            $("#tag_name").val("");
            $(".error_tag_name").html("");
        }

        // Save Tag
        $("#saveTagBtn").click(function() {
            $.ajax({
                url: "{{ route('tags.store') }}",
                method: "POST",
                data: {
                    name: $("#tag_name").val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(resp) {
                    $("#tag-modal").modal("hide");
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    loadTags();
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        $(".error_tag_name").html(xhr.responseJSON.errors.name[0]);
                    }
                }
            });
        });

        // Show Validation Errors
        function showErrors(errors) {
            clearErrors();
            $.each(errors, function(key, value) {
                $(`.error_${key}`).html(value[0]);
            });
        }

        // Clear Errors
        function clearErrors() {
            $(".text-danger[class^='error_']").html("");
        }
    </script>
@endpush
