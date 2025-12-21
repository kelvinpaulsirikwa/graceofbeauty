@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Product Details</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <dl class="row">
                        <dt class="col-sm-4">Product ID:</dt>
                        <dd class="col-sm-8">{{ $product->product_id }}</dd>

                        <dt class="col-sm-4">Product Name:</dt>
                        <dd class="col-sm-8">{{ $product->name ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Brand:</dt>
                        <dd class="col-sm-8">{{ $product->brand->brand_name ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Category:</dt>
                        <dd class="col-sm-8">{{ $product->category->category_name ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Subcategory:</dt>
                        <dd class="col-sm-8">{{ $product->subcategory->subcategory_name ?? 'N/A' }}</dd>

                        <dt class="col-sm-4">Price:</dt>
                        <dd class="col-sm-8">
                            @if($product->price)
                                TSH {{ number_format($product->price, 2) }}
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Available:</dt>
                        <dd class="col-sm-8">
                            @if($product->available)
                                <span class="badge bg-success">Yes</span>
                            @else
                                <span class="badge bg-danger">No</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Created By:</dt>
                        <dd class="col-sm-8">{{ $product->creator->name ?? 'N/A' }} ({{ $product->creator->email ?? 'N/A' }})</dd>

                        <dt class="col-sm-4">Created At:</dt>
                        <dd class="col-sm-8">{{ $product->created_at->format('Y-m-d H:i:s') }}</dd>

                        <dt class="col-sm-4">Updated At:</dt>
                        <dd class="col-sm-8">{{ $product->updated_at->format('Y-m-d H:i:s') }}</dd>
                    </dl>
                </div>

                <div class="col-md-6">
                    <dt class="mb-2">Front Image:</dt>
                    <dd>
                        @if($product->front_image)
                            <img src="{{ Storage::url($product->front_image) }}" alt="Product Image" style="max-width: 100%; max-height: 400px; border-radius: 8px; border: 1px solid #ddd;">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </dd>
                </div>
            </div>

            <hr class="my-4">

            <div class="mb-3">
                <dt class="mb-2">Product Attributes:</dt>
                @if($product->productAttributeValues->count() > 0)
                    <div class="d-flex flex-wrap gap-2">
                        @foreach($product->productAttributeValues as $attrValue)
                            <div class="card" style="min-width: 200px;">
                                <div class="card-body p-3">
                                    <h6 class="card-title mb-1 text-primary">{{ $attrValue->productAttribute->name }}</h6>
                                    <p class="card-text mb-0">{{ $attrValue->value }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No attributes assigned to this product.</p>
                @endif
            </div>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Product
                </a>
                <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Product Images Section -->
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Product Images</h5>
            <a href="{{ route('admin.product_images.create', $product->product_id) }}" class="btn btn-sm btn-success">
                <i class="bx bx-plus"></i> Add New Image
            </a>
        </div>
        <div class="card-body">
            @if($product->productImages->count() > 0)
                <div class="row">
                    @foreach($product->productImages as $image)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ Storage::url($image->image_path) }}" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text small">
                                        <strong>Description:</strong><br>
                                        {{ $image->description ?? 'No description' }}
                                    </p>
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('admin.product_images.edit', [$product->product_id, $image->id]) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.product_images.destroy', [$product->product_id, $image->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-muted text-center">No additional images added yet. Click "Add New Image" to add images to this product.</p>
            @endif
        </div>
    </div>
</div>
@endsection

