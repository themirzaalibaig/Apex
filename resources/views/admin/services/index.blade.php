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
            <flux:heading size="xl">Services Management</flux:heading>
            <flux:text class="mt-2">Manage your services and their tags</flux:text>
        </div>
        <flux:button variant="primary" icon="plus" href="{{ route('services.create') }}" wire:navigate>
            Add New Service
        </flux:button>
    </div>
    <div class="overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Service
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Description
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Tags
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Images
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($services as $service)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                            <i class="fas fa-cog text-blue-600 dark:text-blue-400"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-zinc-900 dark:text-white">
                                            {{ $service->name }}
                                        </div>
                                        <div class="text-sm text-zinc-500 dark:text-zinc-400">
                                            {{ $service->slug }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-zinc-900 dark:text-white max-w-xs truncate">
                                    {{ Str::limit($service->description, 50) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-wrap gap-1">
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
                                        $tags = array_filter(array_map('trim', explode(',', $service->tags)));
                                    @endphp
                                    @foreach($tags as $i => $tag)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $tagColors[$i % count($tagColors)] }}">
                                            {{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($service->status === 'active')
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
                                <div class="flex items-center">
                                    <i class="fas fa-images text-zinc-400 dark:text-zinc-500 mr-1"></i>
                                    <span class="text-sm text-zinc-900 dark:text-white">
                                        {{ $service->images->count() }} image(s)
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="eye"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                        title="View Service"
                                        href="{{ route('services.show', $service->id) }}"
                                    >
                                    </flux:button>
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="pencil"
                                        class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                                        title="Edit Service"
                                        href="{{ route('services.edit', $service->id) }}"
                                    >
                                    </flux:button>
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="trash"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        title="Delete Service"
                                        onclick="confirmDelete({{ $service->id }}, '{{ $service->name }}')"
                                    >
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-4xl text-zinc-400 dark:text-zinc-500 mb-4"></i>
                                    <flux:heading size="lg" class="text-zinc-500 dark:text-zinc-400 mb-2">
                                        No Services Found
                                    </flux:heading>
                                    <flux:text class="text-zinc-400 dark:text-zinc-500 mb-4">
                                        Get started by creating your first service
                                    </flux:text>
                                    <flux:button variant="primary" icon="plus">
                                        Add New Service
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($services->count() > 0)
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-zinc-700 dark:text-zinc-300">
                Showing {{ $services->count() }} service(s)
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
                            Are you sure you want to delete the service
                            <span class="font-semibold" id="serviceName"></span>?
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
                    <flux:button variant="danger" onclick="deleteService()">
                        Delete Service
                    </flux:button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let serviceToDelete = null;

        function confirmDelete(serviceId, serviceName) {
            serviceToDelete = serviceId;
            document.getElementById('serviceName').textContent = `"${serviceName}"`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            serviceToDelete = null;
        }

        function deleteService() {
            if (serviceToDelete) {
                // Create a form and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/services/${serviceToDelete}`;

                // Add CSRF token
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);

                // Add method override
                const methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            }
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</div>
@endsection
