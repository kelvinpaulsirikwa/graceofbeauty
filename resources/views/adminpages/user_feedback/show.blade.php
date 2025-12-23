@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">User Feedback Details</h2>
        <a href="{{ route('admin.user_feedbacks.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Feedback ID:</dt>
                <dd class="col-sm-9">{{ $feedback->feedback_id }}</dd>

                <dt class="col-sm-3">Image:</dt>
                <dd class="col-sm-9">
                    @if($feedback->image)
                        <img src="{{ Storage::url($feedback->image) }}" alt="Feedback" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #ddd;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Description:</dt>
                <dd class="col-sm-9">{{ $feedback->description ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Products Used:</dt>
                <dd class="col-sm-9">
                    @if($products && $products->count() > 0)
                        <ul class="list-unstyled mb-0">
                            @foreach($products as $product)
                                <li>
                                    <a href="{{ route('admin.products.show', $product->product_id) }}" class="text-primary">
                                        <i class="bx bx-package"></i> {{ $product->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-muted">No products selected</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Services Used:</dt>
                <dd class="col-sm-9">
                    @if($services && $services->count() > 0)
                        <ul class="list-unstyled mb-0">
                            @foreach($services as $service)
                                <li>
                                    <a href="{{ route('admin.services.show', $service->service_id) }}" class="text-primary">
                                        <i class="bx bx-briefcase"></i> {{ $service->service_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <span class="text-muted">No services selected</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Created By:</dt>
                <dd class="col-sm-9">{{ $feedback->creator->name ?? 'N/A' }} ({{ $feedback->creator->email ?? 'N/A' }})</dd>

                <dt class="col-sm-3">Created At:</dt>
                <dd class="col-sm-9">{{ $feedback->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At:</dt>
                <dd class="col-sm-9">{{ $feedback->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.user_feedbacks.edit', $feedback->feedback_id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Feedback
                </a>
                <form action="{{ route('admin.user_feedbacks.destroy', $feedback->feedback_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

