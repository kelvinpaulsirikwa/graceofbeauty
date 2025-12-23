@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Service</h2>
        <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.services.update', $service->service_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="order" class="form-label">Order</label>
                    <input 
                        type="number" 
                        class="form-control @error('order') is-invalid @enderror" 
                        id="order" 
                        name="order" 
                        value="{{ old('order', $service->order) }}" 
                        min="0"
                        placeholder="0"
                    >
                    @error('order')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Order for displaying services (lower numbers appear first).</div>
                </div>

                <div class="mb-3">
                    <label for="service_name" class="form-label">Service Name <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        class="form-control @error('service_name') is-invalid @enderror" 
                        id="service_name" 
                        name="service_name" 
                        value="{{ old('service_name', $service->service_name) }}" 
                        placeholder="e.g. Hair Styling, Makeup, Consultation"
                        required
                    >
                    @error('service_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="front_image" class="form-label">Front Image</label>
                    @if($service->front_image)
                        <div class="mb-2">
                            <p class="text-muted small">Current Image:</p>
                            <img src="{{ Storage::url($service->front_image) }}" alt="{{ $service->service_name }}" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 1px solid #ddd;">
                        </div>
                    @endif
                    <input 
                        type="file" 
                        class="form-control @error('front_image') is-invalid @enderror" 
                        id="front_image" 
                        name="front_image" 
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                    >
                    @error('front_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Upload new front image to replace current one (Max: 2MB, Formats: JPEG, PNG, JPG, GIF, WEBP)</div>
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <p class="text-muted small">New Image Preview:</p>
                        <img id="previewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 1px solid #ddd;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        id="description" 
                        name="description" 
                        rows="10"
                        placeholder="Enter service description..."
                    >{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Update Service
                    </button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            <script>
                document.getElementById('front_image').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('previewImg').src = e.target.result;
                            document.getElementById('imagePreview').style.display = 'block';
                        }
                        reader.readAsDataURL(file);
                    } else {
                        document.getElementById('imagePreview').style.display = 'none';
                    }
                });
            </script>

            <!-- CKEditor -->
            <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
            <script>
                CKEDITOR.replace('description', {
                    height: 400
                });
            </script>
        </div>
    </div>

    <!-- Service Images Management Section -->
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
                                    <p class="card-text small">
                                        <strong>Description:</strong><br>
                                        {{ $image->description ?? 'No description' }}
                                    </p>
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

