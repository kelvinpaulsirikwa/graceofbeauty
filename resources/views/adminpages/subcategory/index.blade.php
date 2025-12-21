@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Subcategories</h2>
        <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Subcategory
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
                            <th>Category</th>
                            <th>Subcategory Name</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->subcategory_id }}</td>
                                <td>{{ $subcategory->category->category_name ?? 'N/A' }}</td>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>{{ $subcategory->creator->name ?? 'N/A' }}</td>
                                <td>{{ $subcategory->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $subcategory->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.subcategories.show', $subcategory->subcategory_id) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('admin.subcategories.edit', $subcategory->subcategory_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.subcategories.destroy', $subcategory->subcategory_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
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
                                <td colspan="7" class="text-center">No subcategories found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($subcategories->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $subcategories->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

