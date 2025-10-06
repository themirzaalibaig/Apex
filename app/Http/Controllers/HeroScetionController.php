<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroScetionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroSections = HeroSection::with('images')->orderBy('created_at', 'desc')->get();
        return view('admin.hero-sections.index', compact('heroSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active';
        return view('admin.hero-sections.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'title1' => 'required|string|max:255',
            'title2' => 'required|string|max:255',
            'cta' => 'required|string|max:255',
            'cta_url' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $heroSection = HeroSection::create([
            'subtitle' => $request->subtitle,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'cta' => $request->cta,
            'cta_url' => $request->cta_url,
            'status' => $request->status,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagesMetadata = $request->input('imagesMetadata', []);

            foreach ($images as $index => $image) {
                $metadata = $imagesMetadata[$index] ?? [];
                $path = 'hero_sections';
                $disk = 'public';
                $filename = $metadata['name'] ?? 'hero_' . ($index + 1);
                $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                $heroSection->images()->create([
                    'image' => $storedImage,
                    'name' => $metadata['name'] ?? $filename,
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $heroSection = HeroSection::with('images')->findOrFail($id);
        return view('admin.hero-sections.view', compact('heroSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $heroSection = HeroSection::with('images')->findOrFail($id);
        return view('admin.hero-sections.edit', compact('heroSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'subtitle' => 'required|string|max:255',
            'title1' => 'required|string|max:255',
            'title2' => 'required|string|max:255',
            'cta' => 'required|string|max:255',
            'cta_url' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $heroSection = HeroSection::findOrFail($id);

        $heroSection->update([
            'subtitle' => $request->subtitle,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'cta' => $request->cta,
            'cta_url' => $request->cta_url,
            'status' => $request->status,
        ]);

        // Handle image deletions
        if ($request->has('imagesToDelete')) {
            $imagesToDelete = json_decode($request->input('imagesToDelete'), true);
            if (is_array($imagesToDelete) && !empty($imagesToDelete)) {
                foreach ($imagesToDelete as $imageId) {
                    $image = $heroSection->images()->find($imageId);
                    if ($image) {
                        if (Storage::disk('public')->exists($image->image)) {
                            Storage::disk('public')->delete($image->image);
                        }
                        $image->delete();
                    }
                }
            }
        }

        // Handle existing images metadata updates
        if ($request->has('existingImagesMetadata')) {
            $existingImagesMetadata = $request->input('existingImagesMetadata', []);
            foreach ($existingImagesMetadata as $imageId => $metadata) {
                $image = $heroSection->images()->find($imageId);
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
            $images = $request->file('images');
            $imagesMetadata = $request->input('imagesMetadata', []);

            foreach ($images as $index => $image) {
                $metadata = $imagesMetadata[$index] ?? [];
                $path = 'hero_sections';
                $disk = 'public';
                $filename = $metadata['name'] ?? 'hero_' . ($index + 1);
                $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                $heroSection->images()->create([
                    'image' => $storedImage,
                    'name' => $metadata['name'] ?? $filename,
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $heroSection = HeroSection::with('images')->findOrFail($id);

        // Delete associated images and files
        foreach ($heroSection->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $heroSection->delete();
        return redirect()->route('hero-sections.index')->with('success', 'Hero Section deleted successfully');
    }
}
