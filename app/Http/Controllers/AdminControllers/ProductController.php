<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\ProductAttribute;
use App\Models\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['brand', 'category', 'subcategory', 'creator', 'productAttributeValues.productAttribute'])
            ->latest()
            ->paginate(10);
        return view('adminpages.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Only admin can create products
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.products.index')
                ->with('error', 'You do not have permission to create products.');
        }

        $brands = Brand::orderBy('brand_name')->get();
        $categories = Category::orderBy('category_name')->get();
        $subcategories = Subcategory::orderBy('subcategory_name')->get();
        $productAttributes = ProductAttribute::orderBy('name')->get();
        
        return view('adminpages.product.create', compact('brands', 'categories', 'subcategories', 'productAttributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Only admin can store products
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.products.index')
                ->with('error', 'You do not have permission to create products.');
        }

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'brand_id' => ['nullable', 'exists:brands,brand_id'],
            'category_id' => ['required', 'exists:categories,category_id'],
            'subcategory_id' => ['nullable', 'exists:subcategories,subcategory_id'],
            'front_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'price' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'available' => ['nullable', 'boolean'],
            'product_attributes' => ['nullable', 'array'],
            'product_attributes.*.attribute_id' => ['required', 'exists:product_attributes,id'],
            'product_attributes.*.value' => ['required', 'string', 'max:255'],
        ]);

        DB::beginTransaction();
        try {
            $imagePath = null;
            if ($request->hasFile('front_image')) {
                $imagePath = $request->file('front_image')->store('products', 'public');
            }

            $product = Product::create([
                'name' => $validated['name'] ?? null,
                'brand_id' => $validated['brand_id'] ?? null,
                'category_id' => $validated['category_id'],
                'subcategory_id' => $validated['subcategory_id'] ?? null,
                'front_image' => $imagePath,
                'price' => $validated['price'] ?? null,
                'available' => $request->has('available') ? true : false,
                'created_by' => Auth::id(),
            ]);

            // Attach product attributes with values
            if ($request->has('product_attributes') && is_array($request->product_attributes)) {
                foreach ($request->product_attributes as $attr) {
                    if (!empty($attr['attribute_id']) && !empty($attr['value'])) {
                        ProductAttributeValue::create([
                            'product_id' => $product->product_id,
                            'product_attribute_id' => $attr['attribute_id'],
                            'value' => $attr['value'],
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index')
                ->with('success', 'Product created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to create product: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with([
            'brand', 
            'category', 
            'subcategory', 
            'creator',
            'productAttributeValues.productAttribute',
            'productImages'
        ])->findOrFail($id);
        
        return view('adminpages.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Only admin can edit products
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.products.index')
                ->with('error', 'You do not have permission to edit products.');
        }

        $product = Product::with(['productAttributeValues.productAttribute', 'productImages'])->findOrFail($id);
        $brands = Brand::orderBy('brand_name')->get();
        $categories = Category::orderBy('category_name')->get();
        $subcategories = Subcategory::orderBy('subcategory_name')->get();
        $productAttributes = ProductAttribute::orderBy('name')->get();
        
        return view('adminpages.product.edit', compact('product', 'brands', 'categories', 'subcategories', 'productAttributes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Only admin can update products
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.products.index')
                ->with('error', 'You do not have permission to update products.');
        }

        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'brand_id' => ['nullable', 'exists:brands,brand_id'],
            'category_id' => ['required', 'exists:categories,category_id'],
            'subcategory_id' => ['nullable', 'exists:subcategories,subcategory_id'],
            'front_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'price' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'available' => ['nullable', 'boolean'],
            'product_attributes' => ['nullable', 'array'],
            'product_attributes.*.attribute_id' => ['required', 'exists:product_attributes,id'],
            'product_attributes.*.value' => ['required', 'string', 'max:255'],
        ]);

        DB::beginTransaction();
        try {
            $imagePath = $product->front_image;
            if ($request->hasFile('front_image')) {
                // Delete old image if exists
                if ($product->front_image && Storage::disk('public')->exists($product->front_image)) {
                    Storage::disk('public')->delete($product->front_image);
                }
                $imagePath = $request->file('front_image')->store('products', 'public');
            }

            $product->update([
                'name' => $validated['name'] ?? null,
                'brand_id' => $validated['brand_id'] ?? null,
                'category_id' => $validated['category_id'],
                'subcategory_id' => $validated['subcategory_id'] ?? null,
                'front_image' => $imagePath,
                'price' => $validated['price'] ?? null,
                'available' => $request->has('available') ? true : false,
            ]);

            // Delete existing attribute values
            ProductAttributeValue::where('product_id', $product->product_id)->delete();

            // Attach new product attributes with values
            if ($request->has('product_attributes') && is_array($request->product_attributes)) {
                foreach ($request->product_attributes as $attr) {
                    if (!empty($attr['attribute_id']) && !empty($attr['value'])) {
                        ProductAttributeValue::create([
                            'product_id' => $product->product_id,
                            'product_attribute_id' => $attr['attribute_id'],
                            'value' => $attr['value'],
                        ]);
                    }
                }
            }

            DB::commit();
            return redirect()->route('admin.products.index')
                ->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Failed to update product: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Only admin can delete products
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.products.index')
                ->with('error', 'You do not have permission to delete products.');
        }

        $product = Product::findOrFail($id);
        
        DB::beginTransaction();
        try {
            // Delete image if exists
            if ($product->front_image && Storage::disk('public')->exists($product->front_image)) {
                Storage::disk('public')->delete($product->front_image);
            }
            
            // Delete attribute values (cascade should handle this, but being explicit)
            ProductAttributeValue::where('product_id', $product->product_id)->delete();
            
            $product->delete();
            
            DB::commit();
            return redirect()->route('admin.products.index')
                ->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
