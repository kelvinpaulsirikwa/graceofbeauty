@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Create New Category</h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="category_name" class="form-label">Category Name <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        class="form-control @error('category_name') is-invalid @enderror" 
                        id="category_name" 
                        name="category_name" 
                        value="{{ old('category_name') }}" 
                        placeholder="e.g. Human Hair, Oil, Bracelet, Spectacles"
                        required
                    >
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Enter a unique category name.</div>
                </div>

                <div class="mb-3">
                    <label for="front_image" class="form-label">Front Image</label>
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
                    <div class="form-text">Upload front image (Max: 2MB, Formats: JPEG, PNG, JPG, GIF, WEBP)</div>
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Create Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
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
        </div>
    </div>
</div>
@endsection

