@php
    use Illuminate\Support\Facades\Storage;
@endphp

<!-- Payment Methods Section -->
<section class="payment-methods-section py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4 max-w-7xl">
        <!-- Header -->
        <div class="text-center mb-10">
            <div class="inline-block mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider" style="color: var(--gold-color, #D4AF37);">PAYMENT</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                Payment Methods
            </h2>
            <div class="w-20 h-1 mx-auto mb-4" style="background-color: var(--gold-color, #D4AF37);"></div>
            <p class="text-sm md:text-base text-gray-600 max-w-2xl mx-auto">
                We accept various payment methods for your convenience
            </p>
        </div>

        @if($payments && $payments->count() > 0)
            <!-- Payment Slider Container -->
            <div class="payment-slider-container">
                <div class="swiper paymentSwiper">
                    <div class="swiper-wrapper">
                        @foreach($payments as $payment)
                            <div class="swiper-slide">
                                <div class="payment-item">
                                    <!-- Left Side - Image -->
                                    <div class="payment-image-side">
                                        @if($payment->image)
                                            <img src="{{ Storage::url($payment->image) }}" 
                                                 alt="{{ $payment->name }}" 
                                                 class="payment-image">
                                        @else
                                            <div class="payment-placeholder">
                                                <svg class="w-24 h-24 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Right Side - Details -->
                                    <div class="payment-details-side">
                                        <h3 class="payment-name">{{ $payment->name }}</h3>
                                        @if($payment->description)
                                            <p class="payment-description">{{ $payment->description }}</p>
                                        @else
                                            <p class="payment-description text-gray-400">No description available</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    @if($payments->count() > 1)
                        <!-- Navigation Arrows -->
                        <div class="payment-swiper-button-prev">
                            <div class="nav-button-inner">
                                <svg class="nav-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="payment-swiper-button-next">
                            <div class="nav-button-inner">
                                <svg class="nav-chevron" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Features Row -->
            <div class="features-row mt-12 md:mt-16">
                <div class="features-grid">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold-color, #D4AF37);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">Money Back Guarantee</h3>
                        <p class="feature-description">If good have Problems</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold-color, #D4AF37);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">Online Support 24/7</h3>
                        <p class="feature-description">Dedicated support</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold-color, #D4AF37);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">Payment Secure</h3>
                        <p class="feature-description">100% secure payment</p>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold-color, #D4AF37);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="feature-title">Free Shipping</h3>
                        <p class="feature-description">For all oder over Tsh 1M</p>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-20 bg-gray-50 rounded-2xl">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4 shadow-sm">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">No Payment Methods Available</h3>
                <p class="text-gray-600">Payment options will be displayed here once they are configured.</p>
            </div>
        @endif
    </div>
</section>

<!-- Swiper JS (Local) -->
<link rel="stylesheet" href="{{ asset('css/swiper/swiper-bundle.min.css') }}" />
<script src="{{ asset('js/swiper/swiper-bundle.min.js') }}"></script>

<style>
    .payment-methods-section {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }

    /* Payment Slider Container */
    .payment-slider-container {
        position: relative;
        margin-bottom: 40px;
    }

    .paymentSwiper {
        overflow: hidden;
        border-radius: 16px;
        background: white;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    /* Payment Item Layout - Split Design */
    .payment-item {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 400px;
        align-items: center;
        gap: 0;
    }

    /* Left Side - Image */
    .payment-image-side {
        background: #f9fafb;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px;
        min-height: 400px;
    }

    .payment-image {
        max-width: 100%;
        max-height: 350px;
        width: auto;
        height: auto;
        object-fit: contain;
        border-radius: 8px;
    }

    .payment-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border-radius: 8px;
    }

    /* Right Side - Details */
    .payment-details-side {
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: white;
    }

    .payment-name {
        font-size: 2.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .payment-description {
        font-size: 1.125rem;
        color: #6b7280;
        line-height: 1.8;
        max-width: 500px;
    }

    /* Navigation Arrows - Centered on Left and Right */
    .payment-swiper-button-next,
    .payment-swiper-button-prev {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 70px;
        height: 70px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.12);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        z-index: 10;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        border: 2px solid transparent;
    }

    .payment-swiper-button-prev {
        left: 15px;
    }

    .payment-swiper-button-next {
        right: 15px;
    }

    .payment-swiper-button-next:after,
    .payment-swiper-button-prev:after {
        display: none;
    }

    .nav-button-inner {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .nav-chevron {
        width: 28px;
        height: 28px;
        color: var(--gold-color, #D4AF37);
        transition: all 0.3s ease;
    }

    .payment-swiper-button-next:hover,
    .payment-swiper-button-prev:hover {
        background: var(--gold-color, #D4AF37);
        box-shadow: 0 8px 32px rgba(212, 175, 55, 0.3);
        transform: translateY(-50%) scale(1.08);
        border-color: rgba(212, 175, 55, 0.2);
    }

    .payment-swiper-button-next:hover .nav-chevron,
    .payment-swiper-button-prev:hover .nav-chevron {
        color: white;
        transform: scale(1.1);
    }

    .payment-swiper-button-next:active,
    .payment-swiper-button-prev:active {
        transform: translateY(-50%) scale(0.95);
    }

    /* Features Row */
    .features-row {
        border-top: 1px solid #e5e7eb;
        padding-top: 40px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 30px;
    }

    .feature-item {
        text-align: center;
        padding: 20px;
        transition: transform 0.3s ease;
    }

    .feature-item:hover {
        transform: translateY(-5px);
    }

    .feature-icon {
        margin: 0 auto 15px;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fee2e2;
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    .feature-item:hover .feature-icon {
        background: var(--gold-color-dark, #A0821A);
    }

    .feature-item:hover .feature-icon svg {
        color: white !important;
    }

    .feature-title {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 8px;
    }

    .feature-description {
        font-size: 0.875rem;
        color: #6b7280;
        line-height: 1.5;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .payment-details-side {
            padding: 40px 30px;
        }

        .payment-name {
            font-size: 2rem;
        }

        .payment-description {
            font-size: 1rem;
        }
    }

    @media (max-width: 768px) {
        .payment-item {
            grid-template-columns: 1fr;
            min-height: auto;
        }

        .payment-image-side {
            min-height: 250px;
            padding: 30px 20px;
        }

        .payment-image {
            max-height: 200px;
        }

        .payment-details-side {
            padding: 30px 20px;
        }

        .payment-name {
            font-size: 1.75rem;
            margin-bottom: 15px;
        }

        .payment-description {
            font-size: 0.9375rem;
        }

        .payment-swiper-button-next,
        .payment-swiper-button-prev {
            width: 50px;
            height: 50px;
        }

        .payment-swiper-button-prev {
            left: 10px;
        }

        .payment-swiper-button-next {
            right: 10px;
        }

        .nav-chevron {
            width: 22px;
            height: 22px;
        }

        .features-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .feature-item {
            padding: 15px 10px;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
        }

        .feature-icon svg {
            width: 28px;
            height: 28px;
        }

        .feature-title {
            font-size: 0.875rem;
        }

        .feature-description {
            font-size: 0.75rem;
        }
    }

    @media (max-width: 480px) {
        .features-grid {
            grid-template-columns: 1fr;
        }

        .payment-swiper-button-next,
        .payment-swiper-button-prev {
            width: 45px;
            height: 45px;
        }

        .payment-swiper-button-prev {
            left: 5px;
        }

        .payment-swiper-button-next {
            right: 5px;
        }

        .nav-chevron {
            width: 20px;
            height: 20px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const paymentCount = {{ $payments ? $payments->count() : 0 }};
        
        if (paymentCount > 0) {
            const swiper = new Swiper('.paymentSwiper', {
                slidesPerView: 1,
                spaceBetween: 0,
                loop: paymentCount > 1,
                grabCursor: true,
                autoplay: paymentCount > 1 ? {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                } : false,
                navigation: paymentCount > 1 ? {
                    nextEl: '.payment-swiper-button-next',
                    prevEl: '.payment-swiper-button-prev',
                } : false,
                effect: 'slide',
                speed: 600,
            });
        }
    });
</script>