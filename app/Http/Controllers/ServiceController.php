<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesMediaUsages;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use HandlesMediaUsages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::with('mediaUsages.upload')->get();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active'; // Default status for new services
        $selectedMedia = [];
        return view('admin.services.create', compact('status', 'selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
        ]);

        $service = Service::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'tags' => $request->tags,
        ]);

        $this->syncMediaUsages($service, $request->input('media_usages', []));

        return redirect()->route('services.index')->with('success', 'Service created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::with('mediaUsages.upload')->find($id);
        return view('admin.services.view', compact('service'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::with('mediaUsages.upload')->findOrFail($id);

        // Parse tags from comma-separated string to array
        $tags = $service->tags ? explode(',', $service->tags) : [];

        $selectedMedia = $service->mediaUsages()->with('upload')->get()->map(function ($usage) {
            return [
                'upload_id' => $usage->upload_id,
                'type' => $usage->type,
                'url' => $usage->upload?->url,
                'file_name' => $usage->upload?->file_name,
                'seo_alt_text' => $usage->upload?->seo_alt_text,
            ];
        })->toArray();

        return view('admin.services.edit', compact('service', 'tags', 'selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
        ]);

        $service = Service::findOrFail($id);

        $service->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'tags' => $request->tags,
        ]);

        $this->syncMediaUsages($service, $request->input('media_usages', []));

        return redirect()->route('services.index')->with('success', 'Service updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::with('mediaUsages.upload')->findOrFail($id);

        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted successfully');
    }
}
