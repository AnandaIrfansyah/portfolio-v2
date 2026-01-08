@extends('layouts.pages')
@section('title', 'Contact')

@push('styles')
    <style>
        .form-error {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        }

        .form-input.error,
        .form-textarea.error {
            border-color: #dc3545;
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
    </style>
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

            @if ($user)
                <div class="social-buttons">
                    @if ($user->email)
                        <a href="mailto:{{ $user->email }}" class="btn btn-email">
                            <i class="bi bi-envelope-fill"></i>
                            <span>Email</span>
                        </a>
                    @endif

                    @if ($user->github_url)
                        <a href="{{ $user->github_url }}" target="_blank" class="btn btn-github">
                            <i class="bi bi-github"></i>
                            <span>Github</span>
                        </a>
                    @endif

                    @if ($user->linkedin_url)
                        <a href="{{ $user->linkedin_url }}" target="_blank" class="btn btn-linkedin">
                            <i class="bi bi-linkedin"></i>
                            <span>LinkedIn</span>
                        </a>
                    @endif

                    @if ($user->support_url)
                        <a href="{{ $user->support_url }}" target="_blank" class="btn btn-support">
                            <i class="bi bi-heart-fill"></i>
                            <span>Support</span>
                        </a>
                    @endif

                    @if ($user->twitter_url)
                        <a href="{{ $user->twitter_url }}" target="_blank" class="btn btn-instagram">
                            <i class="bi bi-instagram"></i>
                            <span>Instagram</span>
                        </a>
                    @endif
                </div>
            @else
                <div class="alert alert-info">
                    No contact information available yet.
                </div>
            @endif
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
                @csrf
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="name">Name*</label>
                        <input type="text" id="name" name="name" class="form-input" placeholder="Your name"
                            required>
                        <span class="form-error" id="error-name"></span>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Email*</label>
                        <input type="email" id="email" name="email" class="form-input"
                            placeholder="your.email@example.com" required>
                        <span class="form-error" id="error-email"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="message">Message*</label>
                    <textarea id="message" name="message" class="form-textarea" placeholder="Your message here..." required></textarea>
                    <span class="form-error" id="error-message"></span>
                </div>

                <button type="submit" class="btn btn-submit" id="submitBtn">
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

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function() {
            'use strict';

            console.log('🔧 Initializing contact form...');

            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });

            // ✅ Wait for DOM ready
            window.addEventListener('load', function() {
                const form = document.getElementById('contactForm');

                if (!form) {
                    console.error('❌ Contact form not found!');
                    return;
                }

                // ✅ Remove all existing event listeners by cloning
                const newForm = form.cloneNode(true);
                form.parentNode.replaceChild(newForm, form);

                console.log('✅ Contact form cloned and ready');

                // ✅ Attach handler to NEW form
                const contactForm = document.getElementById('contactForm');

                contactForm.onsubmit = function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    console.log('========================================');
                    console.log('🚀 CONTACT FORM SUBMISSION STARTED');
                    console.log('========================================');

                    // Clear previous errors
                    clearErrors();

                    // Disable submit button
                    const submitBtn = document.getElementById('submitBtn');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';

                    // ✅ GET VALUES MANUALLY
                    const nameInput = document.getElementById('name');
                    const emailInput = document.getElementById('email');
                    const messageInput = document.getElementById('message');

                    console.log('📝 Form inputs found:');
                    console.log('   Name input:', nameInput ? 'Found' : 'NOT FOUND');
                    console.log('   Email input:', emailInput ? 'Found' : 'NOT FOUND');
                    console.log('   Message input:', messageInput ? 'Found' : 'NOT FOUND');

                    const formData = {
                        _token: '{{ csrf_token() }}',
                        name: nameInput ? nameInput.value : '',
                        email: emailInput ? emailInput.value : '',
                        message: messageInput ? messageInput.value : ''
                    };

                    console.log('📤 DATA YANG DIKIRIM:');
                    console.log(formData);

                    // ✅ SEND AS JSON
                    fetch("{{ route('contact.store') }}", {
                            method: 'POST',
                            body: JSON.stringify(formData),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            }
                        })
                        .then(response => {
                            console.log('📥 RESPONSE STATUS:', response.status);
                            return response.clone().text().then(text => {
                                console.log('📄 RAW RESPONSE:', text);
                                return response.json();
                            });
                        })
                        .then(data => {
                            console.log('✅ PARSED RESPONSE:', data);

                            if (data.success) {
                                console.log('✨ SUCCESS! Pesan berhasil dikirim');

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Message Sent!',
                                    text: data.message,
                                    confirmButtonText: 'Great!'
                                });

                                // Reset form
                                contactForm.reset();
                            } else {
                                console.log('❌ GAGAL! Ada validation error');

                                if (data.errors) {
                                    console.log('🔴 VALIDATION ERRORS:');
                                    console.table(data.errors);

                                    showErrors(data.errors);
                                    Toast.fire({
                                        icon: 'error',
                                        title: 'Please check your input.'
                                    });
                                }
                            }

                            console.log('========================================');
                        })
                        .catch(error => {
                            console.error('💥 FETCH ERROR:', error);
                            console.log('========================================');

                            Toast.fire({
                                icon: 'error',
                                title: 'Something went wrong. Please try again.'
                            });
                        })
                        .finally(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                        });

                    return false; // ✅ Extra safety
                };

                // Re-attach input event listeners
                document.querySelectorAll('#contactForm .form-input, #contactForm .form-textarea').forEach(
                    input => {
                        input.addEventListener('input', function() {
                            this.classList.remove('error');
                            const errorEl = document.getElementById(`error-${this.id}`);
                            if (errorEl) errorEl.textContent = '';
                        });
                    });

                console.log('✅ Contact form handler attached');
            });

            function showErrors(errors) {
                console.log('🎯 Mencoba menampilkan errors di form...');

                Object.keys(errors).forEach(key => {
                    const errorElement = document.getElementById(`error-${key}`);
                    const inputElement = document.getElementById(key);

                    console.log(`   - Field: ${key}`);
                    console.log(`     Error message: ${errors[key][0]}`);
                    console.log(`     Error element found: ${errorElement !== null}`);
                    console.log(`     Input element found: ${inputElement !== null}`);

                    if (errorElement && inputElement) {
                        errorElement.textContent = errors[key][0];
                        inputElement.classList.add('error');
                        console.log(`     ✅ Error displayed successfully`);
                    } else {
                        console.warn(`     ⚠️ Element not found for key: ${key}`);
                    }
                });
            }

            function clearErrors() {
                document.querySelectorAll('#contactForm .form-error').forEach(el => el.textContent = '');
                document.querySelectorAll('#contactForm .form-input, #contactForm .form-textarea').forEach(el => el
                    .classList.remove('error'));
            }

            // ✅ Expose functions to global scope
            window.showErrors = showErrors;
            window.clearErrors = clearErrors;
        })();
    </script>
@endpush
