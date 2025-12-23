@php
    use Illuminate\Support\Facades\Storage;
@endphp

@foreach($products as $product)
    <div class="product-item">
        <a href="{{ route('product.show', $product->product_id) }}" class="block relative overflow-hidden bg-gray-200 rounded-lg group" style="padding-top: 100%;">
            @php
                $productImage = $product->productImages->first();
                $imageUrl = $productImage 
                    ? Storage::url($productImage->image_path) 
                    : ($product->front_image ? Storage::url($product->front_image) : asset('images/static_image/frontimage.jpg'));
            @endphp
            <img src="{{ $imageUrl }}" 
                 alt="{{ $product->name }}" 
                 class="absolute top-0 left-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
        </a>
        <div class="mt-3">
            <h3 class="text-lg font-semibold text-gray-800 mb-1 line-clamp-2">
                {{ $product->name }}
            </h3>
            <div class="flex items-center mb-1">
                @for($i = 0; $i < 5; $i++)
                    <svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20">
                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                    </svg>
                @endfor
            </div>
            <p class="text-xl font-bold text-gray-800">$ {{ number_format($product->price ?? 0, 1) }}</p>
        </div>
    </div>
@endforeach

