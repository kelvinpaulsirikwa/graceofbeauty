@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Create New Brand</h2>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.brands.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="brand_name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        class="form-control @error('brand_name') is-invalid @enderror" 
                        id="brand_name" 
                        name="brand_name" 
                        value="{{ old('brand_name') }}" 
                        placeholder="e.g. Oil Brand, Spectacles Brand, Hair Brand"
                        required
                    >
                    @error('brand_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Enter a unique brand name.</div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Brand Image</label>
                    <input 
                        type="file" 
                        class="form-control @error('image') is-invalid @enderror" 
                        id="image" 
                        name="image" 
                        accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                    >
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Upload brand image (Max: 2MB, Formats: JPEG, PNG, JPG, GIF, WEBP)</div>
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Create Brand
                    </button>
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            <script>
                document.getElementById('image').addEventListener('change', function(e) {
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

