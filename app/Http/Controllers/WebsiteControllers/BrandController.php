<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display products for a specific brand with infinite scroll
     *
     * @param int $id
     * @param Request $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function showProducts($id, Request $request)
    {
        $brand = Brand::findOrFail($id);
        
        // Paginate products for this brand
        $perPage = 24;
        $products = Product::where('available', true)
            ->where('brand_id', $id)
            ->with(['productImages', 'brand', 'category', 'subcategory'])
            ->latest()
            ->paginate($perPage);
        
        // If AJAX request, return HTML for infinite scroll
        if ($request->ajax()) {
            return response()->json([
                'html' => view('websitepages.brands.product-grid', compact('products'))->render(),
                'hasMore' => $products->hasMorePages(),
                'nextPage' => $products->nextPageUrl()
            ]);
        }
        
        return view('websitepages.brands.products', compact('brand', 'products'));
    }
}

