@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Service Image Details</h2>
        <a href="{{ route('admin.services.service_images.index', $service->service_id) }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to Images
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Image ID:</dt>
                <dd class="col-sm-9">{{ $image->id }}</dd>

                <dt class="col-sm-3">Service:</dt>
                <dd class="col-sm-9">{{ $service->service_name }} (ID: {{ $service->service_id }})</dd>

                <dt class="col-sm-3">Image:</dt>
                <dd class="col-sm-9">
                    @if($image->image_path)
                        <img src="{{ Storage::url($image->image_path) }}" alt="Service Image" style="max-width: 500px; max-height: 500px; border-radius: 8px; border: 1px solid #ddd;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Description:</dt>
                <dd class="col-sm-9">{{ $image->description ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Posted By:</dt>
                <dd class="col-sm-9">{{ $image->creator->name ?? 'N/A' }} ({{ $image->creator->email ?? 'N/A' }})</dd>

                <dt class="col-sm-3">Created At:</dt>
                <dd class="col-sm-9">{{ $image->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At:</dt>
                <dd class="col-sm-9">{{ $image->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.services.service_images.edit', [$service->service_id, $image->id]) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Image
                </a>
                <form action="{{ route('admin.services.service_images.destroy', [$service->service_id, $image->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this image?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Image
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

