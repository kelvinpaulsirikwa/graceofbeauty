@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">User Details</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        @if($user->image)
                            <img src="{{ Storage::url($user->image) }}" alt="User Image" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #1775F1;">
                        @else
                            <div style="width: 150px; height: 150px; border-radius: 50%; background: linear-gradient(135deg, #1775F1 0%, #0C5FCD 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 48px; margin: 0 auto;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                    </div>

                    <dl class="row">
                        <dt class="col-sm-4">User ID:</dt>
                        <dd class="col-sm-8">{{ $user->id }}</dd>

                        <dt class="col-sm-4">Name:</dt>
                        <dd class="col-sm-8">{{ $user->name }}</dd>

                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8">{{ $user->email }}</dd>

                        <dt class="col-sm-4">Role:</dt>
                        <dd class="col-sm-8">
                            <span class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </dd>

                        <dt class="col-sm-4">Status:</dt>
                        <dd class="col-sm-8">
                            @if($user->blocked)
                                <span class="badge bg-danger">Blocked</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </dd>

                        <dt class="col-sm-4">Created At:</dt>
                        <dd class="col-sm-8">{{ $user->created_at->format('Y-m-d H:i:s') }}</dd>

                        <dt class="col-sm-4">Updated At:</dt>
                        <dd class="col-sm-8">{{ $user->updated_at->format('Y-m-d H:i:s') }}</dd>
                    </dl>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning">
                            <i class="bx bx-edit"></i> Edit User
                        </a>
                        @if($user->id !== Auth::id())
                            <form action="{{ route('admin.users.toggle-block', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-{{ $user->blocked ? 'success' : 'danger' }}">
                                    <i class="bx bx-{{ $user->blocked ? 'lock-open' : 'lock' }}"></i> {{ $user->blocked ? 'Unblock' : 'Block' }} User
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Reset Password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.reset-password', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password <span class="text-danger">*</span></label>
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                required
                                minlength="8"
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Minimum 8 characters</div>
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <input 
                                type="password" 
                                class="form-control" 
                                id="password_confirmation" 
                                name="password_confirmation" 
                                required
                                minlength="8"
                            >
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-key"></i> Reset Password
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


