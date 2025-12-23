@extends('websitepages.layouts.app')

@section('title', 'User Story')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@section('content')
<div class="container mx-auto px-4 py-12">
    <!-- Breadcrumb -->
    <nav class="mb-6">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li><a href="{{ route('home') }}" class="hover:text-blue-600">Home</a></li>
            <li><span class="mx-2">/</span></li>
            <li><a href="{{ route('services') }}" class="hover:text-blue-600">Services</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-800 font-medium">User Story</li>
        </ol>
    </nav>

    @if($feedback)
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Left Column: Avatar and Products/Services -->
                <div class="lg:col-span-1">
                    <!-- Large Circular Avatar -->
                    <div class="mb-8 flex justify-center lg:justify-start">
                        @if($feedback->image)
                            <img src="{{ Storage::url($feedback->image) }}" 
                                 alt="User Feedback" 
                                 class="w-[480px] h-[480px] rounded-full object-cover shadow-xl border-4 border-gray-200">
                        @else
                            <div class="w-[480px] h-[480px] rounded-full bg-gray-200 shadow-xl border-4 border-gray-200 flex items-center justify-center">
                                <span class="text-gray-400 text-6xl">👤</span>
                            </div>
                        @endif
                    </div>

                    <!-- Products Used -->
                    @if($products && $products->count() > 0)
                        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold-color, #D4AF37);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                                Products Used
                            </h3>
                            <div class="space-y-3">
                                @foreach($products as $product)
                                    <a href="{{ route('product.show', $product->product_id) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:shadow-md transition" onmouseover="this.style.borderColor='var(--gold-color, #D4AF37)'" onmouseout="this.style.borderColor='#e5e7eb'">
                                        @php
                                            $productImage = $product->productImages->first();
                                            $imageUrl = $productImage 
                                                ? Storage::url($productImage->image_path) 
                                                : ($product->front_image ? Storage::url($product->front_image) : asset('images/static_image/frontimage.jpg'));
                                        @endphp
                                        <img src="{{ $imageUrl }}" 
                                             alt="{{ $product->name }}" 
                                             class="w-14 h-14 object-cover rounded mr-3">
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $product->name }}</h4>
                                            <div class="text-xs">
                                                @if($product->offer && $product->offer_price)
                                                    <span class="text-red-600 font-bold">TSH {{ number_format($product->offer_price, 0) }}</span>
                                                    @if($product->price)
                                                        <span class="text-gray-500 line-through ml-1">TSH {{ number_format($product->price, 2) }}</span>
                                                    @endif
                                                @else
                                                    <span class="text-gray-600">TSH {{ number_format($product->price ?? 0, 2) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Services Used -->
                    @if($services && $services->count() > 0)
                        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: var(--gold-color, #D4AF37);">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Services Used
                            </h3>
                            <div class="space-y-3">
                                @foreach($services as $service)
                                    <a href="{{ route('services.show', $service->service_id) }}" class="flex items-center p-3 border border-gray-200 rounded-lg hover:shadow-md transition" onmouseover="this.style.borderColor='var(--gold-color, #D4AF37)'" onmouseout="this.style.borderColor='#e5e7eb'">
                                        @if($service->front_image)
                                            <img src="{{ Storage::url($service->front_image) }}" 
                                                 alt="{{ $service->service_name }}" 
                                                 class="w-14 h-14 object-cover rounded mr-3">
                                        @elseif($service->serviceImages && $service->serviceImages->count() > 0)
                                            <img src="{{ Storage::url($service->serviceImages->first()->image_path) }}" 
                                                 alt="{{ $service->service_name }}" 
                                                 class="w-14 h-14 object-cover rounded mr-3">
                                        @else
                                            <div class="w-14 h-14 bg-gray-200 rounded mr-3 flex items-center justify-center flex-shrink-0">
                                                <span class="text-gray-400 text-xs">{{ strtoupper(substr($service->service_name, 0, 2)) }}</span>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-gray-800 text-sm truncate">{{ $service->service_name }}</h4>
                                            @if($service->description)
                                                <div class="text-xs text-gray-600 line-clamp-2">{!! Str::limit($service->description, 50) !!}</div>
                                            @endif
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Right Column: Story -->
                <div class="lg:col-span-2">
                    @if($feedback->description)
                        <div class="bg-white rounded-lg shadow-md p-8">
                            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">The Story</h2>
                            <div class="prose max-w-none">
                                <div class="text-gray-700 text-lg leading-relaxed">
                                    {!! $feedback->description !!}
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Back Button -->
                    <div class="mt-8">
                        <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 rounded-lg transition" style="background-color: #000; color: var(--gold-color, #D4AF37);" onmouseover="this.style.backgroundColor='#1a1a1a'" onmouseout="this.style.backgroundColor='#000'">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Services
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-20">
            <p class="text-gray-600 text-lg mb-4">Feedback not found.</p>
            <a href="{{ route('services') }}" class="text-blue-600 hover:underline">Back to Services</a>
        </div>
    @endif
</div>
@endsection

