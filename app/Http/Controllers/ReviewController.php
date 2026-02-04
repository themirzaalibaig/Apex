<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesMediaUsages;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    use HandlesMediaUsages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::with('mediaUsages.upload')->orderBy('created_at', 'desc')->get();
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active'; // Default status for new reviews
        $selectedMedia = [];
        return view('admin.reviews.create', compact('status', 'selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
        ]);

        $review = Review::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'email' => $request->email,
            'rating' => $request->rating,
            'review' => $request->review,
            'status' => $request->status,
        ]);

        $this->syncMediaUsages($review, $request->input('media_usages', []));

        return redirect()->route('reviews.index')->with('success', 'Review created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::with('mediaUsages.upload')->findOrFail($id);
        return view('admin.reviews.view', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $review = Review::with('mediaUsages.upload')->findOrFail($id);
        $selectedMedia = $review->mediaUsages()->with('upload')->get()->map(function ($usage) {
            return [
                'upload_id' => $usage->upload_id,
                'type' => $usage->type,
                'url' => $usage->upload?->url,
                'file_name' => $usage->upload?->file_name,
                'seo_alt_text' => $usage->upload?->seo_alt_text,
            ];
        })->toArray();
        return view('admin.reviews.edit', compact('review', 'selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
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

        $this->syncMediaUsages($review, $request->input('media_usages', []));

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::with('mediaUsages.upload')->findOrFail($id);

        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully');
    }
}
