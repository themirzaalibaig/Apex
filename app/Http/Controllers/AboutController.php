<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::with('images')->get();
        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.abouts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4,avi,mov,wmv,flv,webm|max:102400',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'skills' => 'required|array',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.percentage' => 'required|integer|min:0|max:100',
            'cta' => 'required|string|max:255',
            'cta_url' => 'required|string|max:255',
            'statistics' => 'required|array',
            'statistics.*.number' => 'required|string|max:255',
            'statistics.*.label' => 'required|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imagesMetadata' => 'nullable|array',
            'imagesMetadata.*.name' => 'required|string|max:255',
            'imagesMetadata.*.alt' => 'nullable|string|max:255',
            'imagesMetadata.*.title' => 'nullable|string|max:255',
            'imagesMetadata.*.caption' => 'nullable|string',
            'imagesMetadata.*.keywords' => 'nullable|string|max:255',
        ]);

        // Handle video upload
        $videoPath = $request->file('video')->store('abouts/videos', 'public');

        $about = About::create([
            'video' => $videoPath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'skills' => $request->skills,
            'cta' => $request->cta,
            'cta_url' => $request->cta_url,
            'statistics' => $request->statistics,
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('abouts', 'public');

                $metadata = $request->input("imagesMetadata.{$index}", []);

                $about->images()->create([
                    'image' => $path,
                    'name' => $metadata['name'] ?? $image->getClientOriginalName(),
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('abouts.index')->with('success', 'About section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        $about->load('images');
        return view('admin.abouts.view', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        $about->load('images');
        return view('admin.abouts.edit', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about)
    {
        $request->validate([
            'video' => 'nullable|file|mimes:mp4,avi,mov,wmv,flv,webm|max:102400',
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'skills' => 'required|array',
            'skills.*.name' => 'required|string|max:255',
            'skills.*.percentage' => 'required|integer|min:0|max:100',
            'cta' => 'required|string|max:255',
            'cta_url' => 'required|string|max:255',
            'statistics' => 'required|array',
            'statistics.*.number' => 'required|string|max:255',
            'statistics.*.label' => 'required|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'imagesMetadata' => 'nullable|array',
            'imagesMetadata.*.name' => 'required|string|max:255',
            'imagesMetadata.*.alt' => 'nullable|string|max:255',
            'imagesMetadata.*.title' => 'nullable|string|max:255',
            'imagesMetadata.*.caption' => 'nullable|string',
            'imagesMetadata.*.keywords' => 'nullable|string|max:255',
            'imagesToDelete' => 'nullable|string',
            'existingImagesMetadata' => 'nullable|array',
        ]);

        // Handle video upload if new video is provided
        $videoPath = $about->video; // Keep existing video by default
        if ($request->hasFile('video')) {
            // Delete old video
            if ($about->video) {
                Storage::disk('public')->delete($about->video);
            }
            // Upload new video
            $videoPath = $request->file('video')->store('abouts/videos', 'public');
        }

        $about->update([
            'video' => $videoPath,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'skills' => $request->skills,
            'cta' => $request->cta,
            'cta_url' => $request->cta_url,
            'statistics' => $request->statistics,
        ]);

        // Handle image deletions
        if ($request->has('imagesToDelete')) {
            $imagesToDelete = json_decode($request->input('imagesToDelete'), true);
            if (is_array($imagesToDelete)) {
                foreach ($imagesToDelete as $imageId) {
                    $image = $about->images()->find($imageId);
                    if ($image) {
                        Storage::disk('public')->delete($image->image);
                        $image->delete();
                    }
                }
            }
        }

        // Handle existing image metadata updates
        if ($request->has('existingImagesMetadata')) {
            $existingImagesMetadata = $request->input('existingImagesMetadata', []);
            foreach ($existingImagesMetadata as $imageId => $metadata) {
                $image = $about->images()->find($imageId);
                if ($image) {
                    $image->update([
                        'name' => $metadata['name'] ?? $image->name,
                        'alt' => $metadata['alt'] ?? $image->alt,
                        'title' => $metadata['title'] ?? $image->title,
                        'caption' => $metadata['caption'] ?? $image->caption,
                        'keywords' => $metadata['keywords'] ?? $image->keywords,
                    ]);
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('abouts', 'public');

                $metadata = $request->input("imagesMetadata.{$index}", []);

                $about->images()->create([
                    'image' => $path,
                    'name' => $metadata['name'] ?? $image->getClientOriginalName(),
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('abouts.index')->with('success', 'About section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about)
    {
        // Delete associated video
        if ($about->video) {
            Storage::disk('public')->delete($about->video);
        }

        // Delete associated images
        foreach ($about->images as $image) {
            Storage::disk('public')->delete($image->image);
            $image->delete();
        }

        $about->delete();

        return redirect()->route('abouts.index')->with('success', 'About section deleted successfully.');
    }
}
