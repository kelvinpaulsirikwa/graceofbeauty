@extends('websitepages.layouts.app')

@section('title', 'Gallery')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-medium">Gallery</li>
        </ol>
    </nav>

    <!-- Gallery Header -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            <span class="relative inline-block">
                OUR
                <span class="absolute bottom-0 left-0 w-full h-1 bg-red-600"></span>
            </span>
            <span class="ml-2">GALLERY</span>
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            Explore our collection of product images
        </p>
    </div>

    <!-- Gallery Grid -->
    <div id="gallery-container" class="mb-12">
        @if($images && $images->count() > 0)
            <div class="gallery-grid">
                <div id="images-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @include('websitepages.gallery.image-grid', ['images' => $images])
                </div>
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow-md">
                <p class="text-gray-600 text-lg">No images available in the gallery.</p>
            </div>
        @endif
    </div>

    <!-- Loading Indicator -->
    <div id="loading-indicator" class="hidden text-center py-8">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Loading more images...</p>
    </div>

    <!-- End of Content Indicator -->
    <div id="end-indicator" class="hidden text-center py-8">
        <p class="text-gray-600 text-2xl font-semibold">--***---</p>
    </div>
</div>


<style>
    .gallery-item {
        transition: transform 0.3s ease;
    }

    .gallery-item:hover {
        transform: translateY(-5px);
    }

    .gallery-item img {
        display: block;
        background-color: #f3f4f6;
    }

    /* Fix overlay transparency */
    .gallery-item .absolute.inset-0 {
        background-color: transparent !important;
    }

    .gallery-item:hover .absolute.inset-0 {
        background-color: rgba(0, 0, 0, 0.5) !important;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    .animate-spin {
        animation: spin 1s linear infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const imagesGrid = document.getElementById('images-grid');
        const loadingIndicator = document.getElementById('loading-indicator');
        const endIndicator = document.getElementById('end-indicator');
        let nextPageUrl = '{{ $images->nextPageUrl() }}';
        let isLoading = false;
        let hasMore = {{ $images->hasMorePages() ? 'true' : 'false' }};

        // Function to load more images
        function loadMoreImages() {
            if (isLoading || !hasMore || !nextPageUrl) {
                return;
            }

            isLoading = true;
            loadingIndicator.classList.remove('hidden');

            fetch(nextPageUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.html) {
                    // Create a temporary container to parse the HTML
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = data.html;
                    
                    // Append new images to the grid
                    const newImages = tempDiv.querySelectorAll('.gallery-item');
                    newImages.forEach(item => {
                        imagesGrid.appendChild(item);
                    });
                }

                hasMore = data.hasMore;
                nextPageUrl = data.nextPageUrl;

                loadingIndicator.classList.add('hidden');

                if (!hasMore) {
                    endIndicator.classList.remove('hidden');
                }

                isLoading = false;
            })
            .catch(error => {
                console.error('Error loading more images:', error);
                loadingIndicator.classList.add('hidden');
                isLoading = false;
            });
        }

        // Infinite scroll detection
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Check if scrolled near bottom (within 500px)
            if ((window.innerHeight + scrollTop) >= (document.documentElement.scrollHeight - 500)) {
                loadMoreImages();
            }
        });
    });
</script>

@endsection

