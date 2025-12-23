@extends('websitepages.layouts.app')

@section('title', $category->category_name ?? 'Category')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<!-- Category Products Section -->
<section class="category-products-section py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 md:mb-0">
                    <span class="relative inline-block">
                        {{ strtoupper($category->category_name) }}
                    </span>
                </h2>
                
                <!-- Filter Button -->
                <button id="filter-toggle-btn" class="filter-toggle-btn px-6 py-2 rounded-lg transition flex items-center gap-2 w-fit" style="background-color: #000; color: var(--gold-color, #D4AF37);" onmouseover="this.style.backgroundColor='#1a1a1a'" onmouseout="this.style.backgroundColor='#000'">
                    <span>× Filter</span>
                    <svg id="filter-arrow" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Filter Row (Hidden by default) -->
        <div id="filter-row" class="hidden bg-white p-6 rounded-lg shadow-sm mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Sort By Price -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Sort By</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="filter-option text-gray-500 hover:text-blue-600 transition" data-sort="price_low">Price: Low to High</a></li>
                        <li><a href="#" class="filter-option text-gray-500 hover:text-blue-600 transition" data-sort="price_high">Price: High to Low</a></li>
                    </ul>
                </div>
                
                <!-- Subcategories -->
                <div id="subcategories-section">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Subcategories</h3>
                    <div id="subcategories-container">
                        @if($subcategories && $subcategories->count() > 0)
                            <ul class="space-y-2">
                                <li><a href="#" class="subcategory-option text-gray-500 hover:text-blue-600 transition {{ !$selectedSubcategoryId ? 'active text-blue-600 border-b border-blue-600 pb-1' : '' }}" data-subcategory="">All Subcategories</a></li>
                                @foreach($subcategories as $subcategory)
                                    <li><a href="#" class="subcategory-option text-gray-500 hover:text-blue-600 transition {{ $selectedSubcategoryId == $subcategory->subcategory_id ? 'active text-blue-600 border-b border-blue-600 pb-1' : '' }}" data-subcategory="{{ $subcategory->subcategory_id }}">{{ $subcategory->subcategory_name }}</a></li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500 text-sm">No subcategories available</p>
                        @endif
                    </div>
                </div>
                
                <!-- Tags (Product Attributes) -->
                <div>
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @forelse($productAttributes ?? [] as $attribute)
                            <a href="#" class="tag-option px-4 py-2 rounded-full border border-gray-300 text-gray-600 hover:border-blue-600 hover:text-blue-600 transition text-sm" data-tag="{{ $attribute->id }}">
                                {{ $attribute->name }}
                            </a>
                        @empty
                            <p class="text-gray-500 text-sm">No product attributes available</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Products Grid -->
        <div id="products-grid" class="products-grid grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($products ?? [] as $product)
                @include('websitepages.products.partials.product-card', ['product' => $product])
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-600 text-lg">No products available in this category.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<style>
    .category-products-section {
        font-family: 'Arial', sans-serif;
    }
    
    .filter-option.active {
        color: #2563eb;
        border-bottom-color: #2563eb;
    }
    
    .subcategory-option.active {
        color: #2563eb;
        border-bottom-color: #2563eb;
    }
    
    .tag-option.active {
        border-color: #2563eb;
        color: #2563eb;
        background-color: #eff6ff;
    }
    
    .product-card {
        transition: all 0.3s ease;
    }
    
    .product-card:hover {
        transform: translateY(-5px);
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    #filter-row {
        transition: all 0.3s ease;
    }
    
    #filter-arrow.rotate-180 {
        transform: rotate(180deg);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryId = {{ $category->category_id }};
        const selectedSubcategoryId = '{{ $selectedSubcategoryId ?? "" }}';
        
        // Filter state
        let filterState = {
            categoryId: categoryId,
            subcategoryId: selectedSubcategoryId || null,
            tags: [],
            sort: null
        };

        // Filter Toggle
        const filterToggleBtn = document.getElementById('filter-toggle-btn');
        const filterRow = document.getElementById('filter-row');
        const filterArrow = document.getElementById('filter-arrow');
        
        if (filterToggleBtn && filterRow) {
            filterToggleBtn.addEventListener('click', function() {
                filterRow.classList.toggle('hidden');
                if (filterArrow) {
                    filterArrow.classList.toggle('rotate-180');
                }
            });
        }
        
        // Auto-show filter if subcategory is selected
        if (selectedSubcategoryId) {
            if (filterRow) {
                filterRow.classList.remove('hidden');
                if (filterArrow) {
                    filterArrow.classList.add('rotate-180');
                }
            }
        }
        
        // Function to apply filters
        function applyFilters() {
            const productsGridContainer = document.getElementById('products-grid');
            if (!productsGridContainer) return;
            
            // Show loading state
            productsGridContainer.innerHTML = '<div class="col-span-full text-center py-12"><p class="text-gray-600 text-lg">Loading products...</p></div>';
            
            // Prepare form data
            const formData = new FormData();
            if (filterState.subcategoryId) {
                formData.append('subcategory_id', filterState.subcategoryId);
            }
            if (filterState.tags.length > 0) {
                filterState.tags.forEach(tag => {
                    formData.append('tags[]', tag);
                });
            }
            if (filterState.sort) {
                formData.append('sort', filterState.sort);
            }

            // Send AJAX request
            fetch(`/api/category/${categoryId}/products/filter`, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    productsGridContainer.innerHTML = data.html;
                } else {
                    productsGridContainer.innerHTML = '<div class="col-span-full text-center py-12"><p class="text-gray-600 text-lg">Error loading products.</p></div>';
                }
            })
            .catch(error => {
                console.error('Error filtering products:', error);
                productsGridContainer.innerHTML = '<div class="col-span-full text-center py-12"><p class="text-red-600 text-lg">Error loading products. Please try again.</p></div>';
            });
        }
        
        // Subcategory Options
        const subcategoryOptions = document.querySelectorAll('.subcategory-option');
        subcategoryOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                subcategoryOptions.forEach(o => {
                    o.classList.remove('active', 'text-blue-600', 'border-b', 'border-blue-600', 'pb-1');
                    o.classList.add('text-gray-500');
                });
                this.classList.add('active', 'text-blue-600', 'border-b', 'border-blue-600', 'pb-1');
                this.classList.remove('text-gray-500');
                
                const subcategoryId = this.getAttribute('data-subcategory');
                filterState.subcategoryId = subcategoryId || null;
                applyFilters();
            });
        });
        
        // Filter Options (Sort By, Price)
        const filterOptions = document.querySelectorAll('.filter-option');
        filterOptions.forEach(option => {
            option.addEventListener('click', function(e) {
                e.preventDefault();
                const parent = this.closest('ul');
                const siblings = parent.querySelectorAll('.filter-option');
                siblings.forEach(s => {
                    s.classList.remove('active', 'text-blue-600', 'border-b', 'border-blue-600', 'pb-1');
                    s.classList.add('text-gray-500');
                });
                this.classList.add('active', 'text-blue-600', 'border-b', 'border-blue-600', 'pb-1');
                this.classList.remove('text-gray-500');
                
                const sortValue = this.getAttribute('data-sort');
                filterState.sort = sortValue;
                applyFilters();
            });
        });
        
        // Tag Options
        const tagOptions = document.querySelectorAll('.tag-option');
        tagOptions.forEach(tag => {
            tag.addEventListener('click', function(e) {
                e.preventDefault();
                this.classList.toggle('active');
                const tagId = this.getAttribute('data-tag');
                
                if (this.classList.contains('active')) {
                    if (!filterState.tags.includes(tagId)) {
                        filterState.tags.push(tagId);
                    }
                } else {
                    filterState.tags = filterState.tags.filter(id => id !== tagId);
                }
                applyFilters();
            });
        });
        
        // Apply filters on page load if subcategory is selected
        if (selectedSubcategoryId) {
            applyFilters();
        }
    });
</script>
@endsection

