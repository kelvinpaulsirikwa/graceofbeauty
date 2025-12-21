@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Create New Product Attribute</h2>
        <a href="{{ route('admin.product_attributes.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.product_attributes.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Attribute Name <span class="text-danger">*</span></label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="Enter attribute name"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Enter a unique attribute name (e.g., Color, Size, Material).</div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Create Product Attribute
                    </button>
                    <a href="{{ route('admin.product_attributes.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

