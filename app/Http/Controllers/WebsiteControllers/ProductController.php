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
}

