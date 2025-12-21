@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Service Images: {{ $service->service_name }}</h2>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.services.service_images.create', $service->service_id) }}" class="btn btn-success">
                <i class="bx bx-plus"></i> Add New Image
            </a>
            <a href="{{ route('admin.services.show', $service->service_id) }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back to Service
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($images->count() > 0)
                <div class="row g-3">
                    @foreach($images as $image)
                        <div class="col-md-4 col-lg-3">
                            <div class="card h-100">
                                <img src="{{ Storage::url($image->image_path) }}" class="card-img-top" alt="Service Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    @if($image->description)
                                        <p class="card-text text-muted small mb-2">{{ Str::limit($image->description, 50) }}</p>
                                    @else
                                        <p class="card-text text-muted small mb-2">No description</p>
                                    @endif
                                    <p class="card-text text-muted small mb-1">
                                        <strong>Posted by:</strong> {{ $image->creator->name ?? 'N/A' }}
                                    </p>
                                    <p class="card-text text-muted small mb-0">
                                        <strong>Created:</strong> {{ $image->created_at->format('Y-m-d H:i') }}
                                    </p>
                                </div>
                                <div class="card-footer bg-white">
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('admin.services.service_images.edit', [$service->service_id, $image->id]) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.services.service_images.destroy', [$service->service_id, $image->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this image?');">
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
                <div class="text-center py-5">
                    <p class="text-muted">No images found for this service.</p>
                    <a href="{{ route('admin.services.service_images.create', $service->service_id) }}" class="btn btn-primary">
                        <i class="bx bx-plus"></i> Add First Image
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

