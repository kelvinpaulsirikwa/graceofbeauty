<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('creator')->latest()->paginate(10);
        return view('adminpages.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => ['required', 'string', 'max:255', 'unique:categories,category_name'],
            'front_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('front_image')) {
            $imagePath = ImageHelper::processCategoryImage($request->file('front_image'));
        }

        Category::create([
            'category_name' => $validated['category_name'],
            'front_image' => $imagePath,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('creator')->findOrFail($id);
        return view('adminpages.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('adminpages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'category_name' => ['required', 'string', 'max:255', 'unique:categories,category_name,' . $category->category_id . ',category_id'],
            'front_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $imagePath = $category->front_image;
        if ($request->hasFile('front_image')) {
            // Delete old image if exists
            if ($category->front_image && Storage::disk('public')->exists($category->front_image)) {
                Storage::disk('public')->delete($category->front_image);
            }
            $imagePath = ImageHelper::processCategoryImage($request->file('front_image'));
        }

        $category->update([
            'category_name' => $validated['category_name'],
            'front_image' => $imagePath,
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        
        // Delete image if exists
        if ($category->front_image && Storage::disk('public')->exists($category->front_image)) {
            Storage::disk('public')->delete($category->front_image);
        }
        
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
