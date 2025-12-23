@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Create New User Feedback</h2>
        <a href="{{ route('admin.user_feedbacks.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.user_feedbacks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
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
                    <div class="form-text">Upload feedback image (Max: 2MB, Formats: JPEG, PNG, JPG, GIF, WEBP)</div>
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        id="description" 
                        name="description" 
                        rows="10"
                        placeholder="Enter feedback description..."
                    >{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Products Used</label>
                    <div class="border rounded p-3 @error('product_used') border-danger @enderror" style="max-height: 300px; overflow-y: auto;">
                        @forelse($products as $product)
                            <div class="form-check mb-2">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="product_used[]" 
                                    value="{{ $product->product_id }}" 
                                    id="product_{{ $product->product_id }}"
                                    {{ in_array($product->product_id, old('product_used', [])) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="product_{{ $product->product_id }}">
                                    {{ $product->name }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No products available</p>
                        @endforelse
                    </div>
                    @error('product_used')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Select the products used in this feedback.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Services Used</label>
                    <div class="border rounded p-3 @error('service_used') border-danger @enderror" style="max-height: 300px; overflow-y: auto;">
                        @forelse($services as $service)
                            <div class="form-check mb-2">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="service_used[]" 
                                    value="{{ $service->service_id }}" 
                                    id="service_{{ $service->service_id }}"
                                    {{ in_array($service->service_id, old('service_used', [])) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="service_{{ $service->service_id }}">
                                    {{ $service->service_name }}
                                </label>
                            </div>
                        @empty
                            <p class="text-muted mb-0">No services available</p>
                        @endforelse
                    </div>
                    @error('service_used')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Select the services used in this feedback.</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Create Feedback
                    </button>
                    <a href="{{ route('admin.user_feedbacks.index') }}" class="btn btn-secondary">Cancel</a>
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

            <!-- CKEditor -->
            <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
            <script>
                CKEDITOR.replace('description', {
                    height: 400
                });
            </script>
        </div>
    </div>
</div>
@endsection

