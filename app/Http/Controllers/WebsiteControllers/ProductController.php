<?php

namespace App\Http\Controllers\WebsiteControllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the product specification page.
     *
     * @param int $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        $product = Product::with([
            'brand',
            'category',
            'subcategory',
            'productImages',
            'productAttributeValues.productAttribute'
        ])->find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        return view('websitepages.products.productspecification', compact('product'));
    }

    /**
     * Get a random product from the same category.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function randomFromCategory($id)
    {
        $currentProduct = Product::find($id);

        if (!$currentProduct || !$currentProduct->category_id) {
            return redirect()->route('home')->with('error', 'Product not found.');
        }

        // Get a random product from the same category, excluding the current product
        $randomProduct = Product::where('category_id', $currentProduct->category_id)
            ->where('product_id', '!=', $id)
            ->where('available', true)
            ->inRandomOrder()
            ->first();

        // If no other product in the same category, redirect to category page
        if (!$randomProduct) {
            return redirect()->route('category.show', $currentProduct->category_id)
                ->with('info', 'No other products available in this category.');
        }

        return redirect()->route('product.show', $randomProduct->product_id);
    }
}

