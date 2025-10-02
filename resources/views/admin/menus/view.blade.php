@extends('components.layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="mb-6 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <flux:button
                    variant="ghost"
                    icon="arrow-left"
                    href="{{ route('menus.index') }}"
                    wire:navigate
                >
                    Back
                </flux:button>
                <div>
                    <flux:heading size="xl">{{ $menu->name }}</flux:heading>
                    <flux:text class="text-zinc-500 dark:text-zinc-400 mt-1">{{ $menu->link }}</flux:text>
                </div>
            </div>
            <div class="flex gap-2">
                <flux:button
                    variant="outline"
                    icon="pencil"
                    href="{{ route('menus.edit', $menu->id) }}"
                >
                    Edit
                </flux:button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Menu Details Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="information-circle" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Menu Details</h3>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div>
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium mb-2">Menu Name</flux:label>
                            <p class="text-zinc-600 dark:text-zinc-400">{{ $menu->name }}</p>
                        </div>

                        <div>
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium mb-2">Menu Link</flux:label>
                            <p class="text-zinc-600 dark:text-zinc-400">{{ $menu->link }}</p>
                        </div>
                    </div>
                </div>

                <!-- Submenus Card -->
                @if($menu->subMenus->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="list-bullet" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Submenus</h3>
                            <span class="ml-auto text-sm text-zinc-500 dark:text-zinc-400">{{ $menu->subMenus->count() }} submenu(s)</span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($menu->subMenus as $submenu)
                                <div class="bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4">
                                    <div class="flex items-start gap-4">
                                        @if($submenu->images)
                                            <div class="flex-shrink-0">
                                                <img
                                                    src="{{ Storage::url($submenu->images->image) }}"
                                                    alt="{{ $submenu->images->alt }}"
                                                    class="w-16 h-16 object-cover rounded-lg border border-zinc-300 dark:border-zinc-600"
                                                >
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <div class="flex items-start justify-between mb-2">
                                                <h4 class="text-base font-semibold text-zinc-900 dark:text-white">{{ $submenu->name }}</h4>
                                                @if($submenu->status === 'active')
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        <i class="fas fa-check-circle mr-1"></i>
                                                        Active
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                        <i class="fas fa-times-circle mr-1"></i>
                                                        Inactive
                                                    </span>
                                                @endif
                                            </div>
                                            <p class="text-sm text-zinc-600 dark:text-zinc-400">
                                                <i class="fas fa-link mr-1"></i>
                                                {{ $submenu->link }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @else
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                        <div class="p-12 text-center">
                            <i class="fas fa-list text-4xl text-zinc-400 dark:text-zinc-500 mb-4"></i>
                            <h3 class="text-lg font-medium text-zinc-500 dark:text-zinc-400 mb-2">No Submenus</h3>
                            <p class="text-sm text-zinc-400 dark:text-zinc-500">This menu doesn't have any submenus yet</p>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="cog-6-tooth" class="w-5 h-5 text-green-600 dark:text-green-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Status</h3>
                        </div>
                    </div>

                    <div class="p-6">
                        @if($menu->status === 'active')
                            <div class="flex items-center gap-2 px-4 py-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                <flux:icon name="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400" />
                                <span class="text-green-800 dark:text-green-200 font-medium">Active</span>
                            </div>
                        @else
                            <div class="flex items-center gap-2 px-4 py-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                <flux:icon name="x-circle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                                <span class="text-red-800 dark:text-red-200 font-medium">Inactive</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Metadata Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="calendar" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Metadata</h3>
                        </div>
                    </div>

                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Created At</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $menu->created_at->format('M d, Y h:i A') }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Last Updated</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $menu->updated_at->format('M d, Y h:i A') }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Total Submenus</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $menu->subMenus->count() }} submenu(s)
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Actions Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="bolt" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Quick Actions</h3>
                        </div>
                    </div>

                    <div class="p-6 space-y-3">
                        <flux:button
                            variant="outline"
                            icon="pencil"
                            href="{{ route('menus.edit', $menu->id) }}"
                            class="w-full justify-center"
                        >
                            Edit Menu
                        </flux:button>

                        <flux:button
                            variant="danger"
                            icon="trash"
                            onclick="confirmDelete({{ $menu->id }}, '{{ $menu->name }}')"
                            class="w-full justify-center"
                        >
                            Delete Menu
                        </flux:button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 max-w-md w-full mx-4">
            <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                    <flux:heading size="lg">Confirm Delete</flux:heading>
                </div>

                <!-- Body -->
                <div class="flex items-start gap-3 mb-6">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                        <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                    </div>
                    <div class="flex-1">
                        <p class="text-zinc-900 dark:text-white mb-2">
                            Are you sure you want to delete the menu
                            <span class="font-semibold" id="menuName"></span>?
                        </p>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            This action cannot be undone. All associated submenus and images will be permanently removed.
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-end gap-3">
                    <flux:button variant="ghost" onclick="closeDeleteModal()">
                        Cancel
                    </flux:button>
                    <flux:button variant="danger" onclick="deleteMenu()">
                        Delete Menu
                    </flux:button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let menuToDelete = null;

        function confirmDelete(menuId, menuName) {
            menuToDelete = menuId;
            document.getElementById('menuName').textContent = `"${menuName}"`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            menuToDelete = null;
        }

        function deleteMenu() {
            if (menuToDelete) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/menus/${menuToDelete}`;

                const csrfMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfMeta) {
                    console.error('CSRF token not found');
                    alert('Error: CSRF token not found. Please refresh the page.');
                    return;
                }

                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfMeta.getAttribute('content');
                form.appendChild(csrfInput);

                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        }

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</div>
@endsection

