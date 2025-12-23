@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    $isAdmin = $user && $user->role === 'admin';
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">User Feedbacks</h2>
        <a href="{{ route('admin.user_feedbacks.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New Feedback
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Products Used</th>
                            <th>Services Used</th>
                            <th>Created By</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feedbacks as $feedback)
                            <tr>
                                <td>
                                    @if($feedback->image)
                                        <img src="{{ Storage::url($feedback->image) }}" alt="Feedback" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{!! Str::limit($feedback->description ?? 'N/A', 50) !!}</td>
                                <td>
                                    @if($feedback->product_used && count($feedback->product_used) > 0)
                                        <span class="badge bg-info">{{ count($feedback->product_used) }} product(s)</span>
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>
                                <td>
                                    @if($feedback->service_used && count($feedback->service_used) > 0)
                                        <span class="badge bg-success">{{ count($feedback->service_used) }} service(s)</span>
                                    @else
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>
                                <td>{{ $feedback->creator->name ?? 'N/A' }}</td>
                                <td>{{ $feedback->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $feedback->updated_at->format('Y-m-d H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.user_feedbacks.show', $feedback->feedback_id) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        @if($isAdmin || $feedback->created_by === $user->id)
                                            <a href="{{ route('admin.user_feedbacks.edit', $feedback->feedback_id) }}" class="btn btn-sm btn-warning" title="Edit">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.user_feedbacks.destroy', $feedback->feedback_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this feedback?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">No feedbacks found. <a href="{{ route('admin.user_feedbacks.create') }}">Create one now</a>.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($feedbacks->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $feedbacks->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

