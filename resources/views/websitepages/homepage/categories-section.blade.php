@php
    use Illuminate\Support\Facades\Storage;
@endphp

<!-- Hero Section with Welcome Area and Categories -->
<div class="hero-section-container">
    <!-- Welcome Area Start -->
    <section class="welcome-area">
        <div class="welcome-bg" style="background-image: url('{{ asset('images/static_image/frontimage.jpg') }}');">
            <div class="welcome-overlay"></div>
        </div>
        <div class="welcome-text">
        <h2>Beauty Enhanced<br>With Quality</h2>
        <p>
        "Explore premium wigs, human hair, beauty oils, accessories, and more.  
        Define your unique style with products crafted to bring out your confidence 
        and help you express your true beauty."
    </p>
    <a href="{{ route('made-for-you') }}" class="btn-akame-btn">Made for You</a>
</div>

    </section>
    <!-- Welcome Area End -->

    <!-- Categories Grid Section -->
    <section class="categories-section">
        <div class="categories-grid-container">
            @if($categories->count() > 0)
                @foreach($categories->take(4) as $index => $category)
                    <a href="{{ route('category.show', $category->category_id) }}" class="category-card" style="display: block; text-decoration: none; color: inherit;">
                        <div class="category-bg" style="background-image: url('{{ $category->front_image ? Storage::url($category->front_image) : asset('images/static_image/placeholder.jpg') }}');">
                            <div class="category-overlay"></div>
                        </div>
                        <div class="category-content">
                            <h4 class="category-title">{{ $category->category_name }}</h4>
                            <p class="category-count">{{ $category->subcategories->count() ?? 0 }} items</p>
                            <span class="btn-shop-now">VIEW</span>
                        </div>
                    </a>
                @endforeach
            @else
                <div class="no-categories">
                    <p>No categories available at the moment.</p>
                </div>
            @endif
        </div>
    </section>
</div>

<style>
    /* Main Hero Section Container */
    .hero-section-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        min-height: 100vh;
        width: 100%;
        align-items: stretch;
        gap: 0 5px;
        padding-top: 10px;
    }

    /* Welcome Area (Left Side - Constant) */
    .welcome-area {
        position: relative;
        width: 100%;
        height: 100%;
        min-height: 100vh;
        background-color: #f5f0e8;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        padding: 60px 50px;
        box-sizing: border-box;
        overflow: hidden;
    }

    .welcome-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .welcome-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.5) 100%);
    }

    .welcome-text {
        position: relative;
        z-index: 2;
        max-width: 600px;
        color: #fff;
        text-align: left;
        background: linear-gradient(to right, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0) 100%);
        padding: 30px;
        border-radius: 0;
    }

    .welcome-text h2 {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        line-height: 1.1;
        margin-bottom: 20px;
        font-weight: 700;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .welcome-text p {
        font-size: 1.05rem;
        line-height: 1.6;
        margin-bottom: 30px;
        color: rgba(255,255,255,0.9);
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .btn-akame-btn {
        display: inline-block;
        border: 2px solid #fff;
        padding: 12px 36px;
        border-radius: 30px;
        text-transform: uppercase;
        font-size: 0.85rem;
        font-weight: 600;
        color: #fff;
        background: transparent;
        text-decoration: none;
        transition: all 0.3s ease;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .btn-akame-btn:hover {
        background: #fff;
        color: #000;
        text-shadow: none;
    }

    /* Categories Grid Section (Right Side) */
    .categories-section {
        width: 100%;
        height: 100%;
        min-height: 100vh;
        padding: 0;
        display: flex;
        align-items: stretch;
        justify-content: stretch;
        background-color: transparent;
        box-sizing: border-box;
    }

    .categories-grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        gap: 5px;
        width: 100%;
        height: 100%;
    }

    .category-card {
        position: relative;
        overflow: hidden;
        border-radius: 0;
        box-shadow: none;
        transition: transform 0.3s ease;
        min-height: 50vh;
    }

    /* Background Colors for Category Cards */
    .bg-mint-green {
        background-color: #a8e6cf;
    }

    .bg-lavender {
        background-color: #d4c5f9;
    }

    .bg-pink {
        background-color: #ffd3e1;
    }

    .bg-light-blue {
        background-color: #b3e5fc;
    }

    .category-card:hover {
        transform: scale(1.02);
    }

    .category-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .category-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, rgba(0,0,0,0) 0%, rgba(0,0,0,0.3) 50%, rgba(0,0,0,0.5) 100%);
    }

    .category-content {
        position: relative;
        z-index: 2;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 30px 25px;
        color: #fff;
        background: linear-gradient(to right, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0.2) 50%, rgba(0,0,0,0) 100%);
        border-radius: 0;
    }

    .category-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #fff;
        line-height: 1.2;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    }

    .category-count {
        font-size: 0.95rem;
        color: rgba(255,255,255,0.9);
        margin-bottom: 20px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    /* Shop Now Button for Grid Cards */
    .btn-shop-now {
        display: inline-block;
        padding: 0;
        background-color: transparent;
        border: none;
        color: #fff;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        width: fit-content;
        position: relative;
        padding-bottom: 5px;
        text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }

    .btn-shop-now::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background-color: var(--gold-color, #D4AF37);
        transform: scaleX(1);
        transition: transform 0.3s ease;
        box-shadow: 0 2px 4px rgba(212, 175, 55, 0.3);
    }

    .btn-shop-now:hover {
        color: var(--gold-color-dark, #A0821A);
    }

    .no-categories {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: #666;
        font-size: 1.1rem;
    }

    /* Responsive Design */
    @media (max-width: 1024px) {
        .hero-section-container {
            grid-template-columns: 1fr;
        }

        .welcome-area {
            min-height: 60vh;
            padding: 40px 30px;
        }

        .welcome-text h2 {
            font-size: 3rem;
        }

        .categories-section {
            min-height: auto;
        }

        .category-card {
            min-height: 40vh;
        }
    }

    @media (max-width: 768px) {
        .welcome-text h2 {
            font-size: 2.5rem;
        }

        .welcome-text p {
            font-size: 0.95rem;
        }

        .welcome-area {
            padding: 30px 25px;
        }

        .categories-grid-container {
            grid-template-columns: 1fr;
            grid-template-rows: repeat(4, 1fr);
        }

        .category-card {
            min-height: 35vh;
        }

        .category-title {
            font-size: 1.75rem;
        }

        .category-content {
            padding: 25px 20px;
        }
    }

    @media (max-width: 480px) {
        .welcome-text h2 {
            font-size: 2rem;
        }

        .welcome-text p {
            font-size: 0.9rem;
        }

        .welcome-area {
            padding: 25px 20px;
        }

        .category-content {
            padding: 20px 15px;
        }

        .category-title {
            font-size: 1.5rem;
        }
    }
</style>