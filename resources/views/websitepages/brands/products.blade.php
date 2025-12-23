@extends('websitepages.layouts.app')

@section('title', $brand->brand_name . ' Products')

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
            <li class="text-gray-800 font-medium">{{ $brand->brand_name }}</li>
        </ol>
    </nav>

    <!-- Brand Header -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            <span class="relative inline-block">
                {{ strtoupper($brand->brand_name) }}
                <span class="absolute bottom-0 left-0 w-full h-1" style="background-color: var(--gold-color, #D4AF37);"></span>
            </span>
            <span class="ml-2">PRODUCTS</span>
        </h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            Explore all products from {{ $brand->brand_name }}
        </p>
    </div>

    <!-- Products Grid -->
    <div id="products-container" class="mb-12">
        @if($products && $products->count() > 0)
            <div class="products-grid">
                <div id="products-grid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($products as $product)
                        <div class="product-item">
                            @include('websitepages.products.partials.product-card', ['product' => $product, 'pricePrefix' => '$', 'priceDecimals' => 1])
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-12 bg-white rounded-lg shadow-md">
                <p class="text-gray-600 text-lg">No products available for this brand.</p>
            </div>
        @endif
    </div>

    <!-- Loading Indicator -->
    <div id="loading-indicator" class="hidden text-center py-8">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
        <p class="mt-2 text-gray-600">Loading more products...</p>
    </div>

    <!-- End of Content Indicator -->
    <div id="end-indicator" class="hidden text-center py-8">
        <p class="text-gray-600 text-2xl font-semibold">--***---</p>
    </div>
</div>

<style>
    .product-item {
        transition: transform 0.3s ease;
    }

    .product-item:hover {
        transform: translateY(-5px);
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
        const productsGrid = document.getElementById('products-grid');
        const loadingIndicator = document.getElementById('loading-indicator');
        const endIndicator = document.getElementById('end-indicator');
        let isLoading = false;
        let hasMore = {{ $products->hasMorePages() ? 'true' : 'false' }};
        let nextPage = {{ $products->hasMorePages() ? "'" . $products->nextPageUrl() . "'" : 'null' }};
        const brandId = {{ $brand->brand_id }};

        function loadMoreProducts() {
            if (isLoading || !hasMore || !nextPage) return;

            isLoading = true;
            loadingIndicator.classList.remove('hidden');
            endIndicator.classList.add('hidden');

            fetch(nextPage, {
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
                    
                    // Append new products to the grid
                    const newProducts = tempDiv.querySelectorAll('.product-item');
                    newProducts.forEach(item => {
                        productsGrid.appendChild(item);
                    });
                }
                
                hasMore = data.hasMore;
                nextPage = data.nextPage;
                
                if (!hasMore) {
                    endIndicator.classList.remove('hidden');
                }
                
                isLoading = false;
                loadingIndicator.classList.add('hidden');
            })
            .catch(error => {
                console.error('Error loading products:', error);
                isLoading = false;
                loadingIndicator.classList.add('hidden');
            });
        }

        // Infinite scroll
        window.addEventListener('scroll', function() {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 1000) {
                loadMoreProducts();
            }
        });
    });
</script>
@endsection

