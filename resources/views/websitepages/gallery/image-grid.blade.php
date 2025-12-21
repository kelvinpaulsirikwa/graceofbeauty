@php
    use Illuminate\Support\Facades\Storage;
@endphp

@foreach($images as $image)
    @php
        $imageUrl = Storage::url($image->image_path);
    @endphp
    <a href="{{ route('product.show', $image->product->product_id) }}" class="gallery-item group block">
        <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 bg-white">
            <div class="relative w-full" style="padding-top: 100%;">
                <img 
                    src="{{ $imageUrl }}" 
                    alt="{{ $image->description ?? $image->product->name }}" 
                    class="absolute top-0 left-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                    loading="lazy"
                >
            </div>
            <!-- Overlay on hover -->
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition-all duration-300 flex items-center justify-center pointer-events-none">
                <div class="text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-center px-4 pointer-events-auto">
                    <p class="font-semibold text-lg mb-2">{{ $image->product->name ?? 'Product' }}</p>
                    @if($image->description)
                        <p class="text-sm">{{ Str::limit($image->description, 60) }}</p>
                    @endif
                    <p class="text-xs mt-2">Click to view product</p>
                </div>
            </div>
        </div>
    </a>
@endforeach

