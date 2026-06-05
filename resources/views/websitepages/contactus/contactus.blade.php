@extends('websitepages.layouts.app')
@section('title', 'Contact Us')

@section('content')
<section class="contact-hero">
    <div class="contact-hero-inner">
        <h1 class="contact-title">Contact us</h1>
        <p class="contact-lead">Have questions or need more details about our services?</p>
        <p class="contact-lead">Send us a message, we're here to help and will get back to you soon.</p>
        <p class="contact-lead contact-lead-last">Your enquiry matters, and we'll make sure it reaches the right team quickly.</p>
    </div>

    <div class="contact-cards">
        <div class="contact-card">
            <div class="contact-card-icon">
                <svg width="32" height="32" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                    <circle cx="12" cy="10" r="3"></circle>
                </svg>
            </div>
            <h3 class="contact-card-label">Office Address</h3>
            <p class="contact-card-sub">Find Us Here</p>
            <p class="contact-card-value">{{ config('site.contact.address') }}</p>
        </div>

        <div class="contact-card">
            <div class="contact-card-icon">
                <svg width="32" height="32" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                </svg>
            </div>
            <h3 class="contact-card-label">Phone Number</h3>
            <p class="contact-card-sub">Call Us Now</p>
            <p class="contact-card-value contact-card-value-strong">
                <a href="tel:{{ preg_replace('/\s+/', '', config('site.contact.phone')) }}">{{ config('site.contact.phone') }}</a>
            </p>
        </div>

        <div class="contact-card">
            <div class="contact-card-icon">
                <svg width="32" height="32" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
            </div>
            <h3 class="contact-card-label">Email Address</h3>
            <p class="contact-card-sub">Send Us Mail</p>
            <p class="contact-card-value contact-card-value-strong">
                <a href="mailto:{{ config('site.contact.email') }}">{{ config('site.contact.email') }}</a>
            </p>
        </div>
    </div>
</section>

<section class="contact-consultation">
    <div class="contact-consultation-inner">
        <div class="contact-consultation-grid">
            <div class="contact-form-wrap">
                <div class="contact-form-box">
                    <h2 class="contact-form-title">✨ Set Up a Styling Consultation ✨</h2>

                    @if(session('success'))
                        <div class="contact-alert contact-alert-success">{{ session('success') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="contact-alert contact-alert-error">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
                        @csrf
                        <div class="contact-form-row">
                            <input type="text" name="name" placeholder="Your Name" required class="contact-input">
                            <input type="email" name="email" placeholder="Your Email" required class="contact-input">
                        </div>

                        <div class="contact-form-row">
                            <input type="tel" name="phone" placeholder="Your Phone" required class="contact-input">
                            <input type="text" name="services" placeholder="Your Services" class="contact-input">
                        </div>

                        <textarea name="message" placeholder="Message" rows="5" required class="contact-textarea"></textarea>

                        <button type="submit" class="contact-submit">Send Message</button>
                    </form>
                </div>
            </div>

            <div class="contact-image-wrap">
                <div class="contact-shape contact-shape-green" aria-hidden="true"></div>
                <div class="contact-shape contact-shape-blue" aria-hidden="true"></div>
                <img src="{{ asset('images/static_image/contactus.jpg') }}"
                     alt="Customer Support Representative"
                     class="contact-image">
            </div>
        </div>
    </div>
</section>

<section class="contact-map">
    <iframe
        src="https://www.google.com/maps?q={{ config('site.contact.latitude') }},{{ config('site.contact.longitude') }}&output=embed&zoom=15"
        title="Office location map"
        allowfullscreen=""
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</section>

<style>
    .contact-hero {
        background: #ffffff;
        padding: clamp(2.5rem, 6vw, 4.5rem) clamp(1rem, 4vw, 1.5rem);
        text-align: center;
    }

    .contact-hero-inner {
        max-width: 900px;
        margin: 0 auto;
    }

    .contact-title {
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 1.25rem;
        line-height: 1.15;
    }

    .contact-lead {
        color: #64748b;
        font-size: clamp(0.95rem, 2.5vw, 1rem);
        line-height: 1.6;
        margin-bottom: 0.25rem;
    }

    .contact-lead-last {
        margin-bottom: 0;
    }

    .contact-cards {
        max-width: 1100px;
        margin: clamp(1.75rem, 4vw, 2.25rem) auto 0;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: clamp(1rem, 3vw, 1.5rem);
        padding: 0 clamp(0.25rem, 2vw, 0.5rem);
    }

    .contact-card {
        background: #ffffff;
        border-radius: 16px;
        padding: clamp(1.75rem, 4vw, 3rem) clamp(1.25rem, 3vw, 2.5rem);
        text-align: center;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.07);
        border: 1px solid #e2e8f0;
    }

    .contact-card-icon {
        width: 70px;
        height: 70px;
        background: #0f172a;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.25rem;
        flex-shrink: 0;
    }

    .contact-card-label {
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #0f172a;
        margin-bottom: 0.5rem;
    }

    .contact-card-sub {
        color: #94a3b8;
        font-size: 14px;
        margin-bottom: 0.75rem;
    }

    .contact-card-value {
        color: #64748b;
        font-size: 15px;
        line-height: 1.7;
        word-break: break-word;
    }

    .contact-card-value-strong {
        font-weight: 600;
        font-size: clamp(0.95rem, 2.5vw, 1.05rem);
    }

    .contact-card-value a {
        color: inherit;
        text-decoration: none;
    }

    .contact-card-value a:hover {
        color: #0f172a;
    }

    .contact-consultation {
        padding: clamp(2rem, 5vw, 3rem) clamp(1rem, 4vw, 1.5rem) clamp(3rem, 6vw, 5rem);
        background: linear-gradient(to bottom, #ffffff 0%, #f8fafc 100%);
        overflow: hidden;
    }

    .contact-consultation-inner {
        max-width: 1100px;
        margin: 0 auto;
    }

    .contact-consultation-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: clamp(2rem, 6vw, 5rem);
        align-items: center;
    }

    .contact-form-box {
        background: #0f172a;
        padding: clamp(1.75rem, 4vw, 3.5rem) clamp(1.25rem, 4vw, 3rem);
        border-radius: 20px;
    }

    .contact-form-title {
        color: #fff;
        font-size: clamp(1.5rem, 4vw, 2.375rem);
        margin-bottom: clamp(1.5rem, 4vw, 2.5rem);
        font-weight: 700;
        line-height: 1.25;
    }

    .contact-alert {
        padding: 1rem 1.25rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        font-size: 15px;
        color: #fff;
    }

    .contact-alert-success {
        background: #10b981;
    }

    .contact-alert-error {
        background: #ef4444;
    }

    .contact-alert ul {
        margin: 0;
        padding-left: 1.25rem;
    }

    .contact-form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .contact-input,
    .contact-textarea {
        padding: 1rem 1.125rem;
        border: none;
        border-radius: 8px;
        font-size: 15px;
        width: 100%;
        box-sizing: border-box;
        background: #fff;
        color: #1e293b;
        font-family: inherit;
    }

    .contact-textarea {
        margin-bottom: 1.5rem;
        resize: vertical;
        min-height: 130px;
        line-height: 1.5;
    }

    .contact-input::placeholder,
    .contact-textarea::placeholder {
        color: #94a3b8;
    }

    .contact-input:focus,
    .contact-textarea:focus {
        outline: 2px solid rgba(16, 185, 129, 0.45);
        outline-offset: 1px;
    }

    .contact-submit {
        background: #10b981;
        color: #fff;
        padding: 1rem 2.5rem;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        transition: background 0.3s ease;
        font-family: inherit;
        width: 100%;
        max-width: 100%;
    }

    .contact-submit:hover {
        background: #059669;
    }

    .contact-image-wrap {
        position: relative;
        width: 100%;
        max-width: 520px;
        margin: 0 auto;
    }

    .contact-shape {
        position: absolute;
        z-index: 0;
        opacity: 0.85;
        pointer-events: none;
    }

    .contact-shape-green {
        top: -2rem;
        left: -1.5rem;
        width: clamp(140px, 30vw, 280px);
        height: clamp(140px, 30vw, 280px);
        background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        border-radius: 45% 55% 60% 40% / 50% 60% 40% 50%;
    }

    .contact-shape-blue {
        bottom: -2rem;
        right: -1.5rem;
        width: clamp(120px, 28vw, 250px);
        height: clamp(120px, 28vw, 250px);
        background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
        border-radius: 60% 40% 45% 55% / 40% 50% 50% 60%;
    }

    .contact-image {
        width: 100%;
        height: auto;
        border-radius: 20px;
        position: relative;
        z-index: 1;
        display: block;
    }

    .contact-map {
        width: 100%;
        height: clamp(280px, 50vh, 600px);
        overflow: hidden;
    }

    .contact-map iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }

    @media (max-width: 992px) {
        .contact-cards {
            grid-template-columns: 1fr;
            max-width: 480px;
        }

        .contact-consultation-grid {
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }

        .contact-image-wrap {
            order: -1;
            max-width: 420px;
        }
    }

    @media (max-width: 640px) {
        .contact-form-row {
            grid-template-columns: 1fr;
        }

        .contact-shape-green {
            top: -1rem;
            left: -0.75rem;
        }

        .contact-shape-blue {
            bottom: -1rem;
            right: -0.75rem;
        }

        .contact-form-box {
            border-radius: 16px;
        }
    }

    @media (max-width: 400px) {
        .contact-card-icon {
            width: 58px;
            height: 58px;
        }

        .contact-card-icon svg {
            width: 26px;
            height: 26px;
        }
    }
</style>
@endsection
