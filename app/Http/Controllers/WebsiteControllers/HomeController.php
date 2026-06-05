<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display the homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::with('subcategories')
            ->latest()
            ->take(4)
            ->get();
        
        $allCategories = Category::latest()->get();
        
        // Fetch all product attributes for tags section
        $productAttributes = ProductAttribute::latest()->get();
        
        $products = Product::where('available', true)
            ->with(['productImages', 'brand', 'category'])
            ->latest()
            ->take(8)
            ->get();
        
        // Hot Trend - Brands (shuffled, max 5)
        $hotTrendBrands = Brand::inRandomOrder()
            ->take(5)
            ->get();
        
        // Best Seller - Products with many subcategories (max 5)
        // Get subcategories that have the most products, then get products from those subcategories
        $popularSubcategoryIds = DB::table('products')
            ->whereNotNull('subcategory_id')
            ->where('available', true)
            ->select('subcategory_id', DB::raw('count(*) as product_count'))
            ->groupBy('subcategory_id')
            ->orderBy('product_count', 'desc')
            ->limit(5)
            ->pluck('subcategory_id');
        
        $bestSellerProducts = Product::where('available', true)
            ->whereNotNull('subcategory_id')
            ->whereIn('subcategory_id', $popularSubcategoryIds)
            ->with(['productImages', 'brand', 'category', 'subcategory'])
            ->inRandomOrder()
            ->take(5)
            ->get();
        
        // If we don't have enough products, fill with random products that have subcategories
        if ($bestSellerProducts->count() < 5) {
            $additionalProducts = Product::where('available', true)
                ->whereNotNull('subcategory_id')
                ->with(['productImages', 'brand', 'category', 'subcategory'])
                ->whereNotIn('product_id', $bestSellerProducts->pluck('product_id'))
                ->inRandomOrder()
                ->take(5 - $bestSellerProducts->count())
                ->get();
            $bestSellerProducts = $bestSellerProducts->merge($additionalProducts);
        }
        
        // Feature - Random products (max 5)
        $featuredProducts = Product::where('available', true)
            ->with(['productImages', 'brand', 'category'])
            ->inRandomOrder()
            ->take(5)
            ->get();
        
        // Payment Methods
        $payments = Payment::latest()->get();
        
        return view('websitepages.homepage', compact('categories', 'products', 'allCategories', 'productAttributes', 'hotTrendBrands', 'bestSellerProducts', 'featuredProducts', 'payments'));
    }

    /**
     * Get subcategories for a category via AJAX
     *
     * @param int $categoryId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSubcategories($categoryId)
    {
        if ($categoryId === 'all') {
            return response()->json(['subcategories' => []]);
        }

        $subcategories = Subcategory::where('category_id', $categoryId)
            ->orderBy('subcategory_name')
            ->get(['subcategory_id', 'subcategory_name']);

        return response()->json([
            'subcategories' => $subcategories
        ]);
    }

    /**
     * Filter and sort products via AJAX
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterProducts(Request $request)
    {
        $query = Product::where('available', true)
            ->with(['productImages', 'brand', 'category', 'subcategory']);

        // Filter by category
        if ($request->has('category_id') && $request->category_id !== 'all' && $request->category_id !== null) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by subcategory
        if ($request->has('subcategory_id') && $request->subcategory_id !== null && $request->subcategory_id !== '') {
            $query->where('subcategory_id', $request->subcategory_id);
        }

        // Filter by tags (product attributes)
        if ($request->has('tags') && is_array($request->tags) && count($request->tags) > 0) {
            $query->whereHas('attributeValues', function($q) use ($request) {
                $q->whereIn('product_attribute_values.product_attribute_id', $request->tags);
            });
        }

        // Sort by price
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->get();

        // Build HTML for products using the reusable partial
        $html = '';
        if ($products->count() > 0) {
            foreach ($products as $product) {
                $html .= view('websitepages.products.partials.product-card', ['product' => $product])->render();
            }
        } else {
            $html = '<div class="col-span-full text-center py-12"><p class="text-gray-600 text-lg">No products found matching your filters.</p></div>';
        }

        return response()->json([
            'success' => true,
            'html' => $html,
            'count' => $products->count()
        ]);
    }
}
