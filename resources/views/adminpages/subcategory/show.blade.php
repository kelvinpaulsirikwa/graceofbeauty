@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Subcategory Details</h2>
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Subcategory ID:</dt>
                <dd class="col-sm-9">{{ $subcategory->subcategory_id }}</dd>

                <dt class="col-sm-3">Category:</dt>
                <dd class="col-sm-9">{{ $subcategory->category->category_name ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Subcategory Name:</dt>
                <dd class="col-sm-9">{{ $subcategory->subcategory_name }}</dd>

                <dt class="col-sm-3">Created By:</dt>
                <dd class="col-sm-9">{{ $subcategory->creator->name ?? 'N/A' }} ({{ $subcategory->creator->email ?? 'N/A' }})</dd>

                <dt class="col-sm-3">Created At:</dt>
                <dd class="col-sm-9">{{ $subcategory->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At:</dt>
                <dd class="col-sm-9">{{ $subcategory->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.subcategories.edit', $subcategory->subcategory_id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Subcategory
                </a>
                <form action="{{ route('admin.subcategories.destroy', $subcategory->subcategory_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this subcategory?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Subcategory
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

