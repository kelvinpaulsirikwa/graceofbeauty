@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Payment Method Details</h2>
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Payment ID:</dt>
                <dd class="col-sm-9">{{ $payment->payment_id }}</dd>

                <dt class="col-sm-3">Name:</dt>
                <dd class="col-sm-9">{{ $payment->name }}</dd>

                <dt class="col-sm-3">Image:</dt>
                <dd class="col-sm-9">
                    @if($payment->image)
                        <img src="{{ Storage::url($payment->image) }}" alt="{{ $payment->name }}" style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #ddd;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </dd>

                <dt class="col-sm-3">Description:</dt>
                <dd class="col-sm-9">{{ $payment->description ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Created By:</dt>
                <dd class="col-sm-9">{{ $payment->creator->name ?? 'N/A' }} ({{ $payment->creator->email ?? 'N/A' }})</dd>

                <dt class="col-sm-3">Created At:</dt>
                <dd class="col-sm-9">{{ $payment->created_at->format('Y-m-d H:i:s') }}</dd>

                <dt class="col-sm-3">Updated At:</dt>
                <dd class="col-sm-9">{{ $payment->updated_at->format('Y-m-d H:i:s') }}</dd>
            </dl>

            <div class="d-flex gap-2 mt-4">
                <a href="{{ route('admin.payments.edit', $payment->payment_id) }}" class="btn btn-warning">
                    <i class="bx bx-edit"></i> Edit Payment Method
                </a>
                <form action="{{ route('admin.payments.destroy', $payment->payment_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this payment method?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="bx bx-trash"></i> Delete Payment Method
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

