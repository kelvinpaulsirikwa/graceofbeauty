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

        // Build HTML for products
        $html = '';
        if ($products->count() > 0) {
            foreach ($products as $product) {
                $productImage = $product->productImages->first();
                $imageUrl = $productImage 
                    ? \Illuminate\Support\Facades\Storage::url($productImage->image_path) 
                    : ($product->front_image ? \Illuminate\Support\Facades\Storage::url($product->front_image) : asset('images/static_image/placeholder.jpg'));
                
                $productUrl = route('product.show', $product->product_id);
                $html .= '<a href="' . $productUrl . '" class="product-card group relative bg-white rounded-lg overflow-hidden transition-transform duration-300 hover:shadow-lg block">';
                $html .= '<div class="relative overflow-hidden bg-gray-200" style="padding-top: 100%;">';
                $html .= '<img src="' . $imageUrl . '" alt="' . htmlspecialchars($product->name) . '" class="absolute top-0 left-0 w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">';
                
                if ($product->available) {
                    $html .= '<div class="absolute top-3 left-3 bg-green-500 text-white px-2 py-1 text-xs font-semibold rounded">NEW</div>';
                } else {
                    $html .= '<div class="absolute top-3 left-3 bg-black text-white px-2 py-1 text-xs font-semibold rounded">OUT OF STOCK</div>';
                }
                
                $html .= '</div>';
                $html .= '<div class="p-4">';
                $html .= '<h3 class="text-lg font-semibold text-gray-800 mb-2 line-clamp-2 min-h-[3rem]">' . htmlspecialchars($product->name) . '</h3>';
                
                $html .= '<div class="flex items-center mb-2">';
                for ($i = 0; $i < 5; $i++) {
                    $html .= '<svg class="w-4 h-4 text-yellow-400 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>';
                }
                $html .= '</div>';
                
                $html .= '<p class="text-xl font-bold text-gray-800">TSH ' . number_format($product->price ?? 0, 2) . '</p>';
                $html .= '</div>';
                $html .= '</a>';
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

