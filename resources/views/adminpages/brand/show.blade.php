@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Brand Details</h2>
        <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Brand ID:</dt>
                <dd class="col-sm-9">{{ $brand->brand_id }}</dd>

                <dt class="col-sm-3">Brand Name:</dt>
                <dd class="col-sm-9">{{ $brand->brand_name }}</dd>

                <dt class="col-sm-3">Brand Image:</dt>
                <dd class="col-sm-9">
                    @if($brand->image)
                        <img src="{{ Storage::url($brand->image) }}" alt="{{ $brand->brand_name }}" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #ddd;">
                    @else
                        <span class="text-muted">No image uploaded</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Created By:</dt>
                <dd class="col-sm-9">{{ $brand->creator->name ?? 'N/A' }} ({{ $brand->creator->email ?? 'N/A' }})</dd>

                <dt class="col-sm-3">Created At:</dt>
                <dd class="col-sm-9">{{ $brand->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At:</dt>
                <dd class="col-sm-9">{{ $brand->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.brands.edit', $brand->brand_id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Brand
                </a>
                <form action="{{ route('admin.brands.destroy', $brand->brand_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this brand?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Brand
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

