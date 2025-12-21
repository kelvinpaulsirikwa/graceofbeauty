@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Users</h2>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Add New User
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @if($user->image)
                                        <img src="{{ Storage::url($user->image) }}" alt="User Image" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                                    @else
                                        <div style="width: 40px; height: 40px; border-radius: 50%; background: linear-gradient(135deg, #1775F1 0%, #0C5FCD 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    @if($user->blocked)
                                        <span class="badge bg-danger">Blocked</span>
                                    @else
                                        <span class="badge bg-success">Active</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('Y-m-d H:i:s') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </a>
                                        @if($user->id !== Auth::id())
                                            <form action="{{ route('admin.users.toggle-block', $user->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-{{ $user->blocked ? 'success' : 'danger' }}" title="{{ $user->blocked ? 'Unblock' : 'Block' }}">
                                                    <i class="bx bx-{{ $user->blocked ? 'lock-open' : 'lock' }}"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection


