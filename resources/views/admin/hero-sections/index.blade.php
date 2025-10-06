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
            <flux:heading size="xl">Hero Sections Management</flux:heading>
            <flux:text class="mt-2">Manage your hero sections and banners</flux:text>
        </div>
        <flux:button variant="primary" icon="plus" href="{{ route('hero-sections.create') }}" wire:navigate>
            Add New Hero Section
        </flux:button>
    </div>

    <div class="overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-zinc-50 dark:bg-zinc-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Hero Section
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Titles
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            CTA
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Images
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Status
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-zinc-200 dark:divide-zinc-700">
                    @forelse($heroSections as $heroSection)
                        <tr class="hover:bg-zinc-50 dark:hover:bg-zinc-800">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-amber-100 dark:bg-amber-900 flex items-center justify-center">
                                            <i class="fas fa-star text-amber-600 dark:text-amber-400"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-zinc-900 dark:text-white">
                                            {{ $heroSection->subtitle }}
                                        </div>
                                        <div class="text-xs text-zinc-500 dark:text-zinc-400">
                                            Created {{ $heroSection->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-zinc-900 dark:text-white font-medium">
                                    {{ Str::limit($heroSection->title1, 30) }}
                                </div>
                                <div class="text-sm text-zinc-600 dark:text-zinc-400">
                                    {{ Str::limit($heroSection->title2, 30) }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-zinc-900 dark:text-white">
                                    {{ $heroSection->cta }}
                                </div>
                                <div class="text-xs text-zinc-500 dark:text-zinc-400 truncate max-w-xs">
                                    {{ $heroSection->cta_url }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($heroSection->images->count() > 0)
                                    <div class="flex items-center gap-1">
                                        @foreach($heroSection->images->take(3) as $image)
                                            <img
                                                src="{{ Storage::url($image->image) }}"
                                                alt="{{ $image->alt }}"
                                                class="w-[30px] h-[30px] object-cover rounded border border-zinc-200 dark:border-zinc-600"
                                                title="{{ $image->name }}"
                                            >
                                        @endforeach
                                        @if($heroSection->images->count() > 3)
                                            <span class="text-xs text-zinc-500 dark:text-zinc-400 ml-1">
                                                +{{ $heroSection->images->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-sm text-zinc-400 dark:text-zinc-500">No images</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($heroSection->status === 'active')
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
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-2">
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="eye"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300"
                                        title="View Hero Section"
                                        href="{{ route('hero-sections.show', $heroSection->id) }}"
                                    >
                                    </flux:button>
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="pencil"
                                        class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300"
                                        title="Edit Hero Section"
                                        href="{{ route('hero-sections.edit', $heroSection->id) }}"
                                    >
                                    </flux:button>
                                    <flux:button
                                        variant="ghost"
                                        size="sm"
                                        icon="trash"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300"
                                        title="Delete Hero Section"
                                        onclick="confirmDelete({{ $heroSection->id }}, '{{ $heroSection->subtitle }}')"
                                    >
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-star text-4xl text-zinc-400 dark:text-zinc-500 mb-4"></i>
                                    <flux:heading size="lg" class="text-zinc-500 dark:text-zinc-400 mb-2">
                                        No Hero Sections Found
                                    </flux:heading>
                                    <flux:text class="text-zinc-400 dark:text-zinc-500 mb-4">
                                        Get started by creating your first hero section
                                    </flux:text>
                                    <flux:button variant="primary" icon="plus" href="{{ route('hero-sections.create') }}">
                                        Add New Hero Section
                                    </flux:button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($heroSections->count() > 0)
        <div class="mt-6 flex items-center justify-between">
            <div class="text-sm text-zinc-700 dark:text-zinc-300">
                Showing {{ $heroSections->count() }} hero section(s)
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
                            Are you sure you want to delete the hero section
                            <span class="font-semibold" id="heroSectionName"></span>?
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
                    <flux:button variant="danger" onclick="deleteHeroSection()">
                        Delete Hero Section
                    </flux:button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let heroSectionToDelete = null;

        function confirmDelete(heroSectionId, heroSectionName) {
            heroSectionToDelete = heroSectionId;
            document.getElementById('heroSectionName').textContent = `"${heroSectionName}"`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            heroSectionToDelete = null;
        }

        function deleteHeroSection() {
            if (heroSectionToDelete) {
                // Create a form and submit it
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/admin/hero-sections/${heroSectionToDelete}`;

                // Add CSRF token
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
