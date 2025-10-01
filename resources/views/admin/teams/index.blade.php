@extends('components.layouts.admin')

@section('content')

<div class="p-6">
    @if (session()->has('success'))
        <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
            <div class="flex items-center gap-2">
                <flux:icon name="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400" />
                <span class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
            <div class="flex items-center gap-2">
                <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                <span class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</span>
            </div>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <div>
            <flux:heading size="xl">Team Management</flux:heading>
            <flux:text class="mt-2">Manage your team members and their details</flux:text>
        </div>
        <flux:button variant="primary" icon="plus" href="{{ route('teams.create') }}" wire:navigate>
            Add New Member
        </flux:button>
    </div>

    <div class="overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Member
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Contact
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Social Links
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Photo
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($teams as $team)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($team->images->first())
                                            <img src="{{ Storage::url($team->images->first()->image) }}" alt="{{ $team->name }}" class="h-10 w-10 rounded-full object-cover">
                                        @else
                                            <div class="h-10 w-10 rounded-full bg-orange-100 dark:bg-orange-900 flex items-center justify-center">
                                                <i class="fas fa-user text-orange-600 dark:text-orange-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-zinc-900 dark:text-white">
                                            {{ $team->name }}
                                        </div>
                                        <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $team->designation }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @if($team->email)
                                    <div class="text-sm text-zinc-900 dark:text-white flex items-center gap-1">
                                        <i class="fas fa-envelope text-zinc-400 text-xs"></i>
                                        {{ $team->email }}
                                    </div>
                                @else
                                    <span class="text-sm text-zinc-400">No email</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex gap-2">
                                    @if($team->facebook)
                                        <a href="{{ $team->facebook }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                            <i class="fa-brands fa-facebook"></i>
                                        </a>
                                    @endif
                                    @if($team->twitter)
                                        <a href="{{ $team->twitter }}" target="_blank" class="text-sky-500 hover:text-sky-700">
                                            <i class="fa-brands fa-twitter"></i>
                                        </a>
                                    @endif
                                    @if($team->instagram)
                                        <a href="{{ $team->instagram }}" target="_blank" class="text-pink-600 hover:text-pink-800">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if($team->linkedin)
                                        <a href="{{ $team->linkedin }}" target="_blank" class="text-blue-700 hover:text-blue-900">
                                            <i class="fa-brands fa-linkedin"></i>
                                        </a>
                                    @endif
                                    @if($team->github)
                                        <a href="{{ $team->github }}" target="_blank" class="text-zinc-900 dark:text-white hover:text-zinc-700">
                                            <i class="fa-brands fa-github"></i>
                                        </a>
                                    @endif
                                    @if(!$team->facebook && !$team->twitter && !$team->instagram && !$team->linkedin && !$team->github)
                                        <span class="text-sm text-zinc-400">None</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($team->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <i class="fas fa-check-circle mr-1"></i>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        <i class="fas fa-times-circle mr-1"></i>
                                        Inactive
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($team->images->count() > 0)
                                    <div class="flex items-center gap-1">
                                        @foreach($team->images->take(3) as $image)
                                            <img
                                                src="{{ Storage::url($image->image) }}"
                                                alt="{{ $image->alt }}"
                                                class="w-[30px] h-[30px] object-cover rounded border border-zinc-200 dark:border-zinc-600"
                                                title="{{ $image->name }}"
                                            >
                                        @endforeach
                                        @if($team->images->count() > 3)
                                            <span class="text-xs text-zinc-500 dark:text-zinc-400 ml-1">
                                                +{{ $team->images->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-sm text-zinc-400 dark:text-zinc-500">No photos</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="eye"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                        title="View Member"
                                        href="{{ route('teams.show', $team->id) }}"
                                    >
                                    </flux:button>
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="pencil"
                                        class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                                        title="Edit Member"
                                        href="{{ route('teams.edit', $team->id) }}"
                                    >
                                    </flux:button>
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="trash"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        title="Delete Member"
                                        onclick="confirmDelete({{ $team->id }}, '{{ $team->name }}')"
                                    >
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-users text-4xl text-zinc-400 dark:text-zinc-500 mb-4"></i>
                                    <flux:heading size="lg" class="text-zinc-500 dark:text-zinc-400 mb-2">
                                        No Team Members Found
                                    </flux:heading>
                                    <flux:text class="text-zinc-400 dark:text-zinc-500 mb-4">
                                        Get started by adding your first team member
                                    </flux:text>
                                    <flux:button variant="primary" icon="plus" href="{{ route('teams.create') }}">
                                        Add Team Member
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($teams->count() > 0)
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-zinc-700 dark:text-zinc-300">
                Showing {{ $teams->count() }} team member(s)
            </div>
            <div class="flex items-center space-x-2">
                <flux:button variant="outline" size="sm" disabled>
                    <i class="fas fa-chevron-left mr-1"></i>
                    Previous
                </flux:button>
                <flux:button variant="outline" size="sm" disabled>
                    Next
                    <i class="fas fa-chevron-right ml-1"></i>
                </flux:button>
            </div>
        </div>
    @endif

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
                            Are you sure you want to delete the team member
                            <span class="font-semibold" id="teamName"></span>?
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

