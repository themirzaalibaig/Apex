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
                    href="{{ route('projects.index') }}"
                    wire:navigate
                >
                    Back
                </flux:button>
                <div>
                    <flux:heading size="xl">{{ $project->name }}</flux:heading>
                    <flux:text class="text-zinc-500 dark:text-zinc-400 mt-1">{{ $project->slug }}</flux:text>
                </div>
            </div>
            <div class="flex gap-2">
                <flux:button
                    variant="outline"
                    icon="pencil"
                    href="{{ route('projects.edit', $project->id) }}"
                >
                    Edit
                </flux:button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Project Details Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="information-circle" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Project Details</h3>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Description -->
                        <div>
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium mb-2">Description</flux:label>
                            <p class="text-zinc-600 dark:text-zinc-400 whitespace-pre-line">{{ $project->description }}</p>
                        </div>

                        <!-- Project Link -->
                        @if($project->link)
                        <div>
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium mb-2">Project Link</flux:label>
                            <a href="{{ $project->link }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
                                {{ $project->link }}
                                <flux:icon name="arrow-top-right-on-square" class="w-4 h-4" />
                            </a>
                        </div>
                        @endif

                        <!-- Tags -->
                        <div>
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium mb-2">Tags</flux:label>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $tagColors = [
                                        'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                        'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                        'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                        'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                        'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200',
                                        'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200',
                                        'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                        'bg-teal-100 text-teal-800 dark:bg-teal-900 dark:text-teal-200',
                                    ];
                                    $tags = array_filter(array_map('trim', explode(',', $project->tags)));
                                @endphp
                                @foreach($tags as $i => $tag)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $tagColors[$i % count($tagColors)] }}">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Images Gallery Card -->
                @if($project->images->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="photo" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Image Gallery</h3>
                            <span class="ml-auto text-sm text-zinc-500 dark:text-zinc-400">{{ $project->images->count() }} image(s)</span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($project->images as $image)
                                <div class="group relative aspect-square overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
                                    <img
                                        src="{{ Storage::url($image->image) }}"
                                        alt="{{ $image->alt }}"
                                        class="w-full h-full object-cover transition-transform group-hover:scale-110"
                                    >
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <div class="text-center text-white p-2">
                                            <p class="text-sm font-medium">{{ $image->name }}</p>
                                            @if($image->caption)
                                                <p class="text-xs mt-1 opacity-90">{{ Str::limit($image->caption, 50) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                        @if($project->status === 'active')
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
                                {{ $project->created_at->format('M d, Y h:i A') }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Last Updated</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $project->updated_at->format('M d, Y h:i A') }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Total Images</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $project->images->count() }} image(s)
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
                            href="{{ route('projects.edit', $project->id) }}"
                            class="w-full justify-center"
                        >
                            Edit Project
                        </flux:button>

                        <flux:button
                            variant="danger"
                            icon="trash"
                            onclick="confirmDelete({{ $project->id }}, '{{ $project->name }}')"
                            class="w-full justify-center"
                        >
                            Delete Project
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
                            Are you sure you want to delete the project
                            <span class="font-semibold" id="projectName"></span>?
                        </p>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            This action cannot be undone. All associated data will be permanently removed.
                        </p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="flex items-center justify-end gap-3">
                    <flux:button variant="ghost" onclick="closeDeleteModal()">
                        Cancel
                    </flux:button>
                    <flux:button variant="danger" onclick="deleteProject()">
                        Delete Project
                    </flux:button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let projectToDelete = null;

        function confirmDelete(projectId, projectName) {
            projectToDelete = projectId;
            document.getElementById('projectName').textContent = `"${projectName}"`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            projectToDelete = null;
        }

        function deleteProject() {
            if (projectToDelete) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/projects/${projectToDelete}`;

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

