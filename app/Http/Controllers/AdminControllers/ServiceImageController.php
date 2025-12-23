<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Helpers\ImageHelper;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ServiceImageController extends Controller
{
    /**
     * Display a listing of the resource for a specific service.
     */
    public function index($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        $images = ServiceImage::with('creator')->where('service_id', $serviceId)->latest()->get();
        return view('adminpages.service_image.index', compact('service', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($serviceId)
    {
        $service = Service::findOrFail($serviceId);
        return view('adminpages.service_image.create', compact('service'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $serviceId)
    {
        $service = Service::findOrFail($serviceId);

        $validated = $request->validate([
            'image_path' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $imagePath = ImageHelper::processServiceImage($request->file('image_path'));

        ServiceImage::create([
            'service_id' => $serviceId,
            'image_path' => $imagePath,
            'description' => $validated['description'] ?? null,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.services.service_images.index', $serviceId)
            ->with('success', 'Service image added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($serviceId, $id)
    {
        $service = Service::findOrFail($serviceId);
        $image = ServiceImage::with('creator')->where('service_id', $serviceId)->findOrFail($id);
        return view('adminpages.service_image.show', compact('service', 'image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($serviceId, $id)
    {
        $service = Service::findOrFail($serviceId);
        $image = ServiceImage::where('service_id', $serviceId)->findOrFail($id);
        return view('adminpages.service_image.edit', compact('service', 'image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $serviceId, $id)
    {
        $service = Service::findOrFail($serviceId);
        $image = ServiceImage::where('service_id', $serviceId)->findOrFail($id);

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
            $imagePath = ImageHelper::processServiceImage($request->file('image_path'));
        }

        $image->update([
            'image_path' => $imagePath,
            'description' => $validated['description'] ?? $image->description,
        ]);

        return redirect()->route('admin.services.service_images.index', $serviceId)
            ->with('success', 'Service image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($serviceId, $id)
    {
        $service = Service::findOrFail($serviceId);
        $image = ServiceImage::where('service_id', $serviceId)->findOrFail($id);

        // Delete image file if exists
        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->route('admin.services.service_images.index', $serviceId)
            ->with('success', 'Service image deleted successfully.');
    }
}
