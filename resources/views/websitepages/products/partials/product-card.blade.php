@php
    use Illuminate\Support\Facades\Storage;
    
    // Get product image
    $productImage = $product->productImages->first() ?? null;
    $imageUrl = $productImage 
        ? Storage::url($productImage->image_path) 
        : ($product->front_image ? Storage::url($product->front_image) : asset('images/static_image/placeholder.jpg'));
    
    // Product URL
    $productUrl = route('product.show', $product->product_id);
    
    // Price format (default to TSH, can be overridden)
    $pricePrefix = $pricePrefix ?? 'TSH';
@endphp

<a href="{{ $productUrl }}" class="product-card group relative bg-white rounded-lg overflow-hidden transition-transform duration-300 hover:shadow-lg block">
    <!-- Product Image Container -->
    <div class="relative overflow-hidden bg-gray-200" style="padding-top: 100%;">
        <img src="{{ $imageUrl }}" 
             alt="{{ $product->name }}" 
             class="absolute top-0 left-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
        
        <!-- Badge Overlay -->
        <div class="absolute top-3 left-3 bg-green-500 text-white px-2 py-1 text-xs font-semibold rounded">
            NEW
        </div>
        @if(!$product->available)
            <div class="absolute top-3 right-3 bg-black text-white px-2 py-1 text-xs font-semibold rounded">
                OUT OF STOCK
            </div>
        @endif
    </div>
    
    <!-- Product Info -->
    <div class="p-4">
        <h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2 min-h-[3rem]">
            {{ $product->name }}
        </h3>
        
        <!-- Rating Stars -->
        <div class="flex items-center mb-2">
            @for($i = 0; $i < 5; $i++)
                <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                    <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                </svg>
            @endfor
        </div>
        
        <!-- Price -->
        <div class="flex items-center gap-2">
            @if($product->offer && $product->offer_price)
                <span class="text-xl font-bold text-red-600">
                    {{ $pricePrefix }} {{ number_format($product->offer_price, 0) }}
                </span>
                @if($product->price)
                    <span class="text-sm text-gray-500 line-through">
                        {{ $pricePrefix }} {{ number_format($product->price, $priceDecimals ?? 2) }}
                    </span>
                @endif
            @else
                <p class="text-xl font-bold text-gray-800">
                    {{ $pricePrefix }} {{ number_format($product->price ?? 0, $priceDecimals ?? 2) }}
                </p>
            @endif
        </div>
    </div>
</a>

