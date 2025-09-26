@extends('components.layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-zinc-100 dark:bg-zinc-900/30 rounded-lg flex items-center justify-center">
                            <flux:icon name="eye" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">View Service</h3>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400">{{ $service->name }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <flux:button
                            variant="outline"
                            href="{{ route('services.edit', $service->id) }}"
                            class="px-4"
                        >
                            <flux:icon name="pencil" class="w-4 h-4 mr-2" />
                            Edit
                        </flux:button>

                        <flux:button
                            variant="outline"
                            href="{{ route('services.index') }}"
                            class="px-4"
                        >
                            <flux:icon name="arrow-left" class="w-4 h-4 mr-2" />
                            Back
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
                                <span class="text-zinc-900 dark:text-white">{{ $service->name }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">URL Slug</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                <span class="text-zinc-900 dark:text-white font-mono">{{ $service->slug }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Description</flux:label>
                        <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                            <span class="text-zinc-900 dark:text-white">{{ $service->description }}</span>
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
                                <span class="inline-flex items-center gap-2">
                                    @if($service->status === 'active')
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        <span class="text-green-600 dark:text-green-400 font-medium">Active</span>
                                    @else
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                        <span class="text-red-600 dark:text-red-400 font-medium">Inactive</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Tags</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                @if($service->tags)
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $service->tags) as $tag)
                                            <span class="px-2 py-1 bg-zinc-200 dark:bg-zinc-600 text-zinc-700 dark:text-zinc-300 text-sm rounded-full">
                                                {{ trim($tag) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-zinc-500 dark:text-zinc-400">No tags</span>
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

                    @if($service->images->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($service->images as $image)
                                <div class="bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600 overflow-hidden">
                                    <img src="{{ Storage::url($image->image) }}" alt="{{ $image->alt }}" class="w-full h-48 object-cover">
                                    <div class="p-4">
                                        <h5 class="font-medium text-zinc-900 dark:text-white mb-2">{{ $image->name }}</h5>
                                        @if($image->title)
                                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mb-2">{{ $image->title }}</p>
                                        @endif
                                        @if($image->caption)
                                            <p class="text-sm text-zinc-500 dark:text-zinc-500 mb-2">{{ $image->caption }}</p>
                                        @endif
                                        @if($image->keywords)
                                            <div class="flex flex-wrap gap-1">
                                                @foreach(explode(',', $image->keywords) as $keyword)
                                                    <span class="px-2 py-1 bg-zinc-200 dark:bg-zinc-600 text-zinc-600 dark:text-zinc-400 text-xs rounded">
                                                        {{ trim($keyword) }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                            <flux:icon name="photo" class="w-12 h-12 text-zinc-300 dark:text-zinc-600 mx-auto mb-4" />
                            <h3 class="text-lg font-medium text-zinc-900 dark:text-white mb-2">No Images</h3>
                            <p class="text-zinc-500 dark:text-zinc-400 mb-4">This service doesn't have any images yet</p>
                            <flux:button
                                variant="outline"
                                href="{{ route('services.edit', $service->id) }}"
                                class="px-4"
                            >
                                <flux:icon name="plus" class="w-4 h-4 mr-2" />
                                Add Images
                            </flux:button>
                        </div>
                    @endif
                </div>

                <!-- Metadata Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="clock" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Metadata</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Created At</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                <span class="text-zinc-900 dark:text-white">{{ $service->created_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <flux:label class="text-zinc-700 dark:text-zinc-300 font-medium">Updated At</flux:label>
                            <div class="p-3 bg-zinc-50 dark:bg-zinc-700/50 rounded-lg border border-zinc-200 dark:border-zinc-600">
                                <span class="text-zinc-900 dark:text-white">{{ $service->updated_at->format('M d, Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
