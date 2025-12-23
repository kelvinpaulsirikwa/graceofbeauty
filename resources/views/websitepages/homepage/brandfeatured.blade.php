@php
    use Illuminate\Support\Facades\Storage;
@endphp

<!-- Brand Featured Section -->
<section class="brand-featured-section py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- HOT TREND - Brands -->
            <div class="featured-column">
                <h2 class="section-heading">
                    <span class="heading-text">BRANDS AVAILABLE</span>
                    <span class="heading-underline"></span>
                </h2>
                <div class="featured-items">
                    @forelse($hotTrendBrands ?? [] as $brand)
                        <a href="{{ route('brand.products', $brand->brand_id) }}" class="featured-item group">
                            <div class="item-image-container">
                                @if($brand->image)
                                    <img src="{{ Storage::url($brand->image) }}" 
                                         alt="{{ $brand->brand_name }}" 
                                         class="item-image">
                                @else
                                    <div class="item-image bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                        <span class="text-gray-500 text-lg font-bold">{{ strtoupper(substr($brand->brand_name, 0, 1)) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="item-content">
                                <h3 class="item-name">{{ $brand->brand_name }}</h3>
                                <div class="item-rating">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="star-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <p class="item-price">View Products</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500 text-sm">No brands available</p>
                    @endforelse
                </div>
            </div>

            <!-- BEST SELLER - Products with many subcategories -->
            <div class="featured-column">
                <h2 class="section-heading">
                    <span class="heading-text">BEST SELLER</span>
                    <span class="heading-underline"></span>
                </h2>
                <div class="featured-items">
                    @forelse($bestSellerProducts ?? [] as $product)
                        <a href="{{ route('product.show', $product->product_id) }}" class="featured-item group">
                            <div class="item-image-container">
                                @php
                                    $productImage = $product->productImages->first() ?? null;
                                    $imageUrl = $productImage 
                                        ? Storage::url($productImage->image_path) 
                                        : ($product->front_image ? Storage::url($product->front_image) : asset('images/static_image/frontimage.jpg'));
                                @endphp
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $product->name }}" 
                                     class="item-image">
                            </div>
                            <div class="item-content">
                                <h3 class="item-name">{{ $product->name }}</h3>
                                <div class="item-rating">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="star-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <p class="item-price">TSH {{ number_format($product->price ?? 0, 1) }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500 text-sm">No products available</p>
                    @endforelse
                </div>
            </div>

            <!-- FEATURE - Random Products -->
            <div class="featured-column">
                <h2 class="section-heading">
                    <span class="heading-text">FEATURE</span>
                    <span class="heading-underline"></span>
                </h2>
                <div class="featured-items">
                    @forelse($featuredProducts ?? [] as $product)
                        <a href="{{ route('product.show', $product->product_id) }}" class="featured-item group">
                            <div class="item-image-container">
                                @php
                                    $productImage = $product->productImages->first() ?? null;
                                    $imageUrl = $productImage 
                                        ? Storage::url($productImage->image_path) 
                                        : ($product->front_image ? Storage::url($product->front_image) : asset('images/static_image/frontimage.jpg'));
                                @endphp
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $product->name }}" 
                                     class="item-image">
                            </div>
                            <div class="item-content">
                                <h3 class="item-name">{{ $product->name }}</h3>
                                <div class="item-rating">
                                    @for($i = 0; $i < 5; $i++)
                                        <svg class="star-icon" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                        </svg>
                                    @endfor
                                </div>
                                <p class="item-price">TSH {{ number_format($product->price ?? 0, 1) }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-gray-500 text-sm">No products available</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .brand-featured-section {
        font-family: 'Arial', sans-serif;
    }

    .featured-column {
        display: flex;
        flex-direction: column;
    }

    .section-heading {
        position: relative;
        margin-bottom: 1.25rem;
    }

    .heading-text {
        font-size: 1.125rem;
        font-weight: 700;
        color: #000;
        display: block;
        margin-bottom: 0.375rem;
    }

    .heading-underline {
        display: block;
        width: 50px;
        height: 2px;
        background-color: var(--gold-color, #D4AF37);
        margin-top: 0.25rem;
    }

    .featured-items {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .featured-item {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        color: inherit;
        transition: transform 0.2s ease;
        padding: 0.5rem;
        border-radius: 4px;
    }

    .featured-item:hover {
        transform: translateY(-2px);
        background-color: #f9fafb;
    }

    .item-image-container {
        width: 80px;
        height: 80px;
        min-width: 80px;
        flex-shrink: 0;
        overflow: hidden;
        background-color: #ffffff;
        border-radius: 4px;
        border: 1px solid #e5e7eb;
    }

    .item-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .featured-item:hover .item-image {
        transform: scale(1.03);
    }

    .item-content {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-width: 0;
    }

    .item-name {
        font-size: 0.875rem;
        font-weight: 500;
        color: #000;
        margin-bottom: 0.25rem;
        line-height: 1.3;
    }

    .item-rating {
        display: flex;
        gap: 1px;
        margin-bottom: 0.25rem;
    }

    .star-icon {
        width: 12px;
        height: 12px;
        color: #fbbf24;
        fill: currentColor;
    }

    .item-price {
        font-size: 0.875rem;
        font-weight: 600;
        color: #000;
    }

    @media (max-width: 768px) {
        .brand-featured-section .grid {
            grid-template-columns: 1fr;
        }

        .section-heading {
            margin-bottom: 1.5rem;
        }

        .featured-items {
            gap: 1rem;
        }
    }
</style>

