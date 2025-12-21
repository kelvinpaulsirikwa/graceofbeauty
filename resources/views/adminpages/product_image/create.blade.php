@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Add New Image to Product #{{ $product->product_id }}</h2>
        <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to Product
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
            <form action="{{ route('admin.product_images.store', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="image_path" class="form-label">Image <span class="text-danger">*</span></label>
                    <input 
                        type="file" 
                        class="form-control @error('image_path') is-invalid @enderror" 
                        id="image_path" 
                        name="image_path" 
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                        required
                    >
                    @error('image_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Upload image (Max: 2MB, Formats: JPEG, PNG, JPG, GIF, WEBP)</div>
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="" alt="Preview" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #ddd;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        id="description" 
                        name="description" 
                        rows="4"
                        placeholder="Enter image description (optional)"
                        maxlength="1000"
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Add a description for this image (Max: 1000 characters)</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Add Image
                    </button>
                    <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn btn-secondary">Cancel</a>
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
@endsection

