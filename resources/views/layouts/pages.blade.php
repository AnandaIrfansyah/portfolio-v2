<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') &mdash; Portfolio</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('pages/img/favicon.png') }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('pages/css/style.css') }}">

    @stack('styles')

</head>

<body>

    @include('components.pages.mobile-navbar')

    <!-- Language Switcher (Desktop only) -->
    <div class="language-switcher">
        <button class="lang-toggle" onclick="toggleLanguage()">
            <i class="bi bi-globe"></i>
            <span id="currentLang">EN</span>
        </button>
    </div>

    @include('components.pages.command-palette')

    @include('components.pages.sidebar')

    <main class="main-content">
        @yield('content')
    </main>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" onclick="scrollToTop()" aria-label="Back to top">
        <i class="bi bi-arrow-up"></i>
    </button>

    @stack('modal')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('pages/js/script.js') }}"></script>

    @stack('scripts')

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });
    </script>

</body>

</html>
