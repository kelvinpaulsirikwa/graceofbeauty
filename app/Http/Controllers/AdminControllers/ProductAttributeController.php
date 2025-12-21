<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productAttributes = ProductAttribute::with('poster')->latest()->paginate(10);
        return view('adminpages.product_attribute.index', compact('productAttributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpages.product_attribute.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:product_attributes,name'],
        ]);

        ProductAttribute::create([
            'name' => $validated['name'],
            'posted_by' => Auth::id(),
        ]);

        return redirect()->route('admin.product_attributes.index')
            ->with('success', 'Product attribute created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productAttribute = ProductAttribute::with('poster')->findOrFail($id);
        return view('adminpages.product_attribute.show', compact('productAttribute'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $productAttribute = ProductAttribute::findOrFail($id);
        return view('adminpages.product_attribute.edit', compact('productAttribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productAttribute = ProductAttribute::findOrFail($id);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:product_attributes,name,' . $productAttribute->id],
        ]);

        $productAttribute->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('admin.product_attributes.index')
            ->with('success', 'Product attribute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productAttribute = ProductAttribute::findOrFail($id);
        $productAttribute->delete();

        return redirect()->route('admin.product_attributes.index')
            ->with('success', 'Product attribute deleted successfully.');
    }
}
