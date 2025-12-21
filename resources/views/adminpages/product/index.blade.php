@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Products</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Product
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Front Image</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Price</th>
                            <th>Available</th>
                            <th>Attributes</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->product_id }}</td>
                                <td>{{ $product->name ?? 'N/A' }}</td>
                                <td>
                                    @if($product->front_image)
                                        <img src="{{ Storage::url($product->front_image) }}" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $product->brand->brand_name ?? 'N/A' }}</td>
                                <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                                <td>{{ $product->subcategory->subcategory_name ?? 'N/A' }}</td>
                                <td>
                                    @if($product->price)
                                        TSH {{ number_format($product->price, 2) }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->available)
                                        <span class="badge bg-success">Yes</span>
                                    @else
                                        <span class="badge bg-danger">No</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->productAttributeValues->count() > 0)
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($product->productAttributeValues->take(2) as $attrValue)
                                                <span class="badge bg-secondary">
                                                    {{ $attrValue->productAttribute->name }}: {{ $attrValue->value }}
                                                </span>
                                            @endforeach
                                            @if($product->productAttributeValues->count() > 2)
                                                <span class="badge bg-info">+{{ $product->productAttributeValues->count() - 2 }} more</span>
                                            @endif
                                        </div>
                                    @else
                                        <span class="text-muted">No Attributes</span>
                                    @endif
                                </td>
                                <td>{{ $product->creator->name ?? 'N/A' }}</td>
                                <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.products.show', $product->product_id) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="12" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

