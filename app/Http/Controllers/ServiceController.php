<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('images')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active'; // Default status for new services
        return view('admin.services.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'tags' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $service = Service::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'tags' => $request->tags,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagesMetadata = $request->input('imagesMetadata', []);

            foreach ($images as $index => $image) {
                $metadata = $imagesMetadata[$index] ?? [];
                $path = 'services';
                $disk = 'public';
                $filename = $metadata['name'] ?? $request->name . '_' . ($index + 1);
                $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                $service->images()->create([
                    'image' => $storedImage,
                    'name' => $metadata['name'] ?? $filename,
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('services.index')->with('success', 'Service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::with('images')->find($id);
        return view('admin.services.view', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::with('images')->findOrFail($id);

        // Parse tags from comma-separated string to array
        $tags = $service->tags ? explode(',', $service->tags) : [];

        return view('admin.services.edit', compact('service', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'tags' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $service = Service::findOrFail($id);

        $service->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'tags' => $request->tags,
        ]);

        // Handle image deletions
        if ($request->has('imagesToDelete')) {
            $imagesToDelete = json_decode($request->input('imagesToDelete'), true);
            if (is_array($imagesToDelete) && !empty($imagesToDelete)) {
                foreach ($imagesToDelete as $imageId) {
                    $image = $service->images()->find($imageId);
                    if ($image) {
                        if (Storage::disk('public')->exists($image->image)) {
                            Storage::disk('public')->delete($image->image);
                        }
                        $image->delete();
                    }
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagesMetadata = $request->input('imagesMetadata', []);

            foreach ($images as $index => $image) {
                $metadata = $imagesMetadata[$index] ?? [];
                $path = 'services';
                $disk = 'public';
                $filename = $metadata['name'] ?? $request->name . '_' . ($index + 1);
                $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                $service->images()->create([
                    'image' => $storedImage,
                    'name' => $metadata['name'] ?? $filename,
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('services.index')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::with('images')->findOrFail($id);

        // Delete associated images and files
        foreach ($service->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully');
    }
}
