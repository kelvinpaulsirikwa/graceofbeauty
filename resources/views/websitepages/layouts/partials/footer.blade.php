<footer class="relative pt-8 pb-4 overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('images/static_image/aboutus.jpg') }}" alt="Background" class="w-full h-full object-cover">
    </div>
    <!-- Dark Overlay for better text readability -->
    <div class="absolute inset-0 z-0 bg-black/70"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- About Section -->
            <div>
                <div class="flex items-center mb-3">
                    <img src="{{ asset('images/static_image/logo.jpg') }}" alt="{{ config('site.name') }} Logo" class="h-12 w-12 rounded-full mr-3 object-cover">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-1">{{ config('site.name') }}<span class="text-yellow-400">.</span></h2>
                        <p class="text-xs text-gray-300 uppercase tracking-widest">{{ config('site.motto') }}</p>
                    </div>
                </div>
                <p class="text-gray-200 mb-3 text-sm">
                    We would love to serve you and let you enjoy your culinary experience. Excepteur sint occaecat cupidatat non proident.
                </p>
                <div class="bg-yellow-500/20 border-l-4 border-yellow-400 p-3 mb-3">
                    <p class="text-white text-sm italic">
                        <strong>Note:</strong> We are committed to providing you with the best beauty and elegance services. Your satisfaction is our priority.
                    </p>
                </div>
            </div>

            <!-- Opening Times -->
            <div>
                <h3 class="text-lg font-bold text-white mb-3 border-b border-blue-400 pb-2">Opening Times</h3>
                <div class="space-y-1 text-gray-200 text-sm">
                    <p>{{ config('site.opening_hours.weekdays.label') }}: {{ config('site.opening_hours.weekdays.hours') }}</p>
                    <p>{{ config('site.opening_hours.saturday.label') }}: {{ config('site.opening_hours.saturday.hours') }}</p>
                </div>
                <div class="flex space-x-3 mt-4">
                    <a href="{{ config('site.social.facebook') }}" class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ config('site.social.twitter') }}" class="w-10 h-10 bg-blue-400 text-white rounded-full flex items-center justify-center hover:bg-blue-500 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="{{ config('site.social.google') }}" class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.372 0 0 5.373 0 12s5.372 12 12 12c6.627 0 12-5.373 12-12S18.627 0 12 0zm.14 19.018c-3.868 0-7-3.14-7-7.018 0-3.878 3.132-7.018 7-7.018 1.89 0 3.47.697 4.682 1.829l-1.974 1.978v-.004c-.735-.702-1.667-1.062-2.708-1.062-2.31 0-4.187 1.956-4.187 4.273 0 2.315 1.877 4.277 4.187 4.277 2.096 0 3.522-1.202 3.816-2.852H12.14v-2.737h6.585c.088.47.135.96.135 1.474 0 4.01-2.677 6.86-6.72 6.86z"/></svg>
                    </a>
                    <a href="{{ config('site.social.instagram') }}" class="w-10 h-10 bg-pink-600 text-white rounded-full flex items-center justify-center hover:bg-pink-700 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Contact Us -->
            <div>
                <h3 class="text-lg font-bold text-white mb-3 border-b border-blue-400 pb-2">Contact Us</h3>
                <div class="space-y-2 text-gray-200 text-sm">
                    <p>Tel: {{ config('site.contact.phone') }}</p>
                    <p>E-mail: {{ config('site.contact.email') }}</p>
                    <p>Address: {{ config('site.contact.address') }}</p>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-400/30 pt-4">
            <p class="text-center text-gray-200 text-sm">
                Copyright ©{{ date('Y') }} All rights reserved | This website is made and managed with ❤️ by SI
            </p>
        </div>
    </div>
</footer>