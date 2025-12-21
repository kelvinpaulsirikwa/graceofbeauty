
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .about-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 100vh;
        align-items: center;
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
        background: #5b8def;
        color: white;
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
        background: #4a7ad8;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(91, 141, 239, 0.3);
    }

    @media (max-width: 1024px) {
        .about-section {
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

<section class="about-section">
    <!-- Image Side -->
    <div class="image-container">
        <img src="{{ asset('images/static_image/aboutuscontents.png') }}" 
             alt="Premium Haircare Products" 
             class="professional-image">
    </div>

    <!-- Content Side -->
    <div class="content-container">
        <p class="section-label">About {{ config('site.name') }}</p>
        
        <h1 class="main-heading">
            Trusted  for Quality Hair Care & Natural Beauty
        </h1>

        <p class="description-text">
            At {{ config('site.name') }}, we specialize in bringing your hair to life with 
            premium products, 
            and a wide range of natural hair-care solutions. For years, we’ve been committed 
            to helping people embrace their unique style while keeping their hair healthy, 
            strong, and beautifully radiant.
        </p>

        <p class="description-text">
            Inspired by nature, our formulas blend traditional herbal extracts with 
            modern hair-care science. From protective styles to deep-treatment oils, 
            every product is crafted to deliver nourishment, shine, and confidence — 
            no matter your hair journey.
        </p>

        <a href="#" class="cta-button">Learn More</a>
    </div>
</section>

