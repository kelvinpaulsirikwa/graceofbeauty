<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\LeadershipTeam;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Service;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     */
    public function index()
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        // Get statistics
        $stats = [
            'categories' => Category::count(),
            'subcategories' => Subcategory::count(),
            'brands' => Brand::count(),
            'products' => Product::count(),
            'products_available' => Product::where('available', true)->count(),
            'products_unavailable' => Product::where('available', false)->count(),
            'product_attributes' => ProductAttribute::count(),
            'services' => Service::count(),
            'leadership_team' => LeadershipTeam::count(),
            'users' => User::count(),
            'users_blocked' => User::where('blocked', true)->count(),
            'payments' => Payment::count(),
        ];

        // Get recent items
        $recentProducts = Product::with(['brand', 'category'])
            ->latest()
            ->take(5)
            ->get();
        
        $recentServices = Service::latest()
            ->take(5)
            ->get();
        
        $recentUsers = User::latest()
            ->take(5)
            ->get();
        
        $recentCategories = Category::latest()
            ->take(5)
            ->get();

        // Return dashboard view with cache control headers
        $response = response()->view('adminpages.dashboard', compact('stats', 'recentProducts', 'recentServices', 'recentUsers', 'recentCategories'));
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        
        return $response;
    }
}
