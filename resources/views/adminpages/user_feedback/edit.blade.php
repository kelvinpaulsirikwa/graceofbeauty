@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit User Feedback</h2>
        <a href="{{ route('admin.user_feedbacks.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.user_feedbacks.update', $feedback->feedback_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    @if($feedback->image)
                        <div class="mb-2">
                            <p class="text-muted small">Current Image:</p>
                            <img src="{{ Storage::url($feedback->image) }}" alt="Feedback" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 1px solid #ddd;">
                        </div>
                    @endif
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
                    <div class="form-text">Upload new image to replace current one (Max: 2MB, Formats: JPEG, PNG, JPG, GIF, WEBP)</div>
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
                        rows="5"
                        placeholder="Enter feedback description..."
                    >{{ old('description', $feedback->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Products Used</label>
                    @php
                        $selectedProducts = is_array($feedback->product_used) ? $feedback->product_used : [];
                        if (!is_array($selectedProducts)) {
                            $selectedProducts = json_decode($selectedProducts, true) ?? [];
                        }
                    @endphp
                    <div class="border rounded p-3 @error('product_used') border-danger @enderror" style="max-height: 300px; overflow-y: auto;">
                        @forelse($products as $product)
                            <div class="form-check mb-2">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="product_used[]" 
                                    value="{{ $product->product_id }}" 
                                    id="product_{{ $product->product_id }}"
                                    {{ in_array($product->product_id, old('product_used', $selectedProducts)) ? 'checked' : '' }}
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
                    @php
                        $selectedServices = is_array($feedback->service_used) ? $feedback->service_used : [];
                        if (!is_array($selectedServices)) {
                            $selectedServices = json_decode($selectedServices, true) ?? [];
                        }
                    @endphp
                    <div class="border rounded p-3 @error('service_used') border-danger @enderror" style="max-height: 300px; overflow-y: auto;">
                        @forelse($services as $service)
                            <div class="form-check mb-2">
                                <input 
                                    class="form-check-input" 
                                    type="checkbox" 
                                    name="service_used[]" 
                                    value="{{ $service->service_id }}" 
                                    id="service_{{ $service->service_id }}"
                                    {{ in_array($service->service_id, old('service_used', $selectedServices)) ? 'checked' : '' }}
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
                        <i class="bx bx-save"></i> Update Feedback
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
        </div>
    </div>
</div>
@endsection

