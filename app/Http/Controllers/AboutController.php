<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesMediaUsages;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    use HandlesMediaUsages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $abouts = About::with('mediaUsages.upload')->get();
        return view('admin.abouts.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $selectedMedia = [];
        return view('admin.abouts.create', compact('selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
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

        $this->syncMediaUsages($about, $request->input('media_usages', []));

        return redirect()->route('abouts.index')->with('success', 'About section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(About $about)
    {
        $about->load('mediaUsages.upload');
        // return $about;

        return view('admin.abouts.view', compact('about'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        $about->load('mediaUsages.upload');
        $selectedMedia = $about->mediaUsages()->with('upload')->get()->map(function ($usage) {
            return [
                'upload_id' => $usage->upload_id,
                'type' => $usage->type,
                'url' => $usage->upload?->url,
                'file_name' => $usage->upload?->file_name,
                'seo_alt_text' => $usage->upload?->seo_alt_text,
            ];
        })->toArray();
        return view('admin.abouts.edit', compact('about', 'selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
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

        $this->syncMediaUsages($about, $request->input('media_usages', []));

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

        $about->delete();

        return redirect()->route('abouts.index')->with('success', 'About section deleted successfully.');
    }
}
