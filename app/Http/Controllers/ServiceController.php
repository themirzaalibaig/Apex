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
        ]);
        $service = Service::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'tags' => $request->tags,
        ]);
        if ($request->hasFile('image')) {
            $path = 'services';
            $disk = 'public';
            $filename = $request->imageName ? $request->imageName : $request->name;
            $image = $request->file('image')->storeAs($path, $filename . '.' . $request->image->getClientOriginalExtension(),$disk);
            $service->images()->create([
                'image' => $image,
                'name' => $request->imageName,
                'alt' => $request->imageAlt,
                'title' => $request->imageTitle,
                'caption' => $request->imageCaption,
                'keywords' => $request->imageKeywords,
            ]);
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
        ]);

        $service = Service::findOrFail($id);

        $service->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'tags' => $request->tags,
        ]);

        // Handle image update if new image is uploaded
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($service->images()->exists()) {
                $oldImage = $service->images()->first();
                if ($oldImage && Storage::disk('public')->exists($oldImage->image)) {
                    Storage::disk('public')->delete($oldImage->image);
                }
                $oldImage->delete();
            }

            // Store new image
            $path = 'services';
            $disk = 'public';
            $filename = $request->imageName ? $request->imageName : $request->name;
            $image = $request->file('image')->storeAs($path, $filename . '.' . $request->image->getClientOriginalExtension(), $disk);

            $service->images()->create([
                'image' => $image,
                'name' => $request->imageName,
                'alt' => $request->imageAlt,
                'title' => $request->imageTitle,
                'caption' => $request->imageCaption,
                'keywords' => $request->imageKeywords,
            ]);
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
