@extends('adminpages.layouts.app')

@section('content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Edit User</h2>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
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
                    </div>

                    <div class="col-md-6">
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
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Select Role</option>
                                <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>User</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            @if($user->image)
                                <div class="mb-2">
                                    <p class="text-muted small">Current Image:</p>
                                    <img src="{{ Storage::url($user->image) }}" alt="User Image" style="max-width: 150px; max-height: 150px; border-radius: 50%; border: 1px solid #ddd;">
                                </div>
                            @endif
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
                            <div class="form-text">Upload new profile image to replace current one (Max: 2MB)</div>
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <p class="text-muted small">New Image Preview:</p>
                                <img id="previewImg" src="" alt="Preview" style="max-width: 150px; max-height: 150px; border-radius: 50%; border: 1px solid #ddd;">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Update User
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
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
@endsection


