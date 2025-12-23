{{-- resources/views/layouts/sidebar.blade.php --}}

@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;

    $user = Auth::user();
    $role = $user->role ?? '';
    $name = $user->name ?? 'User';
    $email = $user->email ?? 'noemail';
    
    // Check if user has profile image and if the file actually exists
    $hasImage = false;
    $avatar = '';
    // Get first letter from name, fallback to email if name is empty
    $firstLetter = strtoupper(substr(trim($name ?: $email), 0, 1));
    
    if ($user && $user->image) {
        $imagePath = 'storage/' . $user->image;
        $fullPath = public_path($imagePath);
        
        // Check if the file actually exists
        if (file_exists($fullPath)) {
            $avatar = Storage::url($user->image);
            $hasImage = true;
        }
    }
        
@endphp

<section id="sidebar" class="hide">
    <!-- User Info -->
    <br><br>
    <div class="form-group d-flex align-items-center ps-4">
        <!-- User/Profile Image -->
        @if($hasImage)
            <img src="{{ $avatar }}" 
                 alt="User" 
                 class="rounded-circle me-3 user-avatar-img" 
                 style="width: 50px; height: 50px; object-fit: cover; box-shadow: 0 4px 12px rgba(23, 117, 241, 0.25), 0 0 0 3px rgba(255, 255, 255, 0.8); border-radius: 50%; transition: all 0.3s ease;"
                 onerror="handleImageError(this)">
            <div class="user-avatar-fallback me-3" style="display: none; width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #1775F1 0%, #0C5FCD 100%); color: white; flex-direction: row; align-items: center; justify-content: center; font-weight: 600; font-size: 20px; box-shadow: 0 4px 12px rgba(23, 117, 241, 0.25), 0 0 0 3px rgba(255, 255, 255, 0.8), inset 0 1px 0 rgba(255, 255, 255, 0.2); text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2); letter-spacing: 0.5px; transition: all 0.3s ease;">
                {{ $firstLetter }}
            </div>
        @else
            <div class="user-avatar-fallback me-3" style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #1775F1 0%, #0C5FCD 100%); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 20px; box-shadow: 0 4px 12px rgba(23, 117, 241, 0.25), 0 0 0 3px rgba(255, 255, 255, 0.8), inset 0 1px 0 rgba(255, 255, 255, 0.2); text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2); letter-spacing: 0.5px; transition: all 0.3s ease;">
                {{ $firstLetter }}
            </div>
        @endif

        <!-- User Details -->
        <ul class="list-unstyled mb-0">
            <li class="text-muted small" style="font-weight: 500;">{{ $name }}</li>
            <li class="text-muted small">{{ ucfirst($role) }}</li>
        </ul>
    </div>

    <script>
        // Handle image load errors - show fallback avatar
        function handleImageError(img) {
            img.style.display = 'none';
            const fallback = img.nextElementSibling;
            if (fallback && fallback.classList.contains('user-avatar-fallback')) {
                fallback.style.display = 'flex';
            }
        }
    </script>

    <ul class="side-menu">
        <!-- Common Links (user + admin) -->
        <li>
            <a href="{{ route('admin.dashboard') }}" class="active">
                <i class="bx bxs-dashboard icon"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('home') }}">
                <i class="bx bxs-home icon"></i>
                Website Home
            </a>
        </li>

        @if($role === 'admin')
        <li class="divider" data-text="Content Management"></li>
        <li>
            <a href="{{ route('admin.categories.index') }}">
                <i class="bx bx-category icon"></i>
                Categories
            </a>
        </li>
        <li>
            <a href="{{ route('admin.subcategories.index') }}">
                <i class="bx bx-list-ul icon"></i>
                Subcategories
            </a>
        </li>
        <li>
            <a href="{{ route('admin.brands.index') }}">
                <i class="bx bx-purchase-tag icon"></i>
                Brands
            </a>
        </li>
        <li>
            <a href="{{ route('admin.product_attributes.index') }}">
                <i class="bx bx-list-check icon"></i>
                Product Attributes
            </a>
        </li>
        <li>
            <a href="{{ route('admin.leadership_teams.index') }}">
                <i class="bx bx-group icon"></i>
                Leadership Team
            </a>
        </li>
        <li>
            <a href="{{ route('admin.services.index') }}">
                <i class="bx bx-briefcase icon"></i>
                Services
            </a>
        </li>
        <li>
            <a href="{{ route('admin.payments.index') }}">
                <i class="bx bx-credit-card icon"></i>
                Payments
            </a>
        </li>
            <li>
                <a href="{{ route('admin.consultations.index') }}">
                    <i class="bx bx-message-rounded-detail icon"></i>
                    Consultations
                    @php
                        $unreadConsultations = \App\Models\Consultation::where('read', false)->count();
                    @endphp
                    @if($unreadConsultations > 0)
                        <span class="badge bg-danger ms-2">{{ $unreadConsultations }}</span>
                    @endif
                </a>
            </li>
        <li class="divider" data-text="User Management"></li>
        <li>
            <a href="{{ route('admin.users.index') }}">
                <i class="bx bx-user icon"></i>
                Users
                </a>
            </li>
        @endif

        <!-- Products - accessible by both admin and user -->
        <li class="divider" data-text="{{ $role === 'admin' ? 'Products' : 'My Access' }}"></li>
        <li>
            <a href="{{ route('admin.products.index') }}">
                <i class="bx bx-package icon"></i>
                Products
            </a>
        </li>
        <li>
            <a href="{{ route('admin.user_feedbacks.index') }}">
                <i class="bx bx-message-rounded icon"></i>
                User Feedbacks
            </a>
        </li>
        <li>
            <a href="{{ route('admin.profile.index') }}">
                <i class="bx bx-user-circle icon"></i>
                My Profile
            </a>
        </li>

        <!-- Logout -->
        <div class="ads">
            <div class="wrapper">
                <a href="{{ route('admin.logout') }}" 
                   class="btn-upgrade"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   LOGOUT
                </a>

                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>

                <p>Please <span>logout</span> to keep your account safe.</p>
            </div>
        </div>
    </ul>
</section>
