<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with('images')->get();
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active'; // Default status for new team members
        return view('admin.teams.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $team = Team::create([
            'name' => $request->name,
            'designation' => $request->designation,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'github' => $request->github,
            'status' => $request->status,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            $imagesMetadata = $request->input('imagesMetadata', []);

            foreach ($images as $index => $image) {
                $metadata = $imagesMetadata[$index] ?? [];
                $path = 'teams';
                $disk = 'public';
                $filename = $metadata['name'] ?? $request->name . '_' . ($index + 1);
                $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                $team->images()->create([
                    'image' => $storedImage,
                    'name' => $metadata['name'] ?? $filename,
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('teams.index')->with('success', 'Team member created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = Team::with('images')->findOrFail($id);
        return view('admin.teams.view', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = Team::with('images')->findOrFail($id);
        return view('admin.teams.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
            'github' => 'nullable|url|max:255',
            'status' => 'required|in:active,inactive',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $team = Team::findOrFail($id);

        $team->update([
            'name' => $request->name,
            'designation' => $request->designation,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'github' => $request->github,
            'status' => $request->status,
        ]);

        // Handle image deletions
        if ($request->has('imagesToDelete')) {
            $imagesToDelete = json_decode($request->input('imagesToDelete'), true);
            if (is_array($imagesToDelete) && !empty($imagesToDelete)) {
                foreach ($imagesToDelete as $imageId) {
                    $image = $team->images()->find($imageId);
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
                $path = 'teams';
                $disk = 'public';
                $filename = $metadata['name'] ?? $request->name . '_' . ($index + 1);
                $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                $team->images()->create([
                    'image' => $storedImage,
                    'name' => $metadata['name'] ?? $filename,
                    'alt' => $metadata['alt'] ?? '',
                    'title' => $metadata['title'] ?? '',
                    'caption' => $metadata['caption'] ?? '',
                    'keywords' => $metadata['keywords'] ?? '',
                ]);
            }
        }

        return redirect()->route('teams.index')->with('success', 'Team member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::with('images')->findOrFail($id);

        // Delete associated images and files
        foreach ($team->images as $image) {
            if (Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }
        }

        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team member deleted successfully');
    }
}
