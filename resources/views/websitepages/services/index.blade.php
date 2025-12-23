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
@include('websitepages.aboutus.welcometaboutus')

<!-- Services Section -->
<section class="services-section py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Services Grid with About Layout (Zigzag) -->
        @if($services && $services->count() > 0)
            @foreach($services as $index => $service)
                <section class="service-about-section {{ $index % 2 == 0 ? 'reverse-layout' : '' }}">
                    <!-- Image Side -->
                     
                    <div class="image-container">
                        @if($service->front_image)
                            <img src="{{ Storage::url($service->front_image) }}" 
                                 alt="{{ $service->service_name }}" 
                                 class="professional-image">
                        @elseif($service->serviceImages && $service->serviceImages->count() > 0)
                            <img src="{{ Storage::url($service->serviceImages->first()->image_path) }}" 
                                 alt="{{ $service->service_name }}" 
                                 class="professional-image">
                        @else
                            <div class="professional-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 48px; font-weight: 700;">
                                {{ strtoupper(substr($service->service_name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <!-- Content Side -->
                    <div class="content-container">
                        <p class="section-label">About {{ $service->service_name }}</p>
                        
                        <h1 class="main-heading">
                            {{ $service->service_name }}
                        </h1>

                        @if($service->description)
                            @php
                                // Limit description to approximately 3-4 paragraphs (around 900 characters)
                                $maxLength = 900;
                            @endphp
                            <div class="description-text">
                                {!! Str::limit($service->description, $maxLength, '...') !!}
                            </div>
                        @else
                            <p class="description-text">
                                Discover our premium {{ $service->service_name }} service designed to enhance your beauty and style.
                            </p>
                        @endif

                        <a href="{{ route('services.show', $service->service_id) }}" class="cta-button">Learn More</a>
                    </div>
                </section>
                <br>
            @endforeach
        @else
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">No services available at the moment.</p>
            </div>
        @endif
    </div>
</section>


@include('websitepages.aboutus.meetingourteam', ['leadershipTeams' => $leadershipTeams])

@include('websitepages.userfeedback.userfeedbackservice', ['userFeedbacks' => $userFeedbacks ?? collect()])

<style>
    .services-section {
        font-family: 'Arial', sans-serif;
    }

    .service-about-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 100vh;
        align-items: start;
    }

    .service-about-section.reverse-layout .image-container {
        order: 2;
    }

    .service-about-section.reverse-layout .content-container {
        order: 1;
    }

    .image-container {
        background: #ffffff;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .professional-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 0;
        box-shadow: none;
    }

    .content-container {
        padding: 4rem 5rem;
        max-width: 650px;
    }

    .section-label {
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 600;
        letter-spacing: 2px;
        color: #999;
        margin-bottom: 1rem;
    }

    .main-heading {
        font-size: 2.75rem;
        font-weight: 700;
        line-height: 1.2;
        color: #1a1a1a;
        margin-bottom: 2rem;
    }

    .description-text {
        font-size: 1rem;
        line-height: 1.8;
        color: #666;
        margin-bottom: 1.5rem;
    }

   

   

  


   

    .cta-button {
        display: inline-block;
        padding: 0.875rem 2rem;
        background: #000;
        color: var(--gold-color, #D4AF37);
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        margin-top: 1rem;
        border: none;
        cursor: pointer;
    }

    .cta-button:hover {
        background: #1a1a1a;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
    }

    @media (max-width: 1024px) {
        .service-about-section {
            grid-template-columns: 1fr;
        }

        .image-container {
            min-height: 400px;
        }

        .professional-image {
            border-radius: 0;
        }

        .content-container {
            padding: 3rem 2rem;
        }

        .main-heading {
            font-size: 2.25rem;
        }
    }

    @media (max-width: 768px) {
        .content-container {
            padding: 2rem 1.5rem;
        }

        .main-heading {
            font-size: 1.875rem;
        }

        .image-container {
            padding: 0;
        }

        .professional-image {
            border-radius: 0;
        }
    }
</style>
@endsection

