<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesMediaUsages;
use App\Models\Menu;
use App\Models\SubMenu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    use HandlesMediaUsages;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::with('subMenus.mediaUsages.upload')->orderBy('created_at', 'desc')->get();
        // return $menus;
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
            'submenus.*.media_usages' => 'nullable|array',
            'submenus.*.media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'submenus.*.media_usages.*.type' => 'nullable|string|max:255',
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

                    $this->syncMediaUsages($submenu, $submenuData['media_usages'] ?? []);
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
        $menu = Menu::with(['subMenus.mediaUsages.upload'])->findOrFail($id);
        return view('admin.menus.view', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $menu = Menu::with(['subMenus.mediaUsages.upload'])->findOrFail($id);
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
            'submenus.*.media_usages' => 'nullable|array',
            'submenus.*.media_usages.*.upload_id' => 'nullable|integer|exists:uploads,id',
            'submenus.*.media_usages.*.type' => 'nullable|string|max:255',
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

                            $this->syncMediaUsages($submenu, $submenuData['media_usages'] ?? []);
                        }
                    } else {
                        // New submenu
                        $submenu = $menu->subMenus()->create([
                            'name' => $submenuData['name'],
                            'link' => $submenuData['link'],
                            'status' => $submenuData['status'] ?? 'active',
                        ]);

                        $this->syncMediaUsages($submenu, $submenuData['media_usages'] ?? []);
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
        $menu = Menu::with(['subMenus.mediaUsages.upload'])->findOrFail($id);

        $menu->delete();
        return redirect()->route('menus.index')->with('success', 'Menu deleted successfully');
    }
}
