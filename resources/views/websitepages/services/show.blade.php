@extends('websitepages.layouts.app')

@section('title', $service->service_name ?? 'Service Details')

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
            <li><a href="{{ route('services') }}" class="hover:text-blue-600">Services</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-medium">{{ $service->service_name }}</li>
        </ol>
    </nav>

    <!-- Service Header -->
    <div class="mb-12 text-center">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
            <span class="relative inline-block">
                {{ strtoupper($service->service_name) }}
            </span>
        </h1>
        @if($service->description)
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $service->description }}</p>
        @endif
    </div>

    <!-- Service Images with Zigzag Layout -->
    @if($images && $images->count() > 0)
        <div class="space-y-12 mb-12">
            @foreach($images as $index => $image)
                <div class="zigzag-item {{ $index % 2 == 0 ? 'image-left' : 'image-right' }}">
                    <div class="flex flex-col md:flex-row items-stretch gap-8 {{ $index % 2 == 0 ? '' : 'md:flex-row-reverse' }}">
                        <!-- Image Section -->
                        <div class="w-full md:w-1/2 flex">
                            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 w-full flex items-center justify-center">
                                <img 
                                    src="{{ Storage::url($image->image_path) }}" 
                                    alt="{{ $image->description ?? $service->service_name }}" 
                                    class="w-full h-full object-cover zigzag-image"
                                >
                            </div>
                        </div>

                        <!-- Description Section -->
                        <div class="w-full md:w-1/2 flex">
                            <div class="bg-gray-50 rounded-lg p-6 md:p-8 shadow-md w-full flex flex-col zigzag-description">
                                <div class="mb-4">
                                    <span class="text-sm font-semibold text-blue-600 uppercase tracking-wide">
                                        Image {{ $images->firstItem() + $index }}
                                    </span>
                                </div>
                                
                                <h3 class="text-2xl font-bold text-gray-800 mb-4">
                                    {{ $image->description ? Str::limit($image->description, 50) : 'Service Image' }}
                                </h3>
                                
                                <div class="flex-1 overflow-y-auto mb-6 description-scroll">
                                    @if($image->description)
                                        <p class="text-gray-700 text-lg leading-relaxed">
                                            {{ $image->description }}
                                        </p>
                                    @else
                                        <p class="text-gray-500 italic">No description available for this image.</p>
                                    @endif
                                </div>

                                <div class="border-t border-gray-200 pt-4 mt-auto">
                                    <div class="flex items-center justify-between text-sm text-gray-600">
                                        @if($image->creator && $image->creator->name)
                                            <div class="flex items-center space-x-2">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                <span><strong>Posted by:</strong> {{ $image->creator->name }}</span>
                                            </div>
                                        @endif
                                        <div class="flex items-center space-x-2 {{ !($image->creator && $image->creator->name) ? 'ml-auto' : '' }}">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <span>{{ $image->created_at->format('M d, Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $images->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <div class="text-center py-12 bg-white rounded-lg shadow-md">
            <p class="text-gray-600 text-lg">No images available for this service.</p>
        </div>
    @endif
</div>

<style>
    .zigzag-item {
        animation: fadeInUp 0.6s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .zigzag-item:nth-child(even) {
        animation-delay: 0.1s;
    }

    .zigzag-image {
        min-height: 500px;
        max-height: 500px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .zigzag-item:hover .zigzag-image {
        transform: scale(1.02);
    }

    .zigzag-description {
        min-height: 500px;
        max-height: 500px;
    }

    .description-scroll {
        max-height: calc(500px - 200px);
        padding-right: 8px;
    }

    .description-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .description-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .description-scroll::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .description-scroll::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    @media (max-width: 768px) {
        .zigzag-image {
            min-height: 300px;
            max-height: 300px;
        }

        .zigzag-description {
            min-height: auto;
            max-height: none;
        }

        .description-scroll {
            max-height: none;
        }
    }
</style>
@endsection
