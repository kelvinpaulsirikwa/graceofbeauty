@extends('adminpages.layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Overview</h1>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-outline-primary">
            <i class="fas fa-external-link-alt me-2"></i>View Website
        </a>
    </div>

    {{-- Statistics Cards --}}
    <div class="row g-4 mb-4">
        {{-- Categories Card --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Categories</h6>
                            <h2 class="mb-0">{{ $stats['categories'] }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-folder fa-2x text-primary"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-link text-primary p-0 mt-3">
                        Manage Categories <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Subcategories Card --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Subcategories</h6>
                            <h2 class="mb-0">{{ $stats['subcategories'] }}</h2>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-folder-open fa-2x text-info"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.subcategories.index') }}" class="btn btn-sm btn-link text-info p-0 mt-3">
                        Manage Subcategories <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Brands Card --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Brands</h6>
                            <h2 class="mb-0">{{ $stats['brands'] }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-tags fa-2x text-success"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-sm btn-link text-success p-0 mt-3">
                        Manage Brands <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Products Card --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Products</h6>
                            <h2 class="mb-0">{{ $stats['products'] }}</h2>
                            <small class="text-muted">
                                <span class="text-success">{{ $stats['products_available'] }} available</span> | 
                                <span class="text-danger">{{ $stats['products_unavailable'] }} unavailable</span>
                            </small>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-box fa-2x text-warning"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-link text-warning p-0 mt-3">
                        Manage Products <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Services Card --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Services</h6>
                            <h2 class="mb-0">{{ $stats['services'] }}</h2>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-concierge-bell fa-2x text-danger"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-link text-danger p-0 mt-3">
                        Manage Services <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Leadership Team Card --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Leadership Team</h6>
                            <h2 class="mb-0">{{ $stats['leadership_team'] }}</h2>
                        </div>
                        <div class="bg-secondary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-users fa-2x text-secondary"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.leadership_teams.index') }}" class="btn btn-sm btn-link text-secondary p-0 mt-3">
                        Manage Team <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Users Card --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Users</h6>
                            <h2 class="mb-0">{{ $stats['users'] }}</h2>
                            @if($stats['users_blocked'] > 0)
                                <small class="text-danger">{{ $stats['users_blocked'] }} blocked</small>
                            @endif
                        </div>
                        <div class="bg-dark bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-user-friends fa-2x text-dark"></i>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-link text-dark p-0 mt-3">
                        Manage Users <i class="fas fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Payments Card --}}
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Payment Methods</h6>
                            <h2 class="mb-0">{{ $stats['payments'] }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-credit-card fa-2x text-primary"></i>
                        </div>
                    </div>
                    <small class="text-muted">Configured payment options</small>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Items Section --}}
    <div class="row g-4">
        {{-- Recent Products --}}
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-box me-2"></i>Recent Products</h5>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentProducts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Brand</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentProducts as $product)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.products.show', $product->product_id) }}" class="text-decoration-none">
                                                    {{ Str::limit($product->name, 30) }}
                                                </a>
                                            </td>
                                            <td>{{ $product->brand->brand_name ?? 'N/A' }}</td>
                                            <td>{{ $product->category->category_name ?? 'N/A' }}</td>
                                            <td>
                                                @if($product->available)
                                                    <span class="badge bg-success">Available</span>
                                                @else
                                                    <span class="badge bg-danger">Unavailable</span>
                                                @endif
                                            </td>
                                            <td>TSH {{ number_format($product->price ?? 0, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">No products found.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Recent Services --}}
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-concierge-bell me-2"></i>Recent Services</h5>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentServices->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Service Name</th>
                                        <th>Order</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentServices as $service)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.services.show', $service->service_id) }}" class="text-decoration-none">
                                                    {{ Str::limit($service->service_name, 40) }}
                                                </a>
                                            </td>
                                            <td>{{ $service->order ?? 'N/A' }}</td>
                                            <td>{{ $service->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.services.show', $service->service_id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">No services found.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Recent Categories --}}
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-folder me-2"></i>Recent Categories</h5>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentCategories->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($recentCategories as $category)
                                <div class="list-group-item d-flex justify-content-between align-items-center px-0">
                                    <div>
                                        <h6 class="mb-1">{{ $category->category_name }}</h6>
                                        <small class="text-muted">Created: {{ $category->created_at->format('M d, Y') }}</small>
                                    </div>
                                    <a href="{{ route('admin.categories.show', $category->category_id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No categories found.</p>
                    @endif
                </div>
            </div>
        </div>

        {{-- Recent Users --}}
        <div class="col-xl-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-user-friends me-2"></i>Recent Users</h5>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentUsers->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="badge bg-info">{{ ucfirst($user->role ?? 'user') }}</span>
                                            </td>
                                            <td>
                                                @if($user->blocked)
                                                    <span class="badge bg-danger">Blocked</span>
                                                @else
                                                    <span class="badge bg-success">Active</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted mb-0">No users found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="row g-4 mt-2">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus me-2"></i>Add Product
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus me-2"></i>Add Category
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.services.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus me-2"></i>Add Service
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.brands.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus me-2"></i>Add Brand
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
