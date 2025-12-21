@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Product Attribute Details</h2>
        <a href="{{ route('admin.product_attributes.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Attribute ID:</dt>
                <dd class="col-sm-9">{{ $productAttribute->id }}</dd>

                <dt class="col-sm-3">Attribute Name:</dt>
                <dd class="col-sm-9">{{ $productAttribute->name }}</dd>

                <dt class="col-sm-3">Posted By:</dt>
                <dd class="col-sm-9">{{ $productAttribute->poster->name ?? 'N/A' }} ({{ $productAttribute->poster->email ?? 'N/A' }})</dd>

                <dt class="col-sm-3">Created At:</dt>
                <dd class="col-sm-9">{{ $productAttribute->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At:</dt>
                <dd class="col-sm-9">{{ $productAttribute->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.product_attributes.edit', $productAttribute->id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Product Attribute
                </a>
                <form action="{{ route('admin.product_attributes.destroy', $productAttribute->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product attribute?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Product Attribute
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

