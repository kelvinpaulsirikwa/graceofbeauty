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
                    <a href="{{ config('site.social.whatsapp') }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition" aria-label="WhatsApp">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    </a>
                    <a href="{{ config('site.social.email') }}" class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition" aria-label="Email">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </a>
                    <a href="{{ config('site.social.instagram') }}" target="_blank" rel="noopener noreferrer" class="social-insta w-10 h-10 rounded-full text-white flex items-center justify-center" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" aria-hidden="true">
                            <rect x="4" y="4" width="16" height="16" rx="4" stroke="white" stroke-width="1.85"/>
                            <circle cx="12" cy="12" r="3.75" stroke="white" stroke-width="1.85"/>
                            <circle cx="17" cy="7" r="1.1" fill="white" stroke="none"/>
                        </svg>
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