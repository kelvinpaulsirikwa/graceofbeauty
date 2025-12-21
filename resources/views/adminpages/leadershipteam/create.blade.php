@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Create New Leadership Team Member</h2>
        <a href="{{ route('admin.leadership_teams.index') }}" class="btn btn-secondary">
            <i class="bx bx-arrow-back"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.leadership_teams.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                id="name" 
                                name="name" 
                                value="{{ old('name') }}" 
                                placeholder="Enter full name"
                                required
                            >
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="rank" class="form-label">Rank/Position <span class="text-danger">*</span></label>
                            <input 
                                type="text" 
                                class="form-control @error('rank') is-invalid @enderror" 
                                id="rank" 
                                name="rank" 
                                value="{{ old('rank') }}" 
                                placeholder="e.g. CEO, Manager, Director"
                                required
                            >
                            @error('rank')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Member Image</label>
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
                    <div class="form-text">Upload member image (Max: 2MB, Formats: JPEG, PNG, JPG, GIF, WEBP)</div>
                    <div id="imagePreview" class="mt-2" style="display: none;">
                        <img id="previewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phonenumber" class="form-label">Phone Number</label>
                            <input 
                                type="text" 
                                class="form-control @error('phonenumber') is-invalid @enderror" 
                                id="phonenumber" 
                                name="phonenumber" 
                                value="{{ old('phonenumber') }}" 
                                placeholder="Enter phone number"
                            >
                            @error('phonenumber')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="gmail" class="form-label">Gmail</label>
                            <input 
                                type="email" 
                                class="form-control @error('gmail') is-invalid @enderror" 
                                id="gmail" 
                                name="gmail" 
                                value="{{ old('gmail') }}" 
                                placeholder="example@gmail.com"
                            >
                            @error('gmail')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="facebook" class="form-label">Facebook Link</label>
                            <input 
                                type="text" 
                                class="form-control @error('facebook') is-invalid @enderror" 
                                id="facebook" 
                                name="facebook" 
                                value="{{ old('facebook') }}" 
                                placeholder="Enter Facebook profile link"
                            >
                            @error('facebook')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="instagram" class="form-label">Instagram Link</label>
                            <input 
                                type="text" 
                                class="form-control @error('instagram') is-invalid @enderror" 
                                id="instagram" 
                                name="instagram" 
                                value="{{ old('instagram') }}" 
                                placeholder="Enter Instagram profile link"
                            >
                            @error('instagram')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
                    <textarea 
                        class="form-control @error('description') is-invalid @enderror" 
                        id="description" 
                        name="description" 
                        rows="4" 
                        maxlength="150"
                        placeholder="Enter description (max 150 characters)"
                        required
                    >{{ old('description') }}</textarea>
                    <div class="form-text">
                        <span id="charCount">0</span>/150 characters
                    </div>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-save"></i> Create Member
                    </button>
                    <a href="{{ route('admin.leadership_teams.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>

            <script>
                const descriptionTextarea = document.getElementById('description');
                const charCount = document.getElementById('charCount');
                
                descriptionTextarea.addEventListener('input', function() {
                    charCount.textContent = this.value.length;
                });
                
                // Initialize character count
                charCount.textContent = descriptionTextarea.value.length;

                // Image preview
                document.getElementById('image').addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            document.getElementById('previewImg').src = e.target.result;
                            document.getElementById('imagePreview').style.display = 'block';
                        }
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

