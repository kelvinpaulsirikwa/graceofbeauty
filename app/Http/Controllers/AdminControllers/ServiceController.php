<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with(['creator', 'serviceImages'])->orderBy('order')->latest()->paginate(10);
        return view('adminpages.service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adminpages.service.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order' => ['nullable', 'integer', 'min:0'],
            'service_name' => ['required', 'string', 'max:255'],
            'front_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
        ]);

        $imagePath = null;
        if ($request->hasFile('front_image')) {
            $imagePath = $request->file('front_image')->store('services', 'public');
        }

        Service::create([
            'order' => $validated['order'] ?? 0,
            'service_name' => $validated['service_name'],
            'front_image' => $imagePath,
            'description' => $validated['description'] ?? null,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::with(['creator', 'serviceImages.creator'])->findOrFail($id);
        return view('adminpages.service.show', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::with('serviceImages.creator')->findOrFail($id);
        return view('adminpages.service.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'order' => ['nullable', 'integer', 'min:0'],
            'service_name' => ['required', 'string', 'max:255'],
            'front_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'description' => ['nullable', 'string'],
        ]);

        $service = Service::findOrFail($id);

        $imagePath = $service->front_image;
        if ($request->hasFile('front_image')) {
            // Delete old image if exists
            if ($service->front_image && Storage::disk('public')->exists($service->front_image)) {
                Storage::disk('public')->delete($service->front_image);
            }
            $imagePath = $request->file('front_image')->store('services', 'public');
        }

        $service->update([
            'order' => $validated['order'] ?? $service->order,
            'service_name' => $validated['service_name'],
            'front_image' => $imagePath,
            'description' => $validated['description'] ?? $service->description,
        ]);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::findOrFail($id);
        
        // Delete image if exists
        if ($service->front_image && Storage::disk('public')->exists($service->front_image)) {
            Storage::disk('public')->delete($service->front_image);
        }

        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }
}
