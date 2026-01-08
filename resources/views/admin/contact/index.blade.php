@extends('layouts.app')
@section('title', 'Contact Messages')

@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .status-badge {
            font-size: 0.75rem;
            padding: 0.35rem 0.65rem;
            font-weight: 500;
        }

        .message-preview {
            max-width: 400px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .stats-card {
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .modal-xl {
            max-width: 900px;
        }

        .contact-detail {
            line-height: 1.8;
        }

        .contact-detail .detail-row {
            display: flex;
            padding: 0.75rem 0;
            border-bottom: 1px solid #e9ecef;
        }

        .contact-detail .detail-row:last-child {
            border-bottom: none;
        }

        .contact-detail .detail-label {
            font-weight: 600;
            min-width: 120px;
            color: #495057;
        }

        .contact-detail .detail-value {
            flex: 1;
            color: #6c757d;
        }

        .message-content {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 0.375rem;
            border-left: 3px solid #6777ef;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        /* Checkbox styling */
        .contact-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        #selectAll {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        /* Bulk action bar */
        .bulk-action-bar {
            display: none;
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #fff;
            padding: 1rem 2rem;
            border-radius: 50px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            align-items: center;
            gap: 1rem;
        }

        .bulk-action-bar.show {
            display: flex;
        }

        .selected-count {
            font-weight: 600;
            color: #6777ef;
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            {{-- Page Header --}}
            <div class="section-header">
                <h1>Contact Messages</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active">
                        <a href="#">Dashboard</a>
                    </div>
                    <div class="breadcrumb-item">Contacts</div>
                </div>
            </div>

            <div class="section-body">
                {{-- Title --}}
                <h2 class="section-title">Manage Contact Messages</h2>
                <p class="section-lead">Lihat dan kelola pesan yang masuk dari pengunjung.</p>

                {{-- Statistics Cards --}}
                <div class="stats-card bg-white">
                    <div class="stats-grid">
                        <div class="stat-item">
                            <div class="stat-value text-primary">{{ $stats['total'] }}</div>
                            <div class="stat-label">Total Messages</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value text-danger">{{ $stats['unread'] }}</div>
                            <div class="stat-label">Unread</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value text-warning">{{ $stats['read'] }}</div>
                            <div class="stat-label">Read</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value text-success">{{ $stats['replied'] }}</div>
                            <div class="stat-label">Replied</div>
                        </div>
                    </div>
                </div>

                {{-- CARD --}}
                <div class="card">
                    <div class="card-body">
                        {{-- FILTERS --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select class="form-control" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>
                                        Unread
                                    </option>
                                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read
                                    </option>
                                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>
                                        Replied
                                    </option>
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
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search"
                                        placeholder="Search messages..." value="{{ request('search') }}">
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
                                        <th class="text-center text-white" width="3%">
                                            <input type="checkbox" id="selectAll">
                                        </th>
                                        <th class="text-center text-white" width="5%">No</th>
                                        <th class="text-white" width="20%">Name</th>
                                        <th class="text-white" width="15%">Email</th>
                                        <th class="text-white" width="35%">Message</th>
                                        <th class="text-center text-white" width="10%">Status</th>
                                        <th class="text-center text-white" width="10%">Date</th>
                                        <th class="text-center text-white" width="7%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = ($contacts->currentPage() - 1) * $contacts->perPage() + 1; @endphp
                                    @forelse ($contacts as $item)
                                        <tr class="{{ $item->status === 'unread' ? 'table-active' : '' }}">
                                            <td class="text-center">
                                                <input type="checkbox" class="contact-checkbox"
                                                    value="{{ $item->id }}">
                                            </td>
                                            <td class="text-center">{{ $no++ }}</td>
                                            <td>
                                                <strong>{{ $item->name }}</strong>
                                                @if ($item->status === 'unread')
                                                    <span class="badge badge-danger badge-sm ml-1">New</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="mailto:{{ $item->email }}">{{ $item->email }}</a>
                                            </td>
                                            <td>
                                                <div class="message-preview">{{ $item->message }}</div>
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $statusColors = [
                                                        'unread' => 'danger',
                                                        'read' => 'warning',
                                                        'replied' => 'success',
                                                    ];
                                                @endphp
                                                <span class="badge badge-{{ $statusColors[$item->status] }} status-badge">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <small>{{ $item->created_at->format('d M Y') }}</small><br>
                                                <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-info btn-sm"
                                                    onclick="viewModal('{{ $item->id }}')">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="deleteItem('{{ $item->id }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada pesan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="float-right">
                            {{ $contacts->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Bulk Action Bar --}}
    <div class="bulk-action-bar" id="bulkActionBar">
        <span class="selected-count" id="selectedCount">0 selected</span>
        <button class="btn btn-danger btn-sm" onclick="bulkDelete()">
            <i class="fas fa-trash"></i> Delete Selected
        </button>
        <button class="btn btn-secondary btn-sm" onclick="clearSelection()">
            <i class="fas fa-times"></i> Cancel
        </button>
    </div>
@endsection

{{-- ====================== MODAL VIEW DETAIL ====================== --}}
@push('modal')
    <div class="modal fade" id="view-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-envelope-open"></i> Contact Message Detail
                    </h5>
                    <button class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body" id="viewContent">
                    <div class="text-center py-5">
                        <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
                        <p class="mt-3">Loading...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-tag"></i> Change Status
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" onclick="changeStatus('unread')">
                                <span class="badge badge-danger">Unread</span>
                            </a>
                            <a class="dropdown-item" href="#" onclick="changeStatus('read')">
                                <span class="badge badge-warning">Read</span>
                            </a>
                            <a class="dropdown-item" href="#" onclick="changeStatus('replied')">
                                <span class="badge badge-success">Replied</span>
                            </a>
                        </div>
                    </div>
                    <button class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endpush

{{-- ====================== JAVASCRIPT ====================== --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2000
        });

        const BASE = "{{ route('contacts.index') }}";
        let currentContactId = null;

        // Sort & Filter
        $("#sort, #statusFilter").change(function() {
            let url = BASE + "?sort=" + $("#sort").val();
            if ($("#statusFilter").val()) url += "&status=" + $("#statusFilter").val();
            window.location.href = url;
        });

        // View Modal
        function viewModal(id) {
            currentContactId = id;
            $("#viewContent").html(`
                <div class="text-center py-5">
                    <i class="fas fa-spinner fa-spin fa-3x text-primary"></i>
                    <p class="mt-3">Loading...</p>
                </div>
            `);
            $("#view-modal").modal("show");

            $.ajax({
                url: `${BASE}/${id}/show`,
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
                    let statusColors = {
                        'unread': 'danger',
                        'read': 'warning',
                        'replied': 'success'
                    };

                    let html = `
                        <div class="contact-detail">
                            <div class="detail-row">
                                <div class="detail-label">Name:</div>
                                <div class="detail-value"><strong>${d.name}</strong></div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Email:</div>
                                <div class="detail-value">
                                    <a href="mailto:${d.email}">${d.email}</a>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Status:</div>
                                <div class="detail-value">
                                    <span class="badge badge-${statusColors[d.status]} status-badge">
                                        ${d.status.charAt(0).toUpperCase() + d.status.slice(1)}
                                    </span>
                                </div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">Date:</div>
                                <div class="detail-value">${new Date(d.created_at).toLocaleString()}</div>
                            </div>
                            <div class="detail-row">
                                <div class="detail-label">IP Address:</div>
                                <div class="detail-value">${d.ip_address || 'N/A'}</div>
                            </div>
                            <hr class="my-4">
                            <div class="detail-label mb-2">Message:</div>
                            <div class="message-content">${d.message}</div>
                        </div>
                    `;

                    $("#viewContent").html(html);
                },
                error: function() {
                    $("#viewContent").html(`
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-triangle"></i> Gagal memuat detail pesan.
                        </div>
                    `);
                }
            });
        }

        // Change Status
        function changeStatus(status) {
            if (!currentContactId) return;

            $.ajax({
                url: `${BASE}/${currentContactId}/update-status`,
                method: "POST",
                data: {
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function(resp) {
                    Toast.fire({
                        icon: "success",
                        title: resp.message
                    });
                    $("#view-modal").modal("hide");
                    setTimeout(() => location.reload(), 700);
                },
                error: function() {
                    Toast.fire({
                        icon: "error",
                        title: "Gagal mengubah status"
                    });
                }
            });
        }

        // Delete Item
        function deleteItem(id) {
            Swal.fire({
                title: "Hapus Pesan?",
                text: "Data tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
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
                        },
                        error: function() {
                            Toast.fire({
                                icon: "error",
                                title: "Gagal menghapus pesan"
                            });
                        }
                    });
                }
            });
        }

        // ====================== BULK ACTIONS ======================
        const selectedIds = new Set();

        // Select All Checkbox
        $("#selectAll").change(function() {
            const isChecked = $(this).is(':checked');
            $(".contact-checkbox").prop('checked', isChecked);

            if (isChecked) {
                $(".contact-checkbox").each(function() {
                    selectedIds.add($(this).val());
                });
            } else {
                selectedIds.clear();
            }
            updateBulkActionBar();
        });

        // Individual Checkbox
        $(document).on('change', '.contact-checkbox', function() {
            const id = $(this).val();
            if ($(this).is(':checked')) {
                selectedIds.add(id);
            } else {
                selectedIds.delete(id);
                $("#selectAll").prop('checked', false);
            }
            updateBulkActionBar();
        });

        // Update Bulk Action Bar
        function updateBulkActionBar() {
            const count = selectedIds.size;
            if (count > 0) {
                $("#bulkActionBar").addClass('show');
                $("#selectedCount").text(`${count} selected`);
            } else {
                $("#bulkActionBar").removeClass('show');
            }
        }

        // Clear Selection
        function clearSelection() {
            selectedIds.clear();
            $(".contact-checkbox, #selectAll").prop('checked', false);
            updateBulkActionBar();
        }

        // Bulk Delete
        function bulkDelete() {
            if (selectedIds.size === 0) {
                Toast.fire({
                    icon: "error",
                    title: "Pilih minimal 1 pesan"
                });
                return;
            }

            Swal.fire({
                title: `Hapus ${selectedIds.size} Pesan?`,
                text: "Data tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            }).then(result => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `${BASE}/bulk-delete`,
                        method: "POST",
                        data: {
                            ids: Array.from(selectedIds),
                            _token: "{{ csrf_token() }}"
                        },
                        success: resp => {
                            Toast.fire({
                                icon: "success",
                                title: resp.message
                            });
                            setTimeout(() => location.reload(), 700);
                        },
                        error: function() {
                            Toast.fire({
                                icon: "error",
                                title: "Gagal menghapus pesan"
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
