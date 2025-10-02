@extends('components.layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-zinc-100 dark:bg-zinc-900/30 rounded-lg flex items-center justify-center">
                        <flux:icon name="bars-3" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Create New Menu</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Fill in the information below to create a menu</p>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
                @csrf
                @if (session()->has('error'))
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2">
                        <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                        <span class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
                @endif

                <!-- Menu Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="information-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Menu Information</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label for="name" required class="text-zinc-700 dark:text-zinc-300 font-medium">Menu Name</flux:label>
                            <flux:input
                                id="name"
                                type="text"
                                name="name"
                                required
                                value="{{ old('name') }}"
                                placeholder="Enter menu name"
                                class="w-full"
                            />
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <flux:label for="link" required class="text-zinc-700 dark:text-zinc-300 font-medium">Menu Link</flux:label>
                            <flux:input
                                id="link"
                                type="text"
                                name="link"
                                required
                                value="{{ old('link') }}"
                                placeholder="/about or https://example.com"
                                class="w-full"
                            />
                            @error('link')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <flux:label for="status" required class="text-zinc-700 dark:text-zinc-300 font-medium">Status</flux:label>
                        <x-toggle-switch :status="$status" name="status" />
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Submenus Section -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center gap-2">
                            <flux:icon name="list-bullet" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                            <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Submenus (Optional)</h4>
                        </div>
                        <flux:button type="button" variant="outline" size="sm" onclick="addSubmenu()">
                            <flux:icon name="plus" class="w-4 h-4 mr-1" />
                            Add Submenu
                        </flux:button>
                    </div>

                    <div id="submenusContainer" class="space-y-4">
                        <!-- Submenus will be added here dynamically -->
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-zinc-200 dark:border-zinc-700">
                    <div class="text-sm text-zinc-500 dark:text-zinc-400">
                        <span class="inline-flex items-center gap-1">
                            <flux:icon name="exclamation-triangle" class="w-4 h-4" />
                            Required fields are marked with *
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <flux:button
                            type="button"
                            variant="outline"
                            href="{{ route('menus.index') }}"
                            wire:navigate
                            class="px-6"
                        >
                            <flux:icon name="x-mark" class="w-4 h-4 mr-2" />
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary" class="px-6 flex items-center flex-row gap-2">
                            <flux:icon name="check" class="w-4 h-4" />
                            Create Menu
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let submenuIndex = 0;

function addSubmenu() {
    const container = document.getElementById('submenusContainer');
    const submenuHtml = `
        <div class="submenu-item bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg p-4" data-index="${submenuIndex}">
            <div class="flex items-start justify-between mb-4">
                <h5 class="text-sm font-semibold text-zinc-900 dark:text-white flex items-center gap-2">
                    <i class="fas fa-list text-purple-600 dark:text-purple-400"></i>
                    Submenu #${submenuIndex + 1}
                </h5>
                <button type="button" onclick="removeSubmenu(${submenuIndex})" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                    <i class="fas fa-trash"></i>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Submenu Name</label>
                    <input
                        type="text"
                        name="submenus[${submenuIndex}][name]"
                        placeholder="Enter submenu name"
                        class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Submenu Link</label>
                    <input
                        type="text"
                        name="submenus[${submenuIndex}][link]"
                        placeholder="/page or https://example.com"
                        class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Image (Optional)</label>
                    <div class="flex items-center gap-3">
                        <label for="submenu_image_${submenuIndex}" class="cursor-pointer inline-flex items-center px-4 py-2 bg-zinc-100 hover:bg-zinc-200 dark:bg-zinc-700 dark:hover:bg-zinc-600 text-zinc-900 dark:text-white rounded-lg border border-zinc-300 dark:border-zinc-600 text-sm font-medium transition-colors">
                            <i class="fas fa-image mr-2"></i>
                            Choose Image
                        </label>
                        <input
                            type="file"
                            id="submenu_image_${submenuIndex}"
                            name="submenus[${submenuIndex}][image]"
                            accept="image/*"
                            onchange="previewImage(${submenuIndex}, this)"
                            class="hidden"
                        />
                    </div>
                    <div id="preview_${submenuIndex}" class="hidden mt-2">
                        <img id="preview_img_${submenuIndex}" src="" alt="Preview" class="w-24 h-24 object-cover rounded-lg border border-zinc-300 dark:border-zinc-600">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Status</label>
                    <select
                        name="submenus[${submenuIndex}][status]"
                        class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', submenuHtml);
    submenuIndex++;
}

function removeSubmenu(index) {
    const submenu = document.querySelector(`.submenu-item[data-index="${index}"]`);
    if (submenu) {
        submenu.remove();
    }
}

function previewImage(index, input) {
    const preview = document.getElementById(`preview_${index}`);
    const previewImg = document.getElementById(`preview_img_${index}`);

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.classList.remove('hidden');
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.classList.add('hidden');
    }
}
</script>

@endsection

