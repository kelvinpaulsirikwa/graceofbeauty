@extends('websitepages.layouts.app')

@section('title', 'Our Services')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@push('styles')
<style>
    /* Hero Banner Section */
    .services-hero {
        position: relative;
        width: 100%;
        height: 500px;
        background-image: url("{{ asset('images/static_image/aboutus.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .services-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(212, 175, 55, 0.3); /* Semi-transparent gold overlay with reduced opacity */
        z-index: 1;
    }

    .services-hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        width: 100%;
        max-width: 1200px;
        padding: 0 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .breadcrumb {
        font-size: 14px;
        margin-bottom: 20px;
        letter-spacing: 1px;
        opacity: 0.9;
    }

    .breadcrumb a {
        color: white;
        text-decoration: none;
        transition: opacity 0.3s;
    }

    .breadcrumb a:hover {
        opacity: 0.7;
    }

    .services-hero-title {
        font-size: 72px;
        font-weight: 700;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-family: 'Arial', sans-serif;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .services-hero {
            height: 400px;
        }

        .services-hero-title {
            font-size: 48px;
        }

        .breadcrumb {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .services-hero {
            height: 350px;
        }

        .services-hero-title {
            font-size: 36px;
        }
    }
</style>
@endpush

@section('content')

<!-- Hero Banner Section -->
<section class="services-hero">
    <div class="services-hero-content">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">HOME</a> > <span>OUR SERVICES</span> >
        </div>
        <h1 class="services-hero-title">Our Services</h1>
    </div>
</section>

<!-- Services Section -->
<section class="services-section py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Services Grid -->
        @if($services && $services->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <a href="{{ route('services.show', $service->service_id) }}" class="service-card bg-white rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 block">
                        <!-- Service Image -->
                        @if($service->front_image)
                            <div class="relative h-64 overflow-hidden">
                                <img 
                                    src="{{ Storage::url($service->front_image) }}" 
                                    alt="{{ $service->service_name }}" 
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                                >
                            </div>
                        @elseif($service->serviceImages && $service->serviceImages->count() > 0)
                            <div class="relative h-64 overflow-hidden">
                                <img 
                                    src="{{ Storage::url($service->serviceImages->first()->image_path) }}" 
                                    alt="{{ $service->service_name }}" 
                                    class="w-full h-full object-cover transition-transform duration-300 hover:scale-110"
                                >
                            </div>
                        @else
                            <div class="relative h-64 bg-gradient-to-br from-yellow-400 to-yellow-600 flex items-center justify-center">
                                <svg class="w-24 h-24 text-white opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif

                        <!-- Service Content -->
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">{{ $service->service_name }}</h3>
                            
                            @if($service->description)
                                <p class="text-gray-600 mb-4 line-clamp-3">{{ $service->description }}</p>
                            @endif

                            @if($service->serviceImages && $service->serviceImages->count() > 0)
                                <div class="text-sm text-gray-500">
                                    <p>{{ $service->serviceImages->count() }} {{ Str::plural('image', $service->serviceImages->count()) }}</p>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">No services available at the moment.</p>
            </div>
        @endif
    </div>
</section>

@include('websitepages.aboutus.welcometaboutus')

@include('websitepages.aboutus.meetingourteam', ['leadershipTeams' => $leadershipTeams])

<style>
    .services-section {
        font-family: 'Arial', sans-serif;
    }
    
    .service-card {
        transition: all 0.3s ease;
    }
    
    .service-card:hover {
        transform: translateY(-5px);
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection

