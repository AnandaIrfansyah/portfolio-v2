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

    <style>
        @keyframes slideInToast {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

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

        function toggleLanguage() {
            const toast = document.createElement('div');
            toast.innerHTML = `
        <div style="
            position: fixed;
            top: 24px;
            right: 24px;
            background: #1e1e1e;
            color: #fff;
            padding: 14px 18px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            border: 1px solid #2563EB;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-family: Inter, sans-serif;
            z-index: 9999;
            animation: slideInToast 0.3s ease;
        ">
            <i class="bi bi-tools" style="font-size:16px; color:#facc15;"></i>
            <div>
                <div style="font-weight:600; margin-bottom:2px;">Fitur Segera Hadir | Coming Soon</div>
                <div style="color:#aaa; font-size:11px;">Language switcher masih dalam pengembangan 🚧</div>
            </div>
        </div>
    `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.transition = 'opacity 0.3s ease';
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 2500);
        }
    </script>

</body>

</html>
