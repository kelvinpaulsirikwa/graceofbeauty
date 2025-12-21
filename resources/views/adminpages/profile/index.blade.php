@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">My Profile</h2>
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
                <div class="card-header">
                    <h5 class="mb-0">Profile Information</h5>
                </div>
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

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name', $user->name) }}" 
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input 
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}" 
                                required
                            >
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input 
                                type="file" 
                                class="form-control @error('image') is-invalid @enderror" 
                                id="image" 
                                name="image" 
                                accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                            >
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Upload new profile image (Max: 2MB)</div>
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <p class="text-muted small">New Image Preview:</p>
                                <img id="previewImg" src="" alt="Preview" style="max-width: 150px; max-height: 150px; border-radius: 50%; border: 1px solid #ddd;">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save"></i> Update Profile
                        </button>
                    </form>

                    <script>
                        document.getElementById('image').addEventListener('change', function(e) {
                            const file = e.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('previewImg').src = e.target.result;
                                    document.getElementById('imagePreview').style.display = 'block';
                                };
                                reader.readAsDataURL(file);
                            } else {
                                document.getElementById('imagePreview').style.display = 'none';
                            }
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.change-password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password <span class="text-danger">*</span></label>
                            <input 
                                type="password" 
                                class="form-control @error('current_password') is-invalid @enderror" 
                                id="current_password" 
                                name="current_password" 
                                required
                            >
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

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
                            <label for="password_confirmation" class="form-label">Confirm New Password <span class="text-danger">*</span></label>
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
                            <i class="bx bx-key"></i> Change Password
                        </button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h6>Account Information</h6>
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Role:</dt>
                        <dd class="col-sm-7">
                            <span class="badge bg-{{ $user->role === 'admin' ? 'primary' : 'secondary' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </dd>

                        <dt class="col-sm-5">Status:</dt>
                        <dd class="col-sm-7">
                            @if($user->blocked)
                                <span class="badge bg-danger">Blocked</span>
                            @else
                                <span class="badge bg-success">Active</span>
                            @endif
                        </dd>

                        <dt class="col-sm-5">Member Since:</dt>
                        <dd class="col-sm-7">{{ $user->created_at->format('F Y') }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


