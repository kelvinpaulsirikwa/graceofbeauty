<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('/images/static_image/logo.jpg') }}" type="image/jpg">

    <title>{{ config('site.name') }} - @yield('title', config('site.tagline'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS (Local) -->
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        :root {
            --gold-color: #D4AF37;
            --gold-color-hover: #B8941F;
            --gold-color-light: #E5C866;
            --gold-color-dark: #A0821A;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>

    @stack('styles')
</head>
<body class="antialiased bg-white">
    <!-- Top Navbar -->
    @include('websitepages.layouts.partials.topnavbar')

    <!-- Header -->
    @include('websitepages.layouts.partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('websitepages.layouts.partials.footer')

    <!-- Bootstrap JS (Local) -->
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    @stack('scripts')
</body>
</html>