@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Service Details</h2>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Service ID:</dt>
                <dd class="col-sm-9">{{ $service->service_id }}</dd>

                <dt class="col-sm-3">Order:</dt>
                <dd class="col-sm-9">{{ $service->order }}</dd>

                <dt class="col-sm-3">Service Name:</dt>
                <dd class="col-sm-9">{{ $service->service_name }}</dd>

                <dt class="col-sm-3">Front Image:</dt>
                <dd class="col-sm-9">
                    @if($service->front_image)
                        <img src="{{ Storage::url($service->front_image) }}" alt="{{ $service->service_name }}" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #ddd;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Description:</dt>
                <dd class="col-sm-9">{!! $service->description ?? 'N/A' !!}</dd>

                <dt class="col-sm-3">Created By:</dt>
                <dd class="col-sm-9">{{ $service->creator->name ?? 'N/A' }} ({{ $service->creator->email ?? 'N/A' }})</dd>

                <dt class="col-sm-3">Created At:</dt>
                <dd class="col-sm-9">{{ $service->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At:</dt>
                <dd class="col-sm-9">{{ $service->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.services.edit', $service->service_id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Service
                </a>
                <form action="{{ route('admin.services.destroy', $service->service_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this service?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Service
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Service Images Section -->
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Service Images</h5>
            <a href="{{ route('admin.services.service_images.create', $service->service_id) }}" class="btn btn-sm btn-success">
                <i class="bx bx-plus"></i> Add New Image
            </a>
        </div>
        <div class="card-body">
            @if($service->serviceImages && $service->serviceImages->count() > 0)
                <div class="row">
                    @foreach($service->serviceImages as $image)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ Storage::url($image->image_path) }}" class="card-img-top" alt="Service Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <div class="card-text small">
                                        <strong>Description:</strong><br>
                                        {!! $image->description ?? 'No description' !!}
                                    </div>
                                    <p class="card-text small text-muted">
                                        <strong>Posted by:</strong> {{ $image->creator->name ?? 'N/A' }}<br>
                                        <strong>Created:</strong> {{ $image->created_at->format('Y-m-d H:i') }}
                                    </p>
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
                <p class="text-muted text-center">No additional images added yet. Click "Add New Image" to add images to this service.</p>
            @endif
        </div>
    </div>
</div>
@endsection

