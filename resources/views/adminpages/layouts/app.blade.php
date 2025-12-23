{{-- resources/views/layouts/header.blade.php --}}
@php
    if (session_status() === PHP_SESSION_NONE) session_start();
    $role = session('auth_user_role'); // Accessing role from session
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>{{ config('site.name') }} | Admin {{ $pageTitle ?? 'Dashboard' }}</title>
    <link rel="icon" href="{{ asset('/images/static_image/logonobg.png') }}" type="image/jpg">

    <!-- Bootstrap CSS (Local) -->
    <link href="{{ asset('css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">

    <!-- FontAwesome (Local) -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome/all.min.css') }}">

    <!-- Boxicons (Local) -->
    <link href="{{ asset('css/boxicons/boxicons.min.css') }}" rel="stylesheet"> 
    
    
    <link rel="stylesheet" href="{{ asset('css/adminsidebar.css') }}">
    
    <style>
        /* Smart Avatar Styling */
        .user-avatar-fallback {
            position: relative;
            overflow: hidden;
        }
        
        .user-avatar-fallback::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .user-avatar-fallback:hover::before {
            opacity: 1;
        }
        
        .user-avatar-img:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(23, 117, 241, 0.35), 0 0 0 3px rgba(255, 255, 255, 0.9) !important;
        }
        
        .user-avatar-fallback:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 16px rgba(23, 117, 241, 0.35), 0 0 0 3px rgba(255, 255, 255, 0.9), inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
        }
    </style>

    <!-- JS Files -->
    <script src="{{ asset('js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/adminsidebar.js') }}"></script>
    <!-- CKEditor - Commented out until properly installed -->
    <!-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> -->


  
	

</head>
<body style="min-height:100vh; display:flex; flex-direction:column;">

        <!-- Sidebar Overlay for Mobile -->
        <div class="sidebar-overlay"></div>
 
        @include('adminpages.layouts.partials.sidebar')
        @include('adminpages.layouts.partials.navbar')
   

    {{-- Page content --}}
    <div class="main-content" style="flex:1 0 auto;">
        @if(session('error'))
            <div class="container-fluid px-4 py-2">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        @yield('content')
    </div>

    {{-- Footer --}}
    @include('adminpages.layouts.partials.footer')

    <script>
        // Prevent back button caching for admin pages
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                window.location.reload();
            }
        });
    </script>
</body>
</html>
