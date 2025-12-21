<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display the gallery page with all product images.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Fetch all product images with product relationship, ordered randomly
        $images = ProductImage::with(['product.category', 'product.brand'])
            ->whereHas('product')
            ->whereNotNull('image_path')
            ->where('image_path', '!=', '')
            ->inRandomOrder()
            ->paginate(24); // 24 images per page
        
        // If AJAX request, return JSON
        if ($request->ajax()) {
            return response()->json([
                'html' => view('websitepages.gallery.image-grid', compact('images'))->render(),
                'hasMore' => $images->hasMorePages(),
                'nextPageUrl' => $images->nextPageUrl()
            ]);
        }
        
        return view('websitepages.gallery.index', compact('images'));
    }
}
