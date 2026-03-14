@extends('layouts.app')
@section('title', 'Guestbook Management')
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: #fff;
            border-radius: 0.5rem;
            padding: 1.25rem;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
        }

        .stat-label {
            font-size: 0.8rem;
            color: #6c757d;
            text-transform: uppercase;
        }

        .message-card {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            background: #fff;
            overflow: hidden;
        }

        .message-card-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            cursor: pointer;
            transition: background 0.15s;
        }

        .message-card-header:hover {
            background: #f8f9fa;
        }

        .message-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: #6777ef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.875rem;
            flex-shrink: 0;
            overflow: hidden;
        }

        .message-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-badge {
            font-size: 0.7rem;
            padding: 0.15rem 0.5rem;
            border-radius: 999px;
            background: #6777ef;
            color: #fff;
        }

        .message-preview {
            font-size: 0.875rem;
            color: #6c757d;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 300px;
        }

        .message-card-body {
            padding: 0 1rem 1rem;
            border-top: 1px solid #f1f3f5;
            display: none;
        }

        .message-card-body.show {
            display: block;
        }

        .message-full {
            padding: 0.875rem 0;
            font-size: 0.9rem;
            color: #495057;
            border-bottom: 1px solid #f1f3f5;
        }

        .message-meta {
            font-size: 0.8rem;
            color: #6c757d;
            display: flex;
            gap: 1rem;
            padding: 0.5rem 0;
        }

        .reply-section {
            background: #f8f9fa;
            border-left: 3px solid #6777ef;
            padding: 0.875rem;
            border-radius: 0 0.375rem 0.375rem 0;
            margin-top: 0.75rem;
        }

        .reply-item {
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #dee2e6;
        }

        .reply-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .reply-form {
            margin-top: 0.75rem;
            display: none;
        }

        .card-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-left: auto;
            flex-shrink: 0;
        }

        .toggle-icon {
            transition: transform 0.2s;
            color: #6c757d;
        }

        .toggle-icon.open {
            transform: rotate(180deg);
        }
    </style>
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Guestbook Management</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Guestbook</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Manage Guestbook Messages</h2>
                <p class="section-lead">Lihat dan balas pesan dari pengunjung.</p>

                {{-- Stats --}}
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value text-primary">{{ $stats['total'] }}</div>
                        <div class="stat-label">Total Messages</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value text-success">{{ $stats['replies'] }}</div>
                        <div class="stat-label">Replies</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value text-info">{{ $stats['users'] }}</div>
                        <div class="stat-label">Unique Users</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        @forelse($messages as $msg)
                            <div class="message-card" id="admin-msg-{{ $msg->id }}">
                                {{-- Header (clickable untuk expand) --}}
                                <div class="message-card-header" onclick="toggleCard({{ $msg->id }})">
                                    <div class="message-avatar">
                                        @if ($msg->user?->avatar)
                                            <img src="{{ $msg->user->avatar }}" alt="">
                                        @else
                                            {{ strtoupper(substr($msg->user->name ?? '?', 0, 1)) }}
                                        @endif
                                    </div>
                                    <div style="flex:1; min-width:0;">
                                        <div class="d-flex align-items-center gap-2">
                                            <strong class="small">{{ $msg->user->name ?? 'Anonymous' }}</strong>
                                            @if ($msg->is_author)
                                                <span class="author-badge">Author</span>
                                            @endif
                                            <span class="text-muted" style="font-size:0.75rem">
                                                &nbsp; - &nbsp;<i
                                                    class="bi bi-{{ $msg->user?->provider === 'github' ? 'github' : 'google' }}"></i>
                                                {{ $msg->user?->provider ?? '' }}
                                            </span>
                                        </div>
                                        <div class="message-preview">{{ $msg->message }}</div>
                                    </div>
                                    <div class="card-actions" onclick="event.stopPropagation()">
                                        <span class="badge badge-light">
                                            <i class="bi bi-heart text-danger"></i> {{ $msg->likes->count() }}
                                        </span>
                                        <span class="badge badge-{{ $msg->replies->count() > 0 ? 'success' : 'light' }}">
                                            <i class="bi bi-reply"></i> {{ $msg->replies->count() }}
                                        </span>
                                        <small
                                            class="text-muted d-none d-md-block">{{ $msg->created_at->format('d M Y') }}</small>
                                        <button class="btn btn-primary btn-sm"
                                            onclick="toggleReplyForm({{ $msg->id }})">
                                            <i class="bi bi-reply"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm"
                                            onclick="adminDeleteMsg({{ $msg->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                    <i class="bi bi-chevron-down toggle-icon ml-2"
                                        id="toggle-icon-{{ $msg->id }}"></i>
                                </div>

                                {{-- Body (collapsed by default) --}}
                                <div class="message-card-body" id="card-body-{{ $msg->id }}">
                                    <div class="message-full">
                                        <div class="text-muted small mb-1">
                                            {{ $msg->user->email ?? '' }} · {{ $msg->created_at->format('d M Y, H:i') }}
                                        </div>
                                        {{ $msg->message }}
                                    </div>

                                    {{-- Replies --}}
                                    @if ($msg->replies->count() > 0)
                                        <div class="reply-section">
                                            @foreach ($msg->replies as $reply)
                                                <div class="reply-item" id="admin-reply-{{ $reply->id }}">
                                                    <div class="d-flex align-items-start gap-2">
                                                        <div class="message-avatar"
                                                            style="width:32px;height:32px;font-size:0.75rem;">
                                                            @if ($reply->user?->avatar)
                                                                <img src="{{ $reply->user->avatar }}" alt="">
                                                            @else
                                                                {{ strtoupper(substr($reply->user->name ?? '?', 0, 1)) }}
                                                            @endif
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <div class="d-flex align-items-center gap-1">
                                                                <strong
                                                                    class="small">{{ $reply->user->name ?? 'Anonymous' }}</strong>
                                                                @if ($reply->is_author)
                                                                    <span class="author-badge">Author</span>
                                                                @endif
                                                                <span
                                                                    class="text-muted small ml-auto">{{ $reply->created_at->format('d M Y, H:i') }}</span>
                                                            </div>
                                                            <div class="text-muted small mt-1">{{ $reply->message }}</div>
                                                        </div>
                                                        <button class="btn btn-danger btn-sm"
                                                            onclick="adminDeleteMsg({{ $reply->id }})">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    {{-- Reply Form --}}
                                    <div class="reply-form" id="reply-form-{{ $msg->id }}">
                                        <textarea class="form-control mt-2" id="reply-text-{{ $msg->id }}" rows="2" placeholder="Write a reply..."></textarea>
                                        <div class="mt-2 d-flex gap-2">
                                            <button class="btn btn-primary btn-sm"
                                                onclick="submitReply({{ $msg->id }})">
                                                <i class="bi bi-send"></i> Send Reply
                                            </button>
                                            <button class="btn btn-secondary btn-sm"
                                                onclick="toggleReplyForm({{ $msg->id }})">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <i class="bi bi-chat-square" style="font-size:3rem"></i>
                                <p class="mt-3">Belum ada pesan di guestbook.</p>
                            </div>
                        @endforelse

                        <div class="float-right mt-3">
                            {{ $messages->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
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
        const BASE = "{{ route('guestbooks.index') }}";

        // Toggle expand/collapse card
        function toggleCard(id) {
            const body = document.getElementById(`card-body-${id}`);
            const icon = document.getElementById(`toggle-icon-${id}`);
            body.classList.toggle('show');
            icon.classList.toggle('open');
        }

        // Toggle reply form — auto expand card dulu
        function toggleReplyForm(id) {
            const body = document.getElementById(`card-body-${id}`);
            const icon = document.getElementById(`toggle-icon-${id}`);
            const form = document.getElementById(`reply-form-${id}`);

            // Expand card kalau belum terbuka
            if (!body.classList.contains('show')) {
                body.classList.add('show');
                icon.classList.add('open');
            }

            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
            if (form.style.display === 'block') {
                document.getElementById(`reply-text-${id}`).focus();
            }
        }

        function submitReply(id) {
            const message = document.getElementById(`reply-text-${id}`).value.trim();
            if (!message) return Toast.fire({
                icon: 'error',
                title: 'Reply cannot be empty.'
            });

            fetch(`${BASE}/${id}/reply`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Reply sent!'
                        });
                        setTimeout(() => location.reload(), 700);
                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: data.message || 'Failed.'
                        });
                    }
                });
        }

        function adminDeleteMsg(id) {
            Swal.fire({
                title: 'Hapus pesan ini?',
                text: 'Tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal'
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`${BASE}/${id}/destroy`, {
                            method: 'DELETE',
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
                                setTimeout(() => location.reload(), 700);
                            }
                        });
                }
            });
        }
    </script>
@endpush
