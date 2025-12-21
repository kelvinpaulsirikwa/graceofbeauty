@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit Subcategory</h2>
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.subcategories.update', $subcategory->subcategory_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    <select 
                        class="form-select @error('category_id') is-invalid @enderror" 
                        id="category_id" 
                        name="category_id" 
                        required
                    >
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" 
                                {{ (old('category_id', $subcategory->category_id) == $category->category_id) ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="subcategory_name" class="form-label">Subcategory Name <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        class="form-control @error('subcategory_name') is-invalid @enderror" 
                        id="subcategory_name" 
                        name="subcategory_name" 
                        value="{{ old('subcategory_name', $subcategory->subcategory_name) }}" 
                        placeholder="Enter subcategory name"
                        required
                    >
                    @error('subcategory_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Enter a unique subcategory name for the selected category.</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Update Subcategory
                    </button>
                    <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

