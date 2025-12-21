@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Product Attributes</h2>
        <a href="{{ route('admin.product_attributes.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Product Attribute
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
                            <th>Attribute Name</th>
                            <th>Posted By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productAttributes as $productAttribute)
                            <tr>
                                <td>{{ $productAttribute->id }}</td>
                                <td>{{ $productAttribute->name }}</td>
                                <td>{{ $productAttribute->poster->name ?? 'N/A' }}</td>
                                <td>{{ $productAttribute->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $productAttribute->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.product_attributes.show', $productAttribute->id) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('admin.product_attributes.edit', $productAttribute->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.product_attributes.destroy', $productAttribute->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product attribute?');">
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
                                <td colspan="6" class="text-center">No product attributes found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($productAttributes->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $productAttributes->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

