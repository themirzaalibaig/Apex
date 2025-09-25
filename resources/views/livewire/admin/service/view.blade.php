<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <flux:icon name="eye" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Service Details</h3>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">View service information and configuration</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <flux:button
                            variant="outline"
                            href="{{ route('admin.services.edit', $service->id) }}"
                            wire:navigate
                        >
                            <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                            Edit
                        </flux:button>
                        <flux:button
                            variant="outline"
                            href="{{ route('admin.services') }}"
                            wire:navigate
                        >
                            <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                            Back to Services
                        </flux:button>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="p-6 space-y-8">
                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="information-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Basic Information</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Service Name</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                <span class="text-zinc-900 dark:text-white font-medium">{{ $service->name }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">URL Slug</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                <span class="text-zinc-900 dark:text-white font-mono text-sm">{{ $service->slug }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Description</flux:label>
                        <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                            @if($service->description)
                                <p class="text-zinc-900 dark:text-white whitespace-pre-wrap">{{ $service->description }}</p>
                            @else
                                <p class="text-zinc-500 dark:text-zinc-400 italic">No description provided</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Configuration Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="cog-6-tooth" class="w-5 h-5 text-green-600 dark:text-green-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Configuration</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Status</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                @if($service->status === 'active')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        <flux:icon name="check-circle" class="w-3 h-3 mr-1" />
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        <flux:icon name="x-circle" class="w-3 h-3 mr-1" />
                                        Inactive
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Tags</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                @if($service->tags)
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
                                @else
                                    <p class="text-zinc-500 dark:text-zinc-400 italic">No tags assigned</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Images Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="photo" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Images</h4>
                    </div>

                    <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                        <div class="flex items-center gap-2">
                            <flux:icon name="photo" class="w-4 h-4 text-zinc-500 dark:text-zinc-400" />
                            <span class="text-zinc-900 dark:text-white">
                                {{ $service->images->count() }} image(s) associated with this service
                            </span>
                        </div>
                        @if($service->images->count() > 0)
                            <div class="mt-3 text-sm text-zinc-500 dark:text-zinc-400">
                                <p>Image management functionality can be added here.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Metadata Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="clock" class="w-5 h-5 text-amber-600 dark:text-amber-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Metadata</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Created</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                <span class="text-zinc-900 dark:text-white text-sm">
                                    {{ $service->created_at->format('M d, Y \a\t h:i A') }}
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Last Updated</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                <span class="text-zinc-900 dark:text-white text-sm">
                                    {{ $service->updated_at->format('M d, Y \a\t h:i A') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
