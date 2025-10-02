<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('subMenus')->orderBy('created_at', 'desc')->get();
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $status = 'active';
        return view('admin.menus.create', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'submenus.*.name' => 'nullable|string|max:255',
            'submenus.*.link' => 'nullable|string|max:255',
            'submenus.*.status' => 'nullable|in:active,inactive',
            'submenus.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menu = Menu::create([
            'name' => $request->name,
            'link' => $request->link,
            'status' => $request->status,
        ]);

        // Handle submenus if provided
        if ($request->has('submenus')) {
            foreach ($request->submenus as $index => $submenuData) {
                if (!empty($submenuData['name']) && !empty($submenuData['link'])) {
                    $submenu = $menu->subMenus()->create([
                        'name' => $submenuData['name'],
                        'link' => $submenuData['link'],
                        'status' => $submenuData['status'] ?? 'active',
                    ]);

                    // Handle submenu image if provided
                    if ($request->hasFile("submenus.{$index}.image")) {
                        $image = $request->file("submenus.{$index}.image");
                        $path = 'submenus';
                        $disk = 'public';
                        $filename = $submenuData['name'] . '_' . time();
                        $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                        $submenu->images()->create([
                            'image' => $storedImage,
                            'name' => $submenuData['name'],
                            'alt' => $submenuData['name'],
                            'title' => $submenuData['name'],
                        ]);
                    }
                }
            }
        }

        return redirect()->route('menus.index')->with('success', 'Menu created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::with(['subMenus.images'])->findOrFail($id);
        return view('admin.menus.view', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::with(['subMenus.images'])->findOrFail($id);
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'submenus.*.name' => 'nullable|string|max:255',
            'submenus.*.link' => 'nullable|string|max:255',
            'submenus.*.status' => 'nullable|in:active,inactive',
            'submenus.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $menu = Menu::findOrFail($id);

        $menu->update([
            'name' => $request->name,
            'link' => $request->link,
            'status' => $request->status,
        ]);

        // Handle submenu deletions
        if ($request->has('submenusToDelete')) {
            $submenusToDelete = json_decode($request->input('submenusToDelete'), true);
            if (is_array($submenusToDelete) && !empty($submenusToDelete)) {
                foreach ($submenusToDelete as $submenuId) {
                    $submenu = $menu->subMenus()->find($submenuId);
                    if ($submenu) {
                        // Delete submenu image if exists
                        if ($submenu->images) {
                            if (Storage::disk('public')->exists($submenu->images->image)) {
                                Storage::disk('public')->delete($submenu->images->image);
                            }
                            $submenu->images()->delete();
                        }
                        $submenu->delete();
                    }
                }
            }
        }

        // Handle existing and new submenus
        if ($request->has('submenus')) {
            foreach ($request->submenus as $index => $submenuData) {
                if (!empty($submenuData['name']) && !empty($submenuData['link'])) {
                    // Check if it's an existing submenu (has id)
                    if (!empty($submenuData['id'])) {
                        $submenu = $menu->subMenus()->find($submenuData['id']);
                        if ($submenu) {
                            $submenu->update([
                                'name' => $submenuData['name'],
                                'link' => $submenuData['link'],
                                'status' => $submenuData['status'] ?? 'active',
                            ]);

                            // Handle image update/deletion
                            if ($request->hasFile("submenus.{$index}.image")) {
                                // Delete old image if exists
                                if ($submenu->images) {
                                    if (Storage::disk('public')->exists($submenu->images->image)) {
                                        Storage::disk('public')->delete($submenu->images->image);
                                    }
                                    $submenu->images()->delete();
                                }

                                // Upload new image
                                $image = $request->file("submenus.{$index}.image");
                                $path = 'submenus';
                                $disk = 'public';
                                $filename = $submenuData['name'] . '_' . time();
                                $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                                $submenu->images()->create([
                                    'image' => $storedImage,
                                    'name' => $submenuData['name'],
                                    'alt' => $submenuData['name'],
                                    'title' => $submenuData['name'],
                                ]);
                            }
                        }
                    } else {
                        // New submenu
                        $submenu = $menu->subMenus()->create([
                            'name' => $submenuData['name'],
                            'link' => $submenuData['link'],
                            'status' => $submenuData['status'] ?? 'active',
                        ]);

                        // Handle new submenu image
                        if ($request->hasFile("submenus.{$index}.image")) {
                            $image = $request->file("submenus.{$index}.image");
                            $path = 'submenus';
                            $disk = 'public';
                            $filename = $submenuData['name'] . '_' . time();
                            $storedImage = $image->storeAs($path, $filename . '.' . $image->getClientOriginalExtension(), $disk);

                            $submenu->images()->create([
                                'image' => $storedImage,
                                'name' => $submenuData['name'],
                                'alt' => $submenuData['name'],
                                'title' => $submenuData['name'],
                            ]);
                        }
                    }
                }
            }
        }

        return redirect()->route('menus.index')->with('success', 'Menu updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::with(['subMenus.images'])->findOrFail($id);

        // Delete all submenu images and submenus
        foreach ($menu->subMenus as $submenu) {
            if ($submenu->images) {
                if (Storage::disk('public')->exists($submenu->images->image)) {
                    Storage::disk('public')->delete($submenu->images->image);
                }
                $submenu->images()->delete();
            }
        }

        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully');
    }
}
