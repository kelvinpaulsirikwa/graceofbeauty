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
            <div class="hidden md:flex items-center space-x-3">
                @if(request()->routeIs('product.show'))
                    @php
                        $productId = request()->route('id');
                        $product = \App\Models\Product::find($productId);
                    @endphp
                    @if($product)
                        <a href="{{ route('product.random', $productId) }}" class="px-4 py-2 text-sm rounded-lg transition flex items-center gap-2 whitespace-nowrap" style="background-color: #000; color: var(--gold-color, #D4AF37);" onmouseover="this.style.backgroundColor='#1a1a1a'" onmouseout="this.style.backgroundColor='#000'">
                            <span>See another product</span>
                            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold-color, #D4AF37);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    @endif
                @endif
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
                    @if(request()->routeIs('product.show'))
                        @php
                            $productId = request()->route('id');
                            $product = \App\Models\Product::find($productId);
                        @endphp
                        @if($product)
                            <a href="{{ route('product.random', $productId) }}" class="w-full px-4 py-3 text-base rounded-lg transition flex items-center justify-between mb-4 font-medium" style="background-color: #000; color: var(--gold-color, #D4AF37);" onmouseover="this.style.backgroundColor='#1a1a1a'" onmouseout="this.style.backgroundColor='#000'">
                                <span>See another product</span>
                                <svg class="w-5 h-5 flex-shrink-0 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold-color, #D4AF37);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endif
                    @endif
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
                        <a href="{{ config('site.social.whatsapp', 'https://wa.me/255659920815') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition" aria-label="WhatsApp">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                        </a>
                        <a href="{{ config('site.social.instagram') }}" target="_blank" rel="noopener noreferrer" class="social-insta w-10 h-10 text-white rounded-full flex items-center justify-center" aria-label="Instagram">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>
                            </svg>
                        </a>
                        <a href="{{ config('site.social.email', 'mailto:janethmalikita@gmail.com') }}" class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition" aria-label="Email">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
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