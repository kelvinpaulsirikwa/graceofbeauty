<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Subcategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::with(['category', 'creator'])->latest()->paginate(10);
        return view('adminpages.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        return view('adminpages.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,category_id'],
            'subcategory_name' => ['required', 'string', 'max:255'],
        ]);

        // Check for duplicate subcategory name within the same category
        $exists = Subcategory::where('category_id', $validated['category_id'])
            ->where('subcategory_name', $validated['subcategory_name'])
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'subcategory_name' => 'This subcategory name already exists for the selected category.',
            ])->withInput();
        }

        Subcategory::create([
            'category_id' => $validated['category_id'],
            'subcategory_name' => $validated['subcategory_name'],
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subcategory = Subcategory::with(['category', 'creator'])->findOrFail($id);
        return view('adminpages.subcategory.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::orderBy('category_name')->get();
        return view('adminpages.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,category_id'],
            'subcategory_name' => ['required', 'string', 'max:255'],
        ]);

        // Check for duplicate subcategory name within the same category (excluding current)
        $exists = Subcategory::where('category_id', $validated['category_id'])
            ->where('subcategory_name', $validated['subcategory_name'])
            ->where('subcategory_id', '!=', $subcategory->subcategory_id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'subcategory_name' => 'This subcategory name already exists for the selected category.',
            ])->withInput();
        }

        $subcategory->update([
            'category_id' => $validated['category_id'],
            'subcategory_name' => $validated['subcategory_name'],
        ]);

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')
            ->with('success', 'Subcategory deleted successfully.');
    }
}
