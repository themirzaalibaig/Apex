@extends('components.layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <flux:heading size="xl">About Section Details</flux:heading>
                <flux:text class="mt-2">View and manage about section information</flux:text>
            </div>
            <div class="flex items-center space-x-3">
                <flux:button href="{{ route('abouts.edit', $about) }}" variant="primary">
                    <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                    Edit
                </flux:button>
                <flux:button href="{{ route('abouts.index') }}" variant="ghost">
                    <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                    Back to About Sections
                </flux:button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Video Section -->
                @if($about->video)
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                            <div class="flex items-center gap-2">
                                <flux:icon name="play" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Video</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="w-full">
                                <video controls class="w-full h-64 bg-zinc-100 dark:bg-zinc-800 rounded-lg">
                                    <source src="{{ Storage::url($about->video) }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Content Section -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="information-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Content</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <flux:label class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Title</flux:label>
                            <p class="mt-1 text-xl font-semibold text-zinc-900 dark:text-white">{{ $about->title }}</p>
                        </div>
                        <div>
                            <flux:label class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Subtitle</flux:label>
                            <p class="mt-1 text-lg text-zinc-700 dark:text-zinc-300">{{ $about->subtitle }}</p>
                        </div>
                        <div>
                            <flux:label class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Description</flux:label>
                            <p class="mt-1 text-zinc-700 dark:text-zinc-300 whitespace-pre-wrap">{{ $about->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- CTA Section -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="cursor-arrow-rays" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Call to Action</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-4">
                            <flux:button href="{{ $about->cta_url }}" target="_blank" variant="primary">
                                {{ $about->cta }}
                            </flux:button>
                            <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $about->cta_url }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-8">
                <!-- Skills -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="chart-bar" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Skills</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        @php
                            $skills = $about->skills ?? [];
                        @endphp
                        @if(count($skills) > 0)
                            <div class="space-y-4">
                                @foreach($skills as $skill)
                                    <div>
                                        <div class="flex justify-between items-center mb-2">
                                            <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ $skill['name'] ?? '' }}</span>
                                            <span class="text-sm text-zinc-500 dark:text-zinc-400">{{ $skill['percentage'] ?? 0 }}%</span>
                                        </div>
                                        <div class="w-full bg-zinc-200 dark:bg-zinc-700 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: {{ $skill['percentage'] ?? 0 }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">No skills added yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Statistics -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="chart-pie" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Statistics</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        @php
                            $statistics = $about->statistics ?? [];
                        @endphp
                        @if(count($statistics) > 0)
                            <div class="grid grid-cols-1 gap-4">
                                @foreach($statistics as $statistic)
                                    <div class="text-center p-4 bg-zinc-50 dark:bg-zinc-800 rounded-lg">
                                        <div class="text-2xl font-bold text-zinc-900 dark:text-white">{{ $statistic['number'] ?? '' }}</div>
                                        <div class="text-sm text-zinc-500 dark:text-zinc-400">{{ $statistic['label'] ?? '' }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">No statistics added yet.</p>
                        @endif
                    </div>
                </div>

                <!-- Images -->
                @if($about->images->count() > 0)
                    <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                        <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                            <div class="flex items-center gap-2">
                                <flux:icon name="photo" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Images ({{ $about->images->count() }})</h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-2 gap-3">
                                @foreach($about->images as $image)
                                    <div class="relative group">
                                        <img src="{{ Storage::url($image->image) }}" alt="{{ $image->alt }}" class="w-full h-24 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                            <flux:button size="sm" variant="ghost" class="text-white hover:text-white">
                                                <flux:icon name="eye" class="w-4 h-4" />
                                            </flux:button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Quick Actions -->
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                        <div class="flex items-center gap-2">
                            <flux:icon name="cog-6-tooth" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Quick Actions</h3>
                        </div>
                    </div>
                    <div class="p-6 space-y-3">
                        <flux:button href="{{ route('abouts.edit', $about) }}" variant="primary" class="w-full">
                            <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                            Edit About Section
                        </flux:button>
                        <flux:button
                            variant="danger"
                            class="w-full"
                            onclick="confirmDelete({{ $about->id }}, '{{ $about->title }}')"
                        >
                            <flux:icon name="trash" class="w-4 h-4 mr-2" />
                            Delete About Section
                        </flux:button>
                    </div>
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
                        Are you sure you want to delete the about section
                        <span class="font-semibold" id="aboutTitle"></span>?
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
                <flux:button variant="danger" onclick="deleteAbout()">
                    Delete About Section
                </flux:button>
            </div>
        </div>
    </div>
</div>

<script>
let aboutToDelete = null;

function confirmDelete(aboutId, aboutTitle) {
    aboutToDelete = aboutId;
    document.getElementById('aboutTitle').textContent = `"${aboutTitle}"`;
    document.getElementById('deleteModal').classList.remove('hidden');
}

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.add('hidden');
    aboutToDelete = null;
}

function deleteAbout() {
    if (aboutToDelete) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/abouts/${aboutToDelete}`;

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
@endsection
