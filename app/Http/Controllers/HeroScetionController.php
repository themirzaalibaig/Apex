<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesMediaUsages;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroScetionController extends Controller
{
    use HandlesMediaUsages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroSections = HeroSection::with('mediaUsages.upload')->orderBy('created_at', 'desc')->get();
        return view('admin.hero-sections.index', compact('heroSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active';
        $selectedMedia = [];
        return view('admin.hero-sections.create', compact('status', 'selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
        ]);

        $heroSection = HeroSection::create([
            'subtitle' => $request->subtitle,
            'title1' => $request->title1,
            'title2' => $request->title2,
            'cta' => $request->cta,
            'cta_url' => $request->cta_url,
            'status' => $request->status,
        ]);

        $this->syncMediaUsages($heroSection, $request->input('media_usages', []));

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $heroSection = HeroSection::with('mediaUsages.upload')->findOrFail($id);
        return view('admin.hero-sections.view', compact('heroSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $heroSection = HeroSection::with('mediaUsages.upload')->findOrFail($id);
        $selectedMedia = $heroSection->mediaUsages()->with('upload')->get()->map(function ($usage) {
            return [
                'upload_id' => $usage->upload_id,
                'type' => $usage->type,
                'url' => $usage->upload?->url,
                'file_name' => $usage->upload?->file_name,
                'seo_alt_text' => $usage->upload?->seo_alt_text,
            ];
        })->toArray();
        return view('admin.hero-sections.edit', compact('heroSection', 'selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
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

        $this->syncMediaUsages($heroSection, $request->input('media_usages', []));

        return redirect()->route('hero-sections.index')->with('success', 'Hero Section updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $heroSection = HeroSection::with('mediaUsages.upload')->findOrFail($id);

        $heroSection->delete();
        return redirect()->route('hero-sections.index')->with('success', 'Hero Section deleted successfully');
    }
}
