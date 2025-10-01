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
                    href="{{ route('teams.index') }}"
                    wire:navigate
                >
                    Back
                </flux:button>
                <div>
                    <flux:heading size="xl">{{ $team->name }}</flux:heading>
                    <flux:text class="text-zinc-500 dark:text-zinc-400 mt-1">{{ $team->designation }}</flux:text>
                </div>
            </div>
            <div class="flex gap-2">
                <flux:button
                    variant="outline"
                    icon="pencil"
                    href="{{ route('teams.edit', $team->id) }}"
                >
                    Edit
                </flux:button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Contact Details Card -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="user" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Contact Information</h3>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- Email -->
                        @if($team->email)
                        <div>
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium mb-2">Email Address</flux:label>
                            <a href="mailto:{{ $team->email }}" class="text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-2">
                                <i class="fas fa-envelope"></i>
                                {{ $team->email }}
                            </a>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Social Links Card -->
                @if($team->facebook || $team->twitter || $team->instagram || $team->linkedin || $team->github)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="share" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Social Media</h3>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($team->facebook)
                            <a href="{{ $team->facebook }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <i class="fab fa-facebook text-blue-600 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-white">Facebook</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Visit Profile</p>
                                </div>
                            </a>
                            @endif

                            @if($team->twitter)
                            <a href="{{ $team->twitter }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-sky-100 dark:bg-sky-900/30 flex items-center justify-center">
                                    <i class="fab fa-twitter text-sky-500 dark:text-sky-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-white">Twitter</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Visit Profile</p>
                                </div>
                            </a>
                            @endif

                            @if($team->instagram)
                            <a href="{{ $team->instagram }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center">
                                    <i class="fab fa-instagram text-pink-600 dark:text-pink-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-white">Instagram</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Visit Profile</p>
                                </div>
                            </a>
                            @endif

                            @if($team->linkedin)
                            <a href="{{ $team->linkedin }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                    <i class="fab fa-linkedin text-blue-700 dark:text-blue-400"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-white">LinkedIn</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Visit Profile</p>
                                </div>
                            </a>
                            @endif

                            @if($team->github)
                            <a href="{{ $team->github }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-700/50 transition-colors">
                                <div class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-zinc-700 flex items-center justify-center">
                                    <i class="fab fa-github text-zinc-900 dark:text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-zinc-900 dark:text-white">GitHub</p>
                                    <p class="text-xs text-zinc-500 dark:text-zinc-400">Visit Profile</p>
                                </div>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <!-- Photos Gallery Card -->
                @if($team->images->count() > 0)
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="photo" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Photos</h3>
                            <span class="ml-auto text-sm text-zinc-500 dark:text-zinc-400">{{ $team->images->count() }} photo(s)</span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($team->images as $image)
                                <div class="group relative aspect-square overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
                                    <img
                                        src="{{ Storage::url($image->image) }}"
                                        alt="{{ $image->alt }}"
                                        class="w-full h-full object-cover transition-transform group-hover:scale-110"
                                    >
                                    <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <div class="text-center text-white p-2">
                                            <p class="text-sm font-medium">{{ $image->name }}</p>
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
                        @if($team->status === 'active')
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
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Joined On</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $team->created_at->format('M d, Y h:i A') }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Last Updated</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $team->updated_at->format('M d, Y h:i A') }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-zinc-200 dark:border-zinc-700">
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-1">Total Photos</p>
                            <p class="text-zinc-900 dark:text-white font-medium">
                                {{ $team->images->count() }} photo(s)
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
                            href="{{ route('teams.edit', $team->id) }}"
                            class="w-full justify-center"
                        >
                            Edit Member
                        </flux:button>

                        <flux:button
                            variant="danger"
                            icon="trash"
                            onclick="confirmDelete({{ $team->id }}, '{{ $team->name }}')"
                            class="w-full justify-center"
                        >
                            Delete Member
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
                <div class="flex items-center justify-between mb-4">
                    <flux:heading size="lg">Confirm Delete</flux:heading>
                </div>

                <div class="flex items-start gap-3 mb-6">
                    <div class="flex-shrink-0 w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center">
                        <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                    </div>
                    <div class="flex-1">
                        <p class="text-zinc-900 dark:text-white mb-2">
                            Are you sure you want to delete the team member
                            <span class="font-semibold" id="teamName"></span>?
                        </p>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">
                            This action cannot be undone. All associated data will be permanently removed.
                        </p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <flux:button variant="ghost" onclick="closeDeleteModal()">
                        Cancel
                    </flux:button>
                    <flux:button variant="danger" onclick="deleteTeam()">
                        Delete Member
                    </flux:button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let teamToDelete = null;

        function confirmDelete(teamId, teamName) {
            teamToDelete = teamId;
            document.getElementById('teamName').textContent = `"${teamName}"`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            teamToDelete = null;
        }

        function deleteTeam() {
            if (teamToDelete) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/teams/${teamToDelete}`;

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

