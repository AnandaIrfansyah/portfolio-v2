@extends('layouts.pages')

@section('title', 'Contact')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- Guestbook Header -->
        <section class="guestbook-header">
            <h1 class="guestbook-title">
                Guest<span class="highlight">book</span>
            </h1>
            <p class="guestbook-subtitle">
                Before you wander off, this corner was made for you to leave a trace after exploring what's here.
            </p>
        </section>

        <!-- Guestbook Messages Section -->
        <section class="guestbook-section">
            <div class="section-header">
                <div class="section-header-left">
                    <span class="section-icon">
                        <i class="bi bi-chat-left-quote"></i>
                    </span>
                    <h2 class="section-title">Guestbook Messages</h2>
                </div>

                <span class="message-count">13 messages</span>
            </div>

            <!-- Messages List -->
            <div class="messages-list">
                <!-- Message 1 - Author -->
                <div class="message-card">
                    <div class="message-header">
                        <div class="message-avatar">A</div>
                        <div class="message-info">
                            <div class="message-author">
                                <span class="author-name">Ananda Irfansyah</span>
                                <span class="author-badge">Author</span>
                            </div>
                            <div class="message-date">16/06/2025, 15:28</div>
                        </div>
                    </div>
                    <div class="message-content">
                        Hi everyone! Thanks for stopping by my website! Feel free to share your thoughts,
                        suggestions, questions, or anything else in the comments below. 😊
                    </div>
                </div>

                <!-- Message 2 -->
                <div class="message-card">
                    <div class="message-header">
                        <div class="message-avatar" style="background: linear-gradient(135deg, #ec4899 0%, #8b5cf6 100%);">D
                        </div>
                        <div class="message-info">
                            <div class="message-author">
                                <span class="author-name">Dian Manurung</span>
                            </div>
                            <div class="message-date">13/07/2025, 12:21</div>
                        </div>
                    </div>
                    <div class="message-content">
                        gg brok
                    </div>

                    <!-- Reply -->
                    <div class="message-reply">
                        <div class="reply-indicator">
                            <i class="bi bi-reply-fill"></i>
                            <span>Replied to Dian Manurung: "gg brok"</span>
                        </div>
                        <div class="message-header">
                            <div class="message-avatar">A</div>
                            <div class="message-info">
                                <div class="message-author">
                                    <span class="author-name">Ananda Irfansyah</span>
                                    <span class="author-badge co-author-badge">Co-Author</span>
                                </div>
                                <div class="message-date">13/07/2025, 22:48</div>
                            </div>
                        </div>
                        <div class="message-content">
                            thanks brok
                        </div>
                    </div>
                </div>

                <!-- Message 3 -->
                <div class="message-card">
                    <div class="message-header">
                        <div class="message-avatar" style="background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);">I
                        </div>
                        <div class="message-info">
                            <div class="message-author">
                                <span class="author-name">ist ngruki</span>
                            </div>
                            <div class="message-date">19/07/2025, 14:08</div>
                        </div>
                    </div>
                    <div class="message-content">
                        tutornya kak, buat website IST
                    </div>
                </div>

                <!-- Message 4 -->
                <div class="message-card">
                    <div class="message-header">
                        <div class="message-avatar" style="background: linear-gradient(135deg, #10b981 0%, #06b6d4 100%);">M
                        </div>
                        <div class="message-info">
                            <div class="message-author">
                                <span class="author-name">Muhammad Rizki</span>
                            </div>
                            <div class="message-date">20/07/2025, 09:15</div>
                        </div>
                    </div>
                    <div class="message-content">
                        Great website! Really clean design and easy to navigate. Keep up the good work!
                    </div>
                </div>

                <!-- Message 5 -->
                <div class="message-card">
                    <div class="message-header">
                        <div class="message-avatar" style="background: linear-gradient(135deg, #8b5cf6 0%, #ec4899 100%);">S
                        </div>
                        <div class="message-info">
                            <div class="message-author">
                                <span class="author-name">Sarah Johnson</span>
                            </div>
                            <div class="message-date">22/07/2025, 16:42</div>
                        </div>
                    </div>
                    <div class="message-content">
                        Love the portfolio! The projects section is very impressive. Would love to collaborate
                        sometime.
                    </div>
                </div>
            </div>

            <!-- Sign In Section -->
            <div class="signin-section">
                <p class="signin-text">
                    Sign in to begin. Rest assured, your information is secure. See my <a href="#">privacy</a> for
                    more.
                </p>
                <div class="signin-buttons">
                    <a href="#" class="btn-signin">
                        <i class="bi bi-google"></i>
                        <span>Sign in with Google</span>
                    </a>
                    <a href="#" class="btn-signin">
                        <i class="bi bi-github"></i>
                        <span>Sign in with GitHub</span>
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('modal')
@endpush

@push('scripts')
@endpush
