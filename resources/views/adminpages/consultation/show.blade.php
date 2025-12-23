@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Consultation Details</h2>
        <div>
            <a href="{{ route('admin.consultations.index') }}" class="btn btn-secondary">
                <i class="bx bx-arrow-back"></i> Back to List
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Consultation Information</h5>
                    <div>
                        @if($consultation->read)
                            <span class="badge bg-success">Read</span>
                        @else
                            <span class="badge bg-warning">Unread</span>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Name:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $consultation->name }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-md-8">
                            <a href="mailto:{{ $consultation->email }}">{{ $consultation->email }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Phone:</strong>
                        </div>
                        <div class="col-md-8">
                            <a href="tel:{{ $consultation->phone }}">{{ $consultation->phone }}</a>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Services:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $consultation->services ?? 'Not specified' }}
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Message:</strong>
                        </div>
                        <div class="col-md-8">
                            <div style="white-space: pre-wrap; background: #f8f9fa; padding: 15px; border-radius: 8px;">
                                {{ $consultation->message }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Timeline</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Submitted:</strong><br>
                        <small class="text-muted">
                            {{ $consultation->created_at->format('F d, Y') }}<br>
                            {{ $consultation->created_at->format('h:i A') }}
                        </small>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <strong>Last Updated:</strong><br>
                        <small class="text-muted">
                            {{ $consultation->updated_at->format('F d, Y') }}<br>
                            {{ $consultation->updated_at->format('h:i A') }}
                        </small>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Actions</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.consultations.toggle-read', $consultation->consultation_id) }}" method="POST" class="mb-3">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-sm btn-warning w-100">
                            @if($consultation->read)
                                <i class="bx bx-envelope"></i> Mark as Unread
                            @else
                                <i class="bx bx-check"></i> Mark as Read
                            @endif
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.consultations.destroy', $consultation->consultation_id) }}" 
                          method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this consultation?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger w-100">
                            <i class="bx bx-trash"></i> Delete Consultation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

