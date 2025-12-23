@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="mb-0">Consultations</h2>
            @if($unreadCount > 0)
                <small class="text-danger">
                    <i class="fas fa-circle me-1"></i>{{ $unreadCount }} unread consultation(s)
                </small>
            @endif
        </div>
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
                            <th>Status</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Services</th>
                            <th>Message</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($consultations as $consultation)
                            <tr class="{{ !$consultation->read ? 'table-warning' : '' }}">
                                <td>
                                    @if($consultation->read)
                                        <span class="badge bg-success">Read</span>
                                    @else
                                        <span class="badge bg-warning">Unread</span>
                                    @endif
                                </td>
                                <td><strong>{{ $consultation->name }}</strong></td>
                                <td>{{ $consultation->email }}</td>
                                <td>{{ $consultation->phone }}</td>
                                <td>{{ $consultation->services ?? 'N/A' }}</td>
                                <td>{{ Str::limit($consultation->message, 50) }}</td>
                                <td>{{ $consultation->created_at->format('M d, Y H:i') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.consultations.show', $consultation->consultation_id) }}" 
                                           class="btn btn-sm btn-primary" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <form action="{{ route('admin.consultations.destroy', $consultation->consultation_id) }}" 
                                              method="POST" 
                                              style="display: inline-block;"
                                              onsubmit="return confirm('Are you sure you want to delete this consultation?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="bx bx-message-rounded-detail" style="font-size: 48px; opacity: 0.3;"></i>
                                    <p class="mt-2 mb-0">No consultations found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($consultations->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $consultations->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

