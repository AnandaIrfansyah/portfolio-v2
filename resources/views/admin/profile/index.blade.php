@extends('layouts.app')

@section('title', 'Profile')

@push('style')
    <link rel="stylesheet" href="{{ asset('admin/library/summernote/dist/summernote-bs4.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Hi, {{ $user->name }}!</h2>
                <p class="section-lead">Update your personal information here.</p>

                <div class="row mt-sm-4">

                    {{-- LEFT SIDEBAR --}}
                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="card shadow-sm border-0" style="border-radius: 16px;">

                            {{-- Avatar --}}
                            <div class="text-center mt-4">
                                <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('admin/img/avatar/avatar-1.png') }}"
                                    alt="Avatar" class="rounded-circle"
                                    style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff;">
                            </div>

                            <div class="card-body text-center">

                                {{-- Name + Job Title --}}
                                <h4 class="mt-3 mb-1" style="font-weight: 600;">
                                    {{ $user->name }}
                                </h4>

                                <p class="text-muted" style="margin-top: -4px;">
                                    {{ $user->job_title ?? 'Web Developer' }}
                                </p>

                                {{-- Bio --}}
                                <div class="mt-3 text-gray-700" style="font-size: 15px; line-height: 1.7;">
                                    {!! $user->bio ? strip_tags($user->bio, '<p><br><strong><em><b>') : 'Belum ada bio.' !!}
                                </div>

                            </div>

                            {{-- Social Icons --}}
                            <div class="card-footer text-center bg-white pb-4">

                                <div class="font-weight-bold mb-3">Find me on</div>

                                <div class="d-flex justify-content-center gap-2">

                                    @if ($user->github_url)
                                        <a href="{{ $user->github_url }}" class="btn btn-dark rounded-circle mx-2"
                                             target="_blank">
                                            <i class="fab fa-github"></i>
                                        </a>
                                    @endif

                                    @if ($user->twitter_url)
                                        <a href="{{ $user->twitter_url }}" class="btn btn-info rounded-circle mx-2"
                                             target="_blank">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    @endif

                                    @if ($user->linkedin_url)
                                        <a href="{{ $user->linkedin_url }}" class="btn btn-primary rounded-circle mx-2"
                                             target="_blank">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    @endif

                                    @if ($user->website_url)
                                        <a href="{{ $user->website_url }}" class="btn btn-secondary rounded-circle mx-2"
                                             target="_blank">
                                            <i class="fas fa-globe"></i>
                                        </a>
                                    @endif

                                    @if ($user->support_url)
                                        <a href="{{ $user->support_url }}" class="btn btn-dark rounded-circle mx-2"
                                             target="_blank">
                                            <i class="fas fa-heart"></i>
                                        </a>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- RIGHT FORM --}}
                    <div class="col-12 col-md-12 col-lg-7">
                        <div class="card">
                            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"
                                class="needs-validation">
                                @csrf

                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>

                                <div class="card-body">

                                    <div class="row">

                                        {{-- Left Column --}}
                                        <div class="col-md-6">

                                            {{-- Name --}}
                                            <div class="form-group">
                                                <label>Full Name</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ old('name', $user->name) }}" required>
                                            </div>

                                            {{-- Job Title --}}
                                            <div class="form-group">
                                                <label>Job Title</label>
                                                <input type="text" name="job_title" class="form-control"
                                                    value="{{ old('job_title', $user->job_title) }}">
                                            </div>

                                        </div>

                                        {{-- Right Column --}}
                                        <div class="col-md-6">
                                            {{-- Email --}}
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ old('email', $user->email) }}" required>
                                            </div>

                                            {{-- Location --}}
                                            <div class="form-group">
                                                <label>Location</label>
                                                <input type="text" name="location" class="form-control"
                                                    value="{{ old('location', $user->location) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            {{-- Bio --}}
                                            <div class="form-group">
                                                <label>Bio</label>
                                                <textarea name="bio" class="form-control summernote-simple" style="height: 160px;">
                                                    {{ old('bio', $user->bio) }}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            {{-- Avatar --}}
                                            <div class="form-group">
                                                <label>Photo Profile</label>
                                                <input type="file" name="avatar" class="form-control">
                                            </div>



                                            <div class="form-group">
                                                <label>Twitter URL</label>
                                                <input type="url" name="twitter_url" class="form-control"
                                                    value="{{ old('twitter_url', $user->twitter_url) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Website</label>
                                                <input type="url" name="website_url" class="form-control"
                                                    value="{{ old('website_url', $user->website_url) }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            {{-- Social --}}
                                            <div class="form-group">
                                                <label>Github URL</label>
                                                <input type="url" name="github_url" class="form-control"
                                                    value="{{ old('github_url', $user->github_url) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>LinkedIn URL</label>
                                                <input type="url" name="linkedin_url" class="form-control"
                                                    value="{{ old('linkedin_url', $user->linkedin_url) }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Support</label>
                                                <input type="url" name="support_url" class="form-control"
                                                    value="{{ old('support_url', $user->support_url) }}">
                                            </div>
                                        </div>

                                    </div>


                                </div>

                                <div class="card-footer text-right">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/library/summernote/dist/summernote-bs4.js') }}"></script>
@endpush
