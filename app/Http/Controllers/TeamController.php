<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesMediaUsages;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    use HandlesMediaUsages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::with('mediaUsages.upload')->get();
        return view('admin.teams.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active'; // Default status for new team members
        $selectedMedia = [];
        return view('admin.teams.create', compact('status', 'selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
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

        $this->syncMediaUsages($team, $request->input('media_usages', []));

        return redirect()->route('teams.index')->with('success', 'Team member created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $team = Team::with('mediaUsages.upload')->findOrFail($id);
        return view('admin.teams.view', compact('team'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = Team::with('mediaUsages.upload')->findOrFail($id);
        $selectedMedia = $team->mediaUsages()->with('upload')->get()->map(function ($usage) {
            return [
                'upload_id' => $usage->upload_id,
                'type' => $usage->type,
                'url' => $usage->upload?->url,
                'file_name' => $usage->upload?->file_name,
                'seo_alt_text' => $usage->upload?->seo_alt_text,
            ];
        })->toArray();
        return view('admin.teams.edit', compact('team', 'selectedMedia'));
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
            'media_usages' => 'nullable|array',
            'media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'media_usages.*.type' => 'nullable|string|max:255',
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

        $this->syncMediaUsages($team, $request->input('media_usages', []));

        return redirect()->route('teams.index')->with('success', 'Team member updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $team = Team::with('mediaUsages.upload')->findOrFail($id);

        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team member deleted successfully');
    }
}
