@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Brands</h2>
        <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Brand
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
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
                            <th>Image</th>
                            <th>Brand Name</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($brands as $brand)
                            <tr>
                                <td>{{ $brand->brand_id }}</td>
                                <td>
                                    @if($brand->image)
                                        <img src="{{ Storage::url($brand->image) }}" alt="{{ $brand->brand_name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $brand->brand_name }}</td>
                                <td>{{ $brand->creator->name ?? 'N/A' }}</td>
                                <td>{{ $brand->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $brand->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.brands.show', $brand->brand_id) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('admin.brands.edit', $brand->brand_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.brands.destroy', $brand->brand_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this brand?');">
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
                                <td colspan="7" class="text-center">No brands found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($brands->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $brands->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

