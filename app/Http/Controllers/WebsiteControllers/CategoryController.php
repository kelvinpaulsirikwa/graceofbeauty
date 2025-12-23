<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display products for a specific category.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id, Request $request)
    {
        $category = Category::with('subcategories')->find($id);

        if (!$category) {
            abort(404, 'Category not found');
        }

        $allCategories = Category::latest()->get();
        $productAttributes = ProductAttribute::latest()->get();
        
        // Get subcategories for this category
        $subcategories = Subcategory::where('category_id', $id)->orderBy('subcategory_name')->get();

        // Initial products query for this category
        $products = Product::where('available', true)
            ->where('category_id', $id)
            ->with(['productImages', 'brand', 'category', 'subcategory'])
            ->latest()
            ->take(8)
            ->get();

        // Get selected subcategory from query parameter
        $selectedSubcategoryId = $request->query('subcategory');

        return view('websitepages.categories.category', compact(
            'category', 
            'allCategories', 
            'productAttributes', 
            'subcategories',
            'products',
            'selectedSubcategoryId'
        ));
    }

    /**
     * Filter products for a category via AJAX
     *
     * @param int $categoryId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function filterProducts($categoryId, Request $request)
    {
        $query = Product::where('available', true)
            ->where('category_id', $categoryId)
            ->with(['productImages', 'brand', 'category', 'subcategory']);

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

