<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource for a specific product.
     */
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        $images = ProductImage::where('product_id', $productId)->latest()->get();
        return view('adminpages.product_image.index', compact('product', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        return view('adminpages.product_image.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        $validated = $request->validate([
            'image_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $imagePath = $request->file('image_path')->store('product_images', 'public');

        ProductImage::create([
            'product_id' => $productId,
            'image_path' => $imagePath,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.products.edit', $productId)
            ->with('success', 'Product image added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($productId, $id)
    {
        $product = Product::findOrFail($productId);
        $image = ProductImage::where('product_id', $productId)->findOrFail($id);
        return view('adminpages.product_image.show', compact('product', 'image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($productId, $id)
    {
        $product = Product::findOrFail($productId);
        $image = ProductImage::where('product_id', $productId)->findOrFail($id);
        return view('adminpages.product_image.edit', compact('product', 'image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $productId, $id)
    {
        $product = Product::findOrFail($productId);
        $image = ProductImage::where('product_id', $productId)->findOrFail($id);

        $validated = $request->validate([
            'image_path' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $imagePath = $image->image_path;
        if ($request->hasFile('image_path')) {
            // Delete old image if exists
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $imagePath = $request->file('image_path')->store('product_images', 'public');
        }

        $image->update([
            'image_path' => $imagePath,
            'description' => $validated['description'] ?? null,
        ]);

        return redirect()->route('admin.products.edit', $productId)
            ->with('success', 'Product image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId, $id)
    {
        $product = Product::findOrFail($productId);
        $image = ProductImage::where('product_id', $productId)->findOrFail($id);

        // Delete image file if exists
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->route('admin.products.edit', $productId)
            ->with('success', 'Product image deleted successfully.');
    }
}
