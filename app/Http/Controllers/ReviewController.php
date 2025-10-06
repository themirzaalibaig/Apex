<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('images')->orderBy('created_at', 'desc')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active'; // Default status for new reviews
        return view('admin.reviews.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $review = Review::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'email' => $request->email,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => $request->status,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagesMetadata = $request->input('imagesMetadata', []);

            foreach ($images as $index => $image) {
                $metadata = $imagesMetadata[$index] ?? [];
                $path = 'reviews';
                $disk = 'public';
                $filename = $metadata['name'] ?? $request->name . '_' . ($index + 1);
                $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                $review->images()->create([
                    'image' => $storedImage,
                    'name' => $metadata['name'] ?? $filename,
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('reviews.index')->with('success', 'Review created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::with('images')->findOrFail($id);
        return view('admin.reviews.view', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::with('images')->findOrFail($id);
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $review = Review::findOrFail($id);

        $review->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'email' => $request->email,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => $request->status,
        ]);

        // Handle image deletions
        if ($request->has('imagesToDelete')) {
            $imagesToDelete = json_decode($request->input('imagesToDelete'), true);
            if (is_array($imagesToDelete) && !empty($imagesToDelete)) {
                foreach ($imagesToDelete as $imageId) {
                    $image = $review->images()->find($imageId);
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
                $image = $review->images()->find($imageId);
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
                $path = 'reviews';
                $disk = 'public';
                $filename = $metadata['name'] ?? $request->name . '_' . ($index + 1);
                $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                $review->images()->create([
                    'image' => $storedImage,
                    'name' => $metadata['name'] ?? $filename,
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::with('images')->findOrFail($id);

        // Delete associated images and files
        foreach ($review->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully');
    }
}
