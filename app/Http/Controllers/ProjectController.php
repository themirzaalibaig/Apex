<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesMediaUsages;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    use HandlesMediaUsages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('mediaUsages.upload')->get();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active'; // Default status for new projects
        $selectedMedia = [];
        return view('admin.projects.create', compact('status', 'selectedMedia'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug',
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
            'tags' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'tags' => $request->tags,
            'link' => $request->link,
        ]);

        $this->syncMediaUsages($project, $request->input('media_usages', []));

        return redirect()->route('projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('mediaUsages.upload')->findOrFail($id);
        return view('admin.projects.view', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::with('mediaUsages.upload')->findOrFail($id);

        // Parse tags from comma-separated string to array
        $tags = $project->tags ? explode(',', $project->tags) : [];

        $selectedMedia = $project->mediaUsages()->with('upload')->get()->map(function ($usage) {
            return [
                'upload_id' => $usage->upload_id,
                'type' => $usage->type,
                'url' => $usage->upload?->url,
                'file_name' => $usage->upload?->file_name,
                'seo_alt_text' => $usage->upload?->seo_alt_text,
            ];
        })->toArray();

        return view('admin.projects.edit', compact('project', 'tags', 'selectedMedia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projects,slug,' . $id,
            'description' => 'required|string',
            'status' => 'required|in:active,inactive',
            'tags' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
        ]);

        $project = Project::findOrFail($id);

        $project->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'status' => $request->status,
            'tags' => $request->tags,
            'link' => $request->link,
        ]);

        $this->syncMediaUsages($project, $request->input('media_usages', []));

        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::with('mediaUsages.upload')->findOrFail($id);

        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }
}
