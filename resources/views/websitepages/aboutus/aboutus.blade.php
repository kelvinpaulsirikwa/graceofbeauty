@extends('websitepages.layouts.app')
@section('title', 'About Us')

@push('styles')
<style>
    /* Hero Banner Section */
    .about-hero {
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

    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(212, 175, 55, 0.3); /* Semi-transparent gold overlay with reduced opacity */
        z-index: 1;
    }

    .about-hero-content {
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

    .about-hero-title {
        font-size: 72px;
        font-weight: 700;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-family: 'Arial', sans-serif;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .about-hero {
            height: 400px;
        }

        .about-hero-title {
            font-size: 48px;
        }

        .breadcrumb {
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .about-hero {
            height: 350px;
        }

        .about-hero-title {
            font-size: 36px;
        }
    }
</style>
@endpush

@section('content')

<!-- Hero Banner Section -->
<section class="about-hero">
    <div class="about-hero-content">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">HOME</a> > <span>ABOUT US</span> >
        </div>
        <h1 class="about-hero-title">About Us</h1>
    </div>
</section>
 

@include('websitepages.aboutus.welcometaboutus')

@include('websitepages.aboutus.meetingourteam')

@endsection

