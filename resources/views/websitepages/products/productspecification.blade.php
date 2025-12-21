@extends('websitepages.layouts.app')

@section('title', $product->name ?? 'Product Details')

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
            @if($product->category)
                <li><a href="{{ route('category.show', $product->category->category_id) }}" class="hover:text-blue-600">{{ $product->category->category_name }}</a></li>
            @endif
            @if($product->subcategory)
                <li><span class="mx-2">/</span></li>
                <li><a href="{{ route('category.show', $product->category->category_id) }}?subcategory={{ $product->subcategory->subcategory_id }}" class="hover:text-blue-600">{{ $product->subcategory->subcategory_name }}</a></li>
            @endif
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-medium">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Product Images -->
        <div>
            <div class="sticky top-4">
                <!-- Main Image -->
                @php
                    $mainImage = $product->productImages->first();
                    $mainImageUrl = $mainImage 
                        ? Storage::url($mainImage->image_path) 
                        : ($product->front_image ? Storage::url($product->front_image) : asset('images/static_image/placeholder.jpg'));
                @endphp
                
                <div class="mb-4 bg-white rounded-lg overflow-hidden shadow-md">
                    <img id="main-product-image" src="{{ $mainImageUrl }}" alt="{{ $product->name }}" class="w-full h-auto object-cover">
                </div>

                <!-- Thumbnail Gallery -->
                @if($product->productImages->count() > 1)
                    <div class="flex space-x-2 overflow-x-auto pb-2">
                        @foreach($product->productImages as $image)
                            <button onclick="changeMainImage('{{ Storage::url($image->image_path) }}')" 
                                    class="flex-shrink-0 w-20 h-20 border-2 border-transparent hover:border-blue-600 rounded-lg overflow-hidden focus:outline-none focus:border-blue-600">
                                <img src="{{ Storage::url($image->image_path) }}" alt="Thumbnail" class="w-full h-full object-cover">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Product Details -->
        <div>
            <!-- Product Name -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

            <!-- Rating -->
            <div class="flex items-center mb-4">
                @for($i = 0; $i < 5; $i++)
                    <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                @endfor
                <span class="ml-2 text-gray-600">(5.0)</span>
            </div>

            <!-- Price -->
            <div class="mb-6">
                <p class="text-3xl font-bold text-gray-800">TSH {{ number_format($product->price ?? 0, 2) }}</p>
            </div>

            <!-- Availability Status -->
            <div class="mb-6">
                @if($product->available)
                    <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-lg font-semibold">
                        In Stock
                    </span>
                @else
                    <span class="inline-block bg-red-100 text-red-800 px-4 py-2 rounded-lg font-semibold">
                        Out of Stock
                    </span>
                @endif
            </div>

            <!-- Product Information -->
            <div class="border-t border-b border-gray-200 py-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Product Information</h2>
                <div class="space-y-3">
                    @if($product->brand)
                        <div class="flex">
                            <span class="font-semibold text-gray-700 w-32">Brand:</span>
                            <span class="text-gray-600">{{ $product->brand->brand_name ?? 'N/A' }}</span>
                        </div>
                    @endif
                    
                    @if($product->category)
                        <div class="flex">
                            <span class="font-semibold text-gray-700 w-32">Category:</span>
                            <a href="{{ route('category.show', $product->category->category_id) }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                {{ $product->category->category_name }}
                            </a>
                        </div>
                    @endif
                    
                    @if($product->subcategory)
                        <div class="flex">
                            <span class="font-semibold text-gray-700 w-32">Subcategory:</span>
                            <a href="{{ route('category.show', $product->category->category_id) }}?subcategory={{ $product->subcategory->subcategory_id }}" class="text-blue-600 hover:text-blue-800 hover:underline">
                                {{ $product->subcategory->subcategory_name }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Product Attributes -->
            @if($product->productAttributeValues->count() > 0)
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">Specifications</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <table class="w-full">
                            <tbody class="divide-y divide-gray-200">
                                @foreach($product->productAttributeValues as $attrValue)
                                    <tr>
                                        <td class="py-2 font-semibold text-gray-700 w-1/3">
                                            {{ $attrValue->productAttribute->name ?? 'N/A' }}:
                                        </td>
                                        <td class="py-2 text-gray-600">
                                            {{ $attrValue->value ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
    function changeMainImage(imageUrl) {
        document.getElementById('main-product-image').src = imageUrl;
    }
</script>

@endsection

