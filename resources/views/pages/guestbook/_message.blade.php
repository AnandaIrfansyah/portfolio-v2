@php
    $initial = strtoupper(substr($msg->user->name ?? '?', 0, 1));
    $colors = [
        'linear-gradient(135deg, #6777ef 0%, #a855f7 100%)',
        'linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%)',
        'linear-gradient(135deg, #f59e0b 0%, #ef4444 100%)',
        'linear-gradient(135deg, #10b981 0%, #06b6d4 100%)',
        'linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%)',
    ];
    $colorIndex = $msg->guestbook_user_id ? $msg->guestbook_user_id % count($colors) : 0;
    $isOwn = $guestUser && $guestUser->id === $msg->guestbook_user_id;
    $userLiked = $guestUser && $msg->likes->contains('guestbook_user_id', $guestUser->id);
@endphp

<div class="message-card" id="message-{{ $msg->id }}">
    <div class="message-header">
        <div class="message-avatar" style="background: {{ $colors[$colorIndex] }}">
            @if ($msg->user?->avatar)
                <img src="{{ $msg->user->avatar }}" alt="{{ $msg->user->name }}">
            @else
                {{ $initial }}
            @endif
        </div>
        <div class="message-info">
            <div class="message-author">
                <span class="author-name">{{ $msg->user->name ?? 'Anonymous' }}</span>
                @if ($msg->is_author)
                    <span class="author-badge">Author</span>
                @endif
            </div>
            {{-- Tambah di message-header, setelah author-name --}}
            @if ($msg->is_pinned)
                <span style="font-size:0.7rem; color:#f59e0b;">
                    <i class="bi bi-pin-fill"></i> Pinned
                </span>
            @endif
            <div class="message-date">{{ $msg->created_at->format('d/m/Y, H:i') }}</div>
        </div>
    </div>

    <div class="message-content" id="content-{{ $msg->id }}">{{ $msg->message }}</div>

    {{-- Edit Form (hidden by default) --}}
    @if ($isOwn)
        <div class="edit-form" id="edit-form-{{ $msg->id }}">
            <textarea id="edit-textarea-{{ $msg->id }}">{{ $msg->message }}</textarea>
            <div class="edit-form-actions">
                <button class="btn-cancel-edit" onclick="cancelEdit({{ $msg->id }})">Cancel</button>
                <button class="btn-save-edit" onclick="saveEdit({{ $msg->id }})">Save</button>
            </div>
        </div>
    @endif

    <div class="message-actions">
        <button class="btn-like {{ $userLiked ? 'liked' : '' }}" id="like-btn-{{ $msg->id }}"
            onclick="toggleLike({{ $msg->id }})">
            <i class="bi {{ $userLiked ? 'bi-heart-fill' : 'bi-heart' }}"></i>
            <span id="like-count-{{ $msg->id }}">{{ $msg->likes->count() }}</span>
        </button>
        @if ($isOwn)
            <button class="btn-edit" onclick="startEdit({{ $msg->id }})"><i class="bi bi-pencil"></i>
                Edit</button>
            <button class="btn-delete-msg" onclick="deleteMessage({{ $msg->id }})"><i class="bi bi-trash"></i>
                Delete</button>
        @endif
    </div>

    {{-- Replies --}}
    @foreach ($msg->replies as $reply)
        @php
            $replyColorIndex = $reply->guestbook_user_id ? $reply->guestbook_user_id % count($colors) : 0;
        @endphp
        <div class="message-reply">
            <div class="reply-indicator">
                <i class="bi bi-reply-fill"></i>
                <span>Replied to {{ $msg->user->name ?? 'Anonymous' }}: "{{ Str::limit($msg->message, 40) }}"</span>
            </div>
            <div class="message-header">
                <div class="message-avatar" style="background: {{ $colors[$replyColorIndex] }}">
                    @if ($reply->user?->avatar)
                        <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}">
                    @else
                        {{ strtoupper(substr($reply->user->name ?? '?', 0, 1)) }}
                    @endif
                </div>
                <div class="message-info">
                    <div class="message-author">
                        <span class="author-name">{{ $reply->user->name ?? 'Anonymous' }}</span>
                        @if ($reply->is_author)
                            <span class="author-badge co-author-badge">Author</span>
                        @endif
                    </div>
                    <div class="message-date">{{ $reply->created_at->format('d/m/Y, H:i') }}</div>
                </div>
            </div>
            <div class="message-content">{{ $reply->message }}</div>
        </div>
    @endforeach
</div>
