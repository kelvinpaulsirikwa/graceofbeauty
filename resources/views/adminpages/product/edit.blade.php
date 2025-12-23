@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Product</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
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
            <form action="{{ route('admin.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        value="{{ old('name', $product->name) }}" 
                        placeholder="Enter product name"
                        maxlength="255"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Enter the product name (optional)</div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select class="form-select @error('brand_id') is-invalid @enderror" id="brand_id" name="brand_id">
                                <option value="">Select Brand (Optional)</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->brand_id }}" 
                                        {{ old('brand_id', $product->brand_id) == $brand->brand_id ? 'selected' : '' }}>
                                        {{ $brand->brand_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category_id }}" 
                                        {{ old('category_id', $product->category_id) == $category->category_id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="subcategory_id" class="form-label">Subcategory</label>
                            <select class="form-select @error('subcategory_id') is-invalid @enderror" id="subcategory_id" name="subcategory_id">
                                <option value="">Select Subcategory (Optional)</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->subcategory_id }}" 
                                        data-category-id="{{ $subcategory->category_id }}"
                                        {{ old('subcategory_id', $product->subcategory_id) == $subcategory->subcategory_id ? 'selected' : '' }}>
                                        {{ $subcategory->subcategory_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subcategory_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Subcategories will be filtered based on selected category.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="front_image" class="form-label">Front Image</label>
                            @if($product->front_image)
                                <div class="mb-2">
                                    <p class="text-muted small">Current Image:</p>
                                    <img src="{{ Storage::url($product->front_image) }}" alt="Product Image" style="max-width: 200px; max-height: 200px; border-radius: 8px; border: 1px solid #ddd;">
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input 
                                type="number" 
                                step="0.01" 
                                min="0" 
                                max="99999999.99"
                                class="form-control @error('price') is-invalid @enderror" 
                                id="price" 
                                name="price" 
                                value="{{ old('price', $product->price) }}" 
                                placeholder="0.00"
                            >
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Enter product price (optional)</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check mt-4">
                                <input 
                                    class="form-check-input @error('available') is-invalid @enderror" 
                                    type="checkbox" 
                                    id="available" 
                                    name="available" 
                                    value="1"
                                    {{ old('available', $product->available) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="available">
                                    Available
                                </label>
                                @error('available')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">Check if the product is available for sale</div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <div class="form-check">
                                <input 
                                    class="form-check-input @error('offer') is-invalid @enderror" 
                                    type="checkbox" 
                                    id="offer" 
                                    name="offer" 
                                    value="1"
                                    {{ old('offer', $product->offer) ? 'checked' : '' }}
                                    onchange="toggleOfferPrice()"
                                >
                                <label class="form-check-label" for="offer">
                                    Offer
                                </label>
                                @error('offer')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-text">Check if this product has an offer</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="offer_price" class="form-label">Offer Price</label>
                            <input 
                                type="number" 
                                min="0" 
                                class="form-control @error('offer_price') is-invalid @enderror" 
                                id="offer_price" 
                                name="offer_price" 
                                value="{{ old('offer_price', $product->offer_price) }}" 
                                placeholder="0"
                                {{ old('offer', $product->offer) ? '' : 'disabled' }}
                            >
                            @error('offer_price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Enter offer price (integer only)</div>
                        </div>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <label class="form-label mb-0">Product Attributes</label>
                        <button type="button" class="btn btn-sm btn-success" id="addAttributeBtn">
                            <i class="bx bx-plus"></i> Add Attribute
                        </button>
                    </div>
                    <div id="attributesContainer">
                        <!-- Dynamic attributes will be added here -->
                    </div>
                    <div class="form-text">Add product attributes with their values (e.g., Color: Red, Size: Large)</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Update Product
                    </button>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Product Images Management Section -->
    <div class="card mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Product Images</h5>
            <a href="{{ route('admin.product_images.create', $product->product_id) }}" class="btn btn-sm btn-success">
                <i class="bx bx-plus"></i> Add New Image
            </a>
        </div>
        <div class="card-body">
            @if($product->productImages->count() > 0)
                <div class="row">
                    @foreach($product->productImages as $image)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ Storage::url($image->image_path) }}" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <p class="card-text small">
                                        <strong>Description:</strong><br>
                                        {{ $image->description ?? 'No description' }}
                                    </p>
                                    <div class="btn-group w-100" role="group">
                                        <a href="{{ route('admin.product_images.edit', [$product->product_id, $image->id]) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.product_images.destroy', [$product->product_id, $image->id]) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this image?');">
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
                <p class="text-muted text-center">No additional images added yet. Click "Add New Image" to add images to this product.</p>
            @endif
        </div>
    </div>
</div>

<script>
    let attributeIndex = 0;
    const productAttributes = @json($productAttributes);
    const existingAttributes = @json($product->productAttributeValues);

    // Image preview
    document.getElementById('front_image').addEventListener('change', function(e) {
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

    // Filter subcategories based on selected category
    function filterSubcategories() {
        const categoryId = document.getElementById('category_id').value;
        const subcategorySelect = document.getElementById('subcategory_id');
        const options = subcategorySelect.querySelectorAll('option[data-category-id]');
        
        options.forEach(option => {
            if (categoryId && option.getAttribute('data-category-id') === categoryId) {
                option.style.display = '';
            } else {
                option.style.display = 'none';
            }
        });
    }

    document.getElementById('category_id').addEventListener('change', filterSubcategories);
    
    // Initialize subcategory filter on page load
    filterSubcategories();

    // Add attribute row
    document.getElementById('addAttributeBtn').addEventListener('click', function() {
        addAttributeRow();
    });

    function addAttributeRow(attributeId = '', value = '') {
        const container = document.getElementById('attributesContainer');
        const row = document.createElement('div');
        row.className = 'row mb-2 attribute-row';
        row.innerHTML = `
            <div class="col-md-5">
                <select class="form-select attribute-select" name="product_attributes[${attributeIndex}][attribute_id]" required>
                    <option value="">Select Attribute</option>
                    ${productAttributes.map(attr => 
                        `<option value="${attr.id}" ${attributeId == attr.id ? 'selected' : ''}>${attr.name}</option>`
                    ).join('')}
                </select>
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="product_attributes[${attributeIndex}][value]" 
                    placeholder="Enter value" value="${value}" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-sm btn-danger remove-attribute" title="Remove">
                    <i class="bx bx-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
        
        // Add remove functionality
        row.querySelector('.remove-attribute').addEventListener('click', function() {
            row.remove();
        });
        
        attributeIndex++;
    }

    // Remove attribute row
    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-attribute')) {
            e.target.closest('.attribute-row').remove();
        }
    });

    // Initialize with existing attributes or old input
    @if(old('product_attributes'))
        @foreach(old('product_attributes') as $index => $attr)
            addAttributeRow('{{ $attr['attribute_id'] ?? '' }}', '{{ $attr['value'] ?? '' }}');
        @endforeach
    @elseif($product->productAttributeValues->count() > 0)
        @foreach($product->productAttributeValues as $attrValue)
            addAttributeRow('{{ $attrValue->product_attribute_id }}', '{{ $attrValue->value }}');
        @endforeach
    @else
        addAttributeRow();
    @endif

    function toggleOfferPrice() {
        const offerCheckbox = document.getElementById('offer');
        const offerPriceInput = document.getElementById('offer_price');
        offerPriceInput.disabled = !offerCheckbox.checked;
        if (!offerCheckbox.checked) {
            offerPriceInput.value = '';
        }
    }
</script>
@endsection

