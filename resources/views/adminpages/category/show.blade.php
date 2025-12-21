@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Category Details</h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Category ID:</dt>
                <dd class="col-sm-9">{{ $category->category_id }}</dd>

                <dt class="col-sm-3">Category Name:</dt>
                <dd class="col-sm-9">{{ $category->category_name }}</dd>

                <dt class="col-sm-3">Front Image:</dt>
                <dd class="col-sm-9">
                    @if($category->front_image)
                        <img src="{{ Storage::url($category->front_image) }}" alt="{{ $category->category_name }}" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #ddd;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Created By:</dt>
                <dd class="col-sm-9">{{ $category->creator->name ?? 'N/A' }} ({{ $category->creator->email ?? 'N/A' }})</dd>

                <dt class="col-sm-3">Created At:</dt>
                <dd class="col-sm-9">{{ $category->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At:</dt>
                <dd class="col-sm-9">{{ $category->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.categories.edit', $category->category_id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Category
                </a>
                <form action="{{ route('admin.categories.destroy', $category->category_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Category
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

