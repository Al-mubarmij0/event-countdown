<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font Awesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="bg-light text-dark">
    <div class="min-vh-100 d-flex flex-column">
        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Page Header --}}
        @isset($header)
            <header class="bg-white shadow-sm py-3 mb-4">
                <div class="container">
                    {{ $header }}
                </div>
            </header>
        @endisset

        {{-- Page Content --}}
        <main class="flex-grow-1">
            <div class="container py-3">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white py-4">
            <div class="container text-center">
                <p>&copy; {{ date('Y') }} Event Countdown. All rights reserved.</p>
                <p>
                    <a href="#" class="text-white text-decoration-none">Privacy Policy</a> |
                    <a href="#" class="text-white text-decoration-none">Terms of Service</a>
                </p>
                <p>Follow us on:
                    <a href="#" class="text-white text-decoration-none"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white text-decoration-none"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white text-decoration-none"><i class="fab fa-instagram"></i></a>
                </p>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS Bundle (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
