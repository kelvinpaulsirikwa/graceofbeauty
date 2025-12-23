<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use App\Models\Product;
use App\Models\Service;
use App\Models\UserFeedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedbacks = UserFeedback::with('creator')->latest()->paginate(10);
        return view('adminpages.user_feedback.index', compact('feedbacks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::latest()->get();
        $services = Service::latest()->get();
        return view('adminpages.user_feedback.create', compact('products', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
            'product_used' => ['nullable', 'array'],
            'product_used.*' => ['exists:products,product_id'],
            'service_used' => ['nullable', 'array'],
            'service_used.*' => ['exists:services,service_id'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = ImageHelper::processUserFeedbackImage($request->file('image'));
        }

        UserFeedback::create([
            'image' => $imagePath,
            'description' => $validated['description'] ?? null,
            'product_used' => $validated['product_used'] ?? [],
            'service_used' => $validated['service_used'] ?? [],
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.user_feedbacks.index')
            ->with('success', 'User feedback created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $feedback = UserFeedback::with('creator')->findOrFail($id);
        
        $products = collect();
        $services = collect();
        
        if ($feedback->product_used && is_array($feedback->product_used)) {
            $products = Product::whereIn('product_id', $feedback->product_used)->get();
        }
        
        if ($feedback->service_used && is_array($feedback->service_used)) {
            $services = Service::whereIn('service_id', $feedback->service_used)->get();
        }
        
        return view('adminpages.user_feedback.show', compact('feedback', 'products', 'services'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $feedback = UserFeedback::findOrFail($id);
        
        // Only admin or the creator can edit
        if (Auth::user()->role !== 'admin' && $feedback->created_by !== Auth::id()) {
            return redirect()->route('admin.user_feedbacks.index')
                ->with('error', 'You do not have permission to edit this feedback.');
        }
        $products = Product::latest()->get();
        $services = Service::latest()->get();
        return view('adminpages.user_feedback.edit', compact('feedback', 'products', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $feedback = UserFeedback::findOrFail($id);
        
        // Only admin or the creator can update
        if (Auth::user()->role !== 'admin' && $feedback->created_by !== Auth::id()) {
            return redirect()->route('admin.user_feedbacks.index')
                ->with('error', 'You do not have permission to update this feedback.');
        }

        $validated = $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
            'product_used' => ['nullable', 'array'],
            'product_used.*' => ['exists:products,product_id'],
            'service_used' => ['nullable', 'array'],
            'service_used.*' => ['exists:services,service_id'],
        ]);

        $imagePath = $feedback->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($feedback->image && Storage::disk('public')->exists($feedback->image)) {
                Storage::disk('public')->delete($feedback->image);
            }
            $imagePath = ImageHelper::processUserFeedbackImage($request->file('image'));
        }

        $feedback->update([
            'image' => $imagePath,
            'description' => $validated['description'] ?? $feedback->description,
            'product_used' => $validated['product_used'] ?? [],
            'service_used' => $validated['service_used'] ?? [],
        ]);

        return redirect()->route('admin.user_feedbacks.index')
            ->with('success', 'User feedback updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $feedback = UserFeedback::findOrFail($id);
        
        // Only admin or the creator can delete
        if (Auth::user()->role !== 'admin' && $feedback->created_by !== Auth::id()) {
            return redirect()->route('admin.user_feedbacks.index')
                ->with('error', 'You do not have permission to delete this feedback.');
        }
        
        // Delete image if exists
        if ($feedback->image && Storage::disk('public')->exists($feedback->image)) {
            Storage::disk('public')->delete($feedback->image);
        }

        $feedback->delete();

        return redirect()->route('admin.user_feedbacks.index')
            ->with('success', 'User feedback deleted successfully.');
    }
}

