@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Image for Service: {{ $service->service_name }}</h2>
        <a href="{{ route('admin.services.show', $service->service_id) }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to Service
        </a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.services.service_images.update', [$service->service_id, $image->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="image_path" class="form-label">Image</label>
                    @if($image->image_path)
                        <div class="mb-2">
                            <p class="text-muted small">Current Image:</p>
                            <img src="{{ Storage::url($image->image_path) }}" alt="Current Image" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #ddd;">
                        </div>
                    @endif
                    <input 
                        type="file" 
                        class="form-control @error('image_path') is-invalid @enderror" 
                        id="image_path" 
                        name="image_path" 
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                    >
                    @error('image_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Upload new image to replace current one (Max: 2MB, Formats: JPEG, PNG, JPG, GIF, WEBP). Leave empty to keep current image.</div>
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <p class="text-muted small">New Image Preview:</p>
                        <img id="previewImg" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #ddd;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        id="description" 
                        name="description" 
                        rows="10"
                        placeholder="Enter image description (optional)"
                    >{{ old('description', $image->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Add a description for this image</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Update Image
                    </button>
                    <a href="{{ route('admin.services.show', $service->service_id) }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('image_path').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
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
@endsection

