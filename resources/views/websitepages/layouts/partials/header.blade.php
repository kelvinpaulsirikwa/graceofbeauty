<header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 py-2">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="{{ asset('images/static_image/logo.jpg') }}" alt="{{ config('site.name') }} Logo" class="h-12 w-12 rounded-full mr-3 object-cover">
                <div>
                    <h1 class="text-xl font-bold text-gray-800">{{ config('site.name') }}<span class="text-yellow-500">.</span></h1>
                    <p class="text-[10px] text-gray-500 uppercase tracking-widest">{{ config('site.motto') }}</p>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="hidden md:flex space-x-6 items-center">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-yellow-500 transition relative pb-1 {{ request()->routeIs('home') || request()->is('/') ? 'text-yellow-500 font-semibold' : '' }}">
                    Home
                    @if(request()->routeIs('home') || request()->is('/'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-yellow-500"></span>
                    @endif
                </a>
                <a href="{{ route('services') }}" class="text-gray-700 hover:text-yellow-500 transition relative pb-1 {{ request()->routeIs('services') || request()->routeIs('services.show') || request()->routeIs('user.feedback.story') || request()->is('services*') ? 'text-yellow-500 font-semibold' : '' }}">
                    Our Services
                    @if(request()->routeIs('services') || request()->routeIs('services.show') || request()->routeIs('user.feedback.story') || request()->is('services*'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-yellow-500"></span>
                    @endif
                </a>
                <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-yellow-500 transition relative pb-1 {{ request()->routeIs('gallery') || request()->is('gallery*') ? 'text-yellow-500 font-semibold' : '' }}">
                    Gallery
                    @if(request()->routeIs('gallery') || request()->is('gallery*'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-yellow-500"></span>
                    @endif
                </a>
                <a href="{{ route('contact') }}" class="text-gray-700 hover:text-yellow-500 transition relative pb-1 {{ request()->routeIs('contact') || request()->routeIs('contact.submit') || request()->is('contact*') ? 'text-yellow-500 font-semibold' : '' }}">
                    Contact Us
                    @if(request()->routeIs('contact') || request()->routeIs('contact.submit') || request()->is('contact*'))
                        <span class="absolute bottom-0 left-0 w-full h-0.5 bg-yellow-500"></span>
                    @endif
                </a>
            </nav>

            <!-- Cart & Book Now -->
            <div class="flex items-center space-x-3">
                <!-- <button class="text-gray-700 hover:text-yellow-500 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </button>
                <a href="#" class="px-4 py-1.5 text-sm border-2 border-gray-800 text-gray-800 rounded-full hover:bg-gray-800 hover:text-white transition">BOOK NOW</a> -->
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="md:hidden text-gray-700 focus:outline-none z-50" aria-label="Toggle menu">
                <svg id="menu-icon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg id="close-icon" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden transition-opacity duration-300"></div>
    
    <!-- Mobile Menu Drawer -->
    <div id="mobile-menu-drawer" class="fixed top-0 right-0 h-full w-full bg-white shadow-xl z-50 transform translate-x-full transition-transform duration-300 ease-in-out md:hidden">
        <div class="flex flex-col h-full">
            <!-- Drawer Header -->
            <div class="flex items-center justify-between p-4 border-b border-gray-200">
                <div class="flex items-center">
                    <img src="{{ asset('images/static_image/logo.jpg') }}" alt="{{ config('site.name') }} Logo" class="h-12 w-12 rounded-full mr-3 object-cover">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">{{ config('site.name') }}<span class="text-yellow-500">.</span></h2>
                        <p class="text-[10px] text-gray-500 uppercase tracking-widest">{{ config('site.motto') }}</p>
                    </div>
                </div>
                <button id="close-drawer-button" class="text-gray-700 hover:text-yellow-500 transition focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <!-- Drawer Navigation -->
            <nav class="flex-1 overflow-y-auto p-4">
                <div class="flex flex-col space-y-4">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-yellow-500 transition py-3 text-lg border-b border-gray-100 {{ request()->routeIs('home') ? 'text-yellow-500 font-semibold border-yellow-500' : '' }}">Home</a>
                    <a href="{{ route('services') }}" class="text-gray-700 hover:text-yellow-500 transition py-3 text-lg border-b border-gray-100 {{ request()->routeIs('services') || request()->routeIs('services.show') || request()->routeIs('user.feedback.story') ? 'text-yellow-500 font-semibold border-yellow-500' : '' }}">Our Services</a>
                    <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-yellow-500 transition py-3 text-lg border-b border-gray-100 {{ request()->routeIs('gallery') ? 'text-yellow-500 font-semibold border-yellow-500' : '' }}">Gallery</a>
                    <a href="{{ route('contact') }}" class="text-gray-700 hover:text-yellow-500 transition py-3 text-lg border-b border-gray-100 {{ request()->routeIs('contact') || request()->routeIs('contact.submit') ? 'text-yellow-500 font-semibold border-yellow-500' : '' }}">Contact Us</a>
                </div>
            </nav>
            
            <!-- Drawer Footer Section -->
            <div class="border-t border-gray-200 bg-gray-50 p-4">
                <!-- Follow Us Section -->
                <div class="mb-4">
                    <h3 class="text-sm font-bold text-gray-800 uppercase mb-3">Follow Us</h3>
                    <div class="flex space-x-3">
                        <a href="{{ config('site.social.facebook', '#') }}" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="{{ config('site.social.twitter', '#') }}" class="w-10 h-10 bg-gray-900 text-white rounded-full flex items-center justify-center hover:bg-gray-800 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="{{ config('site.social.instagram', '#') }}" class="w-10 h-10 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full flex items-center justify-center hover:opacity-90 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                        </a>
                        <a href="{{ config('site.social.google', '#') }}" class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12c6.627 0 12-5.373 12-12S18.627 0 12 0zm.14 19.018c-3.868 0-7-3.14-7-7.018 0-3.878 3.132-7.018 7-7.018 1.89 0 3.47.697 4.682 1.829l-1.974 1.978v-.004c-.735-.702-1.667-1.062-2.708-1.062-2.31 0-4.187 1.956-4.187 4.273 0 2.315 1.877 4.277 4.187 4.277 2.096 0 3.522-1.202 3.816-2.852H12.14v-2.737h6.585c.088.47.135.96.135 1.474 0 4.01-2.677 6.86-6.72 6.86z"/></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Contact Info Section -->
                <div class="border-t border-gray-200 pt-4">
                    <h3 class="text-sm font-bold text-gray-800 uppercase mb-2">Contact Us</h3>
                    <div class="space-y-2 text-sm text-gray-600">
                        <p>Tel: {{ config('site.contact.phone', 'N/A') }}</p>
                        <p>Email: {{ config('site.contact.email', 'N/A') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const closeDrawerButton = document.getElementById('close-drawer-button');
        const mobileMenuDrawer = document.getElementById('mobile-menu-drawer');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const menuIcon = document.getElementById('menu-icon');
        const closeIcon = document.getElementById('close-icon');
        const body = document.body;
        
        function openDrawer() {
            mobileMenuDrawer.classList.remove('translate-x-full');
            mobileMenuOverlay.classList.remove('hidden');
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            body.style.overflow = 'hidden'; // Prevent body scroll when drawer is open
        }
        
        function closeDrawer() {
            mobileMenuDrawer.classList.add('translate-x-full');
            mobileMenuOverlay.classList.add('hidden');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            body.style.overflow = ''; // Restore body scroll
        }
        
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', openDrawer);
        }
        
        if (closeDrawerButton) {
            closeDrawerButton.addEventListener('click', closeDrawer);
        }
        
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', closeDrawer);
        }
        
        // Close drawer when clicking on a link
        const drawerLinks = mobileMenuDrawer.querySelectorAll('a');
        drawerLinks.forEach(link => {
            link.addEventListener('click', closeDrawer);
        });
    });
</script>