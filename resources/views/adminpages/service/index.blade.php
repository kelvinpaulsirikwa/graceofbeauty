@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Services</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Service
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
                            <th>Order</th>
                            <th>Front Image</th>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($services as $service)
                            <tr>
                                <td>{{ $service->order }}</td>
                                <td>
                                    @if($service->front_image)
                                        <img src="{{ Storage::url($service->front_image) }}" alt="{{ $service->service_name }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ Str::limit($service->description ?? 'N/A', 50) }}</td>
                                <td>{{ $service->creator->name ?? 'N/A' }}</td>
                                <td>{{ $service->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>{{ $service->updated_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.services.show', $service->service_id) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('admin.services.edit', $service->service_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.destroy', $service->service_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
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
                                <td colspan="8" class="text-center">No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($services->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $services->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

