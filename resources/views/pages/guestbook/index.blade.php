@extends('layouts.pages')
@section('title', 'Guestbook')
@push('styles')
    <style>
        .guestbook-header {
            text-align: center;
            padding: 3rem 0 2rem;
        }

        .guestbook-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.75rem;
        }

        .guestbook-subtitle {
            color: #9ca3af;
            font-size: 1rem;
            max-width: 500px;
            margin: 0 auto;
        }

        .highlight {
            color: #6777ef;
        }

        .guestbook-section {
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-header-left {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .section-icon {
            color: #6777ef;
            font-size: 1.25rem;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #fff;
            margin: 0;
        }

        .message-count {
            font-size: 0.875rem;
            color: #6c757d;
            background: #1f2937;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
        }

        /* Message Cards */
        .messages-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .message-card {
            background: #111827;
            border: 1px solid #1f2937;
            border-radius: 0.75rem;
            padding: 1.25rem;
            transition: border-color 0.2s;
        }

        .message-card:hover {
            border-color: #374151;
        }

        .message-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }

        .message-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 1rem;
            color: #fff;
            background: linear-gradient(135deg, #6777ef 0%, #a855f7 100%);
            flex-shrink: 0;
            overflow: hidden;
        }

        .message-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .message-info {
            flex: 1;
        }

        .message-author {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .author-name {
            font-weight: 600;
            color: #f3f4f6;
            font-size: 0.9rem;
        }

        .author-badge {
            font-size: 0.7rem;
            padding: 0.15rem 0.5rem;
            border-radius: 999px;
            background: #6777ef;
            color: #fff;
            font-weight: 600;
        }

        .co-author-badge {
            background: #10b981;
        }

        .message-date {
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.15rem;
        }

        .message-content {
            color: #d1d5db;
            font-size: 0.9rem;
            line-height: 1.6;
            word-break: break-word;
        }

        /* Message Actions */
        .message-actions {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 0.75rem;
            padding-top: 0.75rem;
            border-top: 1px solid #1f2937;
        }

        .btn-like {
            background: none;
            border: 1px solid #374151;
            color: #9ca3af;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.8rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 0.35rem;
            transition: all 0.2s;
        }

        .btn-like:hover {
            border-color: #ef4444;
            color: #ef4444;
        }

        .btn-like.liked {
            border-color: #ef4444;
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
        }

        .btn-edit,
        .btn-delete-msg {
            background: none;
            border: none;
            font-size: 0.8rem;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            transition: all 0.2s;
        }

        .btn-edit {
            color: #6777ef;
        }

        .btn-edit:hover {
            background: rgba(103, 119, 239, 0.1);
        }

        .btn-delete-msg {
            color: #ef4444;
        }

        .btn-delete-msg:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        /* Reply */
        .message-reply {
            margin-top: 1rem;
            padding: 1rem;
            background: #0f172a;
            border-radius: 0.5rem;
            border-left: 3px solid #6777ef;
        }

        .reply-indicator {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.75rem;
            color: #6c757d;
            margin-bottom: 0.75rem;
        }

        /* Edit form inline */
        .edit-form {
            display: none;
            margin-top: 0.75rem;
        }

        .edit-form textarea {
            width: 100%;
            background: #1f2937;
            border: 1px solid #374151;
            color: #f3f4f6;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-size: 0.875rem;
            resize: vertical;
            min-height: 80px;
        }

        .edit-form textarea:focus {
            outline: none;
            border-color: #6777ef;
        }

        .edit-form-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 0.5rem;
            justify-content: flex-end;
        }

        .btn-save-edit {
            background: #6777ef;
            color: #fff;
            border: none;
            padding: 0.35rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .btn-cancel-edit {
            background: #374151;
            color: #9ca3af;
            border: none;
            padding: 0.35rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.8rem;
            cursor: pointer;
        }

        /* Sign In / Write Message Section */
        .signin-section,
        .write-section {
            background: #111827;
            border: 1px solid #1f2937;
            border-radius: 0.75rem;
            padding: 1.5rem;
        }

        .signin-text {
            color: #9ca3af;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .signin-text a {
            color: #6777ef;
            text-decoration: none;
        }

        .signin-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-signin {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.25rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid #374151;
            color: #f3f4f6;
            background: #1f2937;
        }

        .btn-signin:hover {
            border-color: #6777ef;
            color: #6777ef;
            text-decoration: none;
        }

        /* Write form */
        .write-section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .logged-in-user {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #9ca3af;
        }

        .logged-in-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            overflow: hidden;
            background: linear-gradient(135deg, #6777ef 0%, #a855f7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: #fff;
        }

        .logged-in-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-logout {
            background: none;
            border: 1px solid #374151;
            color: #9ca3af;
            padding: 0.2rem 0.6rem;
            border-radius: 0.375rem;
            font-size: 0.75rem;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-logout:hover {
            border-color: #ef4444;
            color: #ef4444;
        }

        .write-textarea {
            width: 100%;
            background: #1f2937;
            border: 1px solid #374151;
            color: #f3f4f6;
            border-radius: 0.5rem;
            padding: 0.75rem;
            font-size: 0.875rem;
            resize: vertical;
            min-height: 100px;
            transition: border-color 0.2s;
        }

        .write-textarea:focus {
            outline: none;
            border-color: #6777ef;
        }

        .write-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.75rem;
        }

        .char-count {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .btn-submit-msg {
            background: #6777ef;
            color: #fff;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit-msg:hover {
            background: #5a67d8;
        }

        .btn-submit-msg:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        /* Pagination */
        .pagination-wrapper {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
        }

        /* Toast */
        .gb-toast {
            position: fixed;
            top: 1.5rem;
            right: 1.5rem;
            z-index: 9999;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            color: #fff;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s;
            pointer-events: none;
        }

        .gb-toast.show {
            opacity: 1;
            transform: translateY(0);
        }

        .gb-toast.success {
            background: #10b981;
        }

        .gb-toast.error {
            background: #ef4444;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
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
        <!-- Toast -->
        <div class="gb-toast" id="gbToast"></div>

        <!-- Guestbook Header -->
        <section class="guestbook-header">
            <h1 class="guestbook-title">Guest<span class="highlight">book</span></h1>
            <p class="guestbook-subtitle">
                Before you wander off, this corner was made for you to leave a trace after exploring what's here.
            </p>
        </section>

        <!-- Guestbook Messages Section -->
        <section class="guestbook-section">
            <div class="section-header">
                <div class="section-header-left">
                    <span class="section-icon"><i class="bi bi-chat-left-quote"></i></span>
                    <h2 class="section-title">Guestbook Messages</h2>
                </div>
                <span class="message-count" id="msgCount">{{ $totalMessages }} messages</span>
            </div>

            <!-- Messages List -->
            <div class="messages-list" id="messagesList">
                @forelse($messages as $msg)
                    @include('pages.guestbook._message', ['msg' => $msg, 'guestUser' => $guestUser])
                @empty
                    <div class="empty-state">
                        <i class="bi bi-chat-square"></i>
                        <p>No messages yet. Be the first to leave a note!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($messages->hasPages())
                <div class="pagination-wrapper">
                    {{ $messages->links('pagination::bootstrap-5') }}
                </div>
            @endif

            <!-- Sign In / Write Section -->
            @if (!$guestUser)
                <div class="signin-section">
                    <p class="signin-text">
                        Sign in to leave a message. Your information is safe.
                    </p>
                    <div class="signin-buttons">
                        <a href="{{ route('guestbook.auth.redirect', 'google') }}" class="btn-signin">
                            <i class="bi bi-google"></i>
                            <span>Sign in with Google</span>
                        </a>
                        <a href="{{ route('guestbook.auth.redirect', 'github') }}" class="btn-signin">
                            <i class="bi bi-github"></i>
                            <span>Sign in with GitHub</span>
                        </a>
                    </div>
                </div>
            @else
                <div class="write-section">
                    <div class="write-section-header">
                        <div class="logged-in-user">
                            <div class="logged-in-avatar">
                                @if ($guestUser->avatar)
                                    <img src="{{ $guestUser->avatar }}" alt="{{ $guestUser->name }}">
                                @else
                                    {{ strtoupper(substr($guestUser->name, 0, 1)) }}
                                @endif
                            </div>
                            <span>Signed in as <strong style="color:#f3f4f6">{{ $guestUser->name }}</strong></span>
                        </div>
                        <form action="{{ route('guestbook.logout') }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="btn-logout">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </div>
                    <textarea class="write-textarea" id="newMessage" placeholder="Leave your mark here..." maxlength="1000"></textarea>
                    <div class="write-actions">
                        <span class="char-count"><span id="charCount">0</span>/1000</span>
                        <button class="btn-submit-msg" id="submitMsgBtn" onclick="submitMessage()">
                            <i class="bi bi-send"></i> Send Message
                        </button>
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        const ROUTES = {
            store: "{{ route('guestbook.messages.store') }}",
            like: (id) => `/guestbook/messages/${id}/like`,
            update: (id) => `/guestbook/messages/${id}`,
            destroy: (id) => `/guestbook/messages/${id}`,
        };
        const CSRF = "{{ csrf_token() }}";
        const currentUserId = {{ $guestUser ? $guestUser->id : 'null' }};

        // ===== TOAST =====
        function showToast(message, type = 'success') {
            const toast = document.getElementById('gbToast');
            toast.textContent = message;
            toast.className = `gb-toast ${type} show`;
            setTimeout(() => toast.classList.remove('show'), 3000);
        }

        // ===== CHAR COUNT =====
        const newMsg = document.getElementById('newMessage');
        if (newMsg) {
            newMsg.addEventListener('input', function() {
                document.getElementById('charCount').textContent = this.value.length;
            });
        }

        // ===== SUBMIT MESSAGE =====
        function submitMessage() {
            const message = document.getElementById('newMessage').value.trim();
            if (!message) return showToast('Please write something first.', 'error');

            const btn = document.getElementById('submitMsgBtn');
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';

            fetch(ROUTES.store, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('newMessage').value = '';
                        document.getElementById('charCount').textContent = '0';
                        prependMessage(data.data);
                        updateCount(1);
                        showToast('Message sent!');
                    } else {
                        showToast(data.message || 'Failed to send.', 'error');
                    }
                })
                .catch(() => showToast('Something went wrong.', 'error'))
                .finally(() => {
                    btn.disabled = false;
                    btn.innerHTML = '<i class="bi bi-send"></i> Send Message';
                });
        }

        // ===== PREPEND MESSAGE TO LIST =====
        function prependMessage(msg) {
            const list = document.getElementById('messagesList');
            const emptyState = list.querySelector('.empty-state');
            if (emptyState) emptyState.remove();

            const html = buildMessageHTML(msg);
            list.insertAdjacentHTML('afterbegin', html);
        }

        function buildMessageHTML(msg) {
            const initial = msg.user ? msg.user.name.charAt(0).toUpperCase() : '?';
            const avatarHtml = msg.user?.avatar ?
                `<img src="${msg.user.avatar}" alt="${msg.user.name}">` :
                initial;
            const date = new Date(msg.created_at).toLocaleString('id-ID', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            const isOwn = msg.guestbook_user_id === currentUserId;

            return `
        <div class="message-card" id="message-${msg.id}">
            <div class="message-header">
                <div class="message-avatar">${avatarHtml}</div>
                <div class="message-info">
                    <div class="message-author">
                        <span class="author-name">${msg.user?.name ?? 'Anonymous'}</span>
                        ${msg.is_author ? '<span class="author-badge">Author</span>' : ''}
                    </div>
                    <div class="message-date">${date}</div>
                </div>
            </div>
            <div class="message-content" id="content-${msg.id}">${escapeHtml(msg.message)}</div>
            <div class="edit-form" id="edit-form-${msg.id}">
                <textarea id="edit-textarea-${msg.id}">${escapeHtml(msg.message)}</textarea>
                <div class="edit-form-actions">
                    <button class="btn-cancel-edit" onclick="cancelEdit(${msg.id})">Cancel</button>
                    <button class="btn-save-edit" onclick="saveEdit(${msg.id})">Save</button>
                </div>
            </div>
            <div class="message-actions">
                <button class="btn-like" id="like-btn-${msg.id}" onclick="toggleLike(${msg.id})">
                    <i class="bi bi-heart"></i>
                    <span id="like-count-${msg.id}">0</span>
                </button>
                ${isOwn ? `
                        <button class="btn-edit" onclick="startEdit(${msg.id})"><i class="bi bi-pencil"></i> Edit</button>
                        <button class="btn-delete-msg" onclick="deleteMessage(${msg.id})"><i class="bi bi-trash"></i> Delete</button>
                    ` : ''}
            </div>
        </div>`;
        }

        // ===== LIKE =====
        function toggleLike(id) {
            if (!currentUserId) return showToast('Please login to like.', 'error');

            fetch(ROUTES.like(id), {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        const btn = document.getElementById(`like-btn-${id}`);
                        const count = document.getElementById(`like-count-${id}`);
                        btn.classList.toggle('liked', data.liked);
                        btn.querySelector('i').className = data.liked ? 'bi bi-heart-fill' : 'bi bi-heart';
                        count.textContent = data.count;
                    }
                })
                .catch(() => showToast('Failed to like.', 'error'));
        }

        // ===== EDIT =====
        function startEdit(id) {
            document.getElementById(`content-${id}`).style.display = 'none';
            document.getElementById(`edit-form-${id}`).style.display = 'block';
        }

        function cancelEdit(id) {
            document.getElementById(`content-${id}`).style.display = 'block';
            document.getElementById(`edit-form-${id}`).style.display = 'none';
        }

        function saveEdit(id) {
            const message = document.getElementById(`edit-textarea-${id}`).value.trim();
            if (!message) return showToast('Message cannot be empty.', 'error');

            fetch(ROUTES.update(id), {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`content-${id}`).textContent = message;
                        cancelEdit(id);
                        showToast('Message updated!');
                    } else {
                        showToast(data.message || 'Failed to update.', 'error');
                    }
                })
                .catch(() => showToast('Something went wrong.', 'error'));
        }

        // ===== DELETE =====
        function deleteMessage(id) {
            if (!confirm('Delete this message?')) return;

            fetch(ROUTES.destroy(id), {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`message-${id}`).remove();
                        updateCount(-1);
                        showToast('Message deleted.');
                    } else {
                        showToast(data.message || 'Failed to delete.', 'error');
                    }
                })
                .catch(() => showToast('Something went wrong.', 'error'));
        }

        // ===== HELPERS =====
        function updateCount(delta) {
            const el = document.getElementById('msgCount');
            const current = parseInt(el.textContent);
            el.textContent = (current + delta) + ' messages';
        }

        function escapeHtml(text) {
            const div = document.createElement('div');
            div.appendChild(document.createTextNode(text));
            return div.innerHTML;
        }
    </script>
@endpush
