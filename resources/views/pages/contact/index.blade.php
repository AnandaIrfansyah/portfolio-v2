@extends('layouts.pages')

@section('title', 'Contact')

@push('styles')
@endpush

@section('content')
    <div class="container-fluid px-0">
        <!-- Contact Header -->
        <section class="contact-header">
            <h1 class="contact-title">
                Contact <span class="highlight">Me</span>
            </h1>
            <p class="contact-subtitle">
                Some conversations don't start with code, they begin with a message.
            </p>
        </section>

        <!-- Let's Stay in Touch Section -->
        <section class="contact-section">
            <div class="section-header">
                <i class="bi bi-link-45deg section-icon"></i>
                <h2 class="section-title">Let's stay in touch</h2>
            </div>
            <p class="section-description">
                Here's where ideas become conversations—feel free to reach out.
            </p>
            <div class="social-buttons">
                <a href="mailto:ananda@example.com" class="btn btn-email">
                    <i class="bi bi-envelope-fill"></i>
                    <span>Email</span>
                </a>
                <a href="https://github.com/anandairfansyah" target="_blank" class="btn btn-github">
                    <i class="bi bi-github"></i>
                    <span>Github</span>
                </a>
                <a href="https://linkedin.com/in/anandairfansyah" target="_blank" class="btn btn-linkedin">
                    <i class="bi bi-linkedin"></i>
                    <span>LinkedIn</span>
                </a>
                <a href="#" class="btn btn-support">
                    <i class="bi bi-heart-fill"></i>
                    <span>Support</span>
                </a>
                <a href="https://instagram.com/anndairfnsyh_" target="_blank" class="btn btn-instagram">
                    <i class="bi bi-instagram"></i>
                    <span>Instagram</span>
                </a>
            </div>
        </section>

        <!-- Send Message Section -->
        <section class="contact-section">
            <div class="section-header">
                <i class="bi bi-envelope section-icon"></i>
                <h2 class="section-title">Send me a message</h2>
            </div>
            <p class="section-description">
                Have a thought, a question, or just want to say hello? Leave a note—I read them all.
            </p>
            <form id="contactForm">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="name">Name*</label>
                        <input type="text" id="name" class="form-input" placeholder="Your name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email*</label>
                        <input type="email" id="email" class="form-input" placeholder="your.email@example.com"
                            required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="message">Message*</label>
                    <textarea id="message" class="form-textarea" placeholder="Your message here..." required></textarea>
                </div>
                <button type="submit" class="btn btn-submit">
                    Begin the conversation
                </button>
            </form>
            <div class="response-note">
                <i class="bi bi-clock"></i>
                <span>Typical response time: 1-2 hours (Weekdays, GMT+7). I reply with care.</span>
            </div>
        </section>
    </div>
@endsection

@push('modal')
@endpush

@push('scripts')
@endpush
