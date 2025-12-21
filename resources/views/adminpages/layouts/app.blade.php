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

    <!-- Bootstrap CSS (CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- FontAwesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Boxicons (CDN) -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"> 
    
    
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="{{ asset('js/adminsidebar.js') }}"></script>
    <!-- CKEditor - Commented out until properly installed -->
    <!-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script> -->


  
	

</head>
<body style="min-height:100vh; display:flex; flex-direction:column;">

 
        @include('adminpages.layouts.partials.sidebar')
        @include('adminpages.layouts.partials.navbar')
   

    {{-- Page content --}}
    <div class="main-content" style="flex:1 0 auto;">
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
