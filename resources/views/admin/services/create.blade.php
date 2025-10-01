@extends('components.layouts.admin')

@section('content')
<div class=" py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Card -->
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <!-- Card Header -->
            <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-zinc-100 dark:bg-zinc-900/30 rounded-lg flex items-center justify-center">
                        <flux:icon name="cog" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Create New Service</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Fill in the information below to create your service</p>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
                @csrf
                @if (session()->has('error'))
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2">
                        <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                        <span class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            @endif
                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="information-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Basic Information</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label for="name" required class="text-zinc-700 dark:text-zinc-300 font-medium">Service Name</flux:label>
                            <flux:input
                                id="name"
                                type="text"
                                name="name"
                                required
                                value="{{ old('name') }}"
                                placeholder="Enter service name"
                                class="w-full"
                            />
                        </div>

                        <div class="space-y-2">
                            <flux:label for="slug" required class="text-zinc-700 dark:text-zinc-300 font-medium">URL Slug</flux:label>
                            <flux:input
                                id="slug"
                                type="text"
                                name="slug"
                                required
                                value="{{ old('slug') }}"
                                placeholder="service-slug"
                                class="w-full"
                            />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <flux:label for="description" class="text-zinc-700 dark:text-zinc-300 font-medium">Description</flux:label>
                        <flux:textarea
                            id="description"
                            name="description"
                            value="{{ old('description') }}"
                            placeholder="Describe the service in detail..."
                            class="w-full"
                            rows="4"
                        ></flux:textarea>
                        @error('description')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Images Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="photo" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Images</h4>
                    </div>

                    <x-image-uploader
                        name="images"
                        label="Upload Images"
                        description="Click to select and upload multiple images for the service"
                        :existingImages="[]"
                    />
                </div>

                <!-- Configuration Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="cog-6-tooth" class="w-5 h-5 text-green-600 dark:text-green-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Configuration</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label for="status" required class="text-zinc-700 dark:text-zinc-300 font-medium">Status</flux:label>
                            <x-toggle-switch :status="$status" name="status" />
                        </div>

                        <div class="space-y-2">
                            <flux:label for="tags" required class="text-zinc-700 dark:text-zinc-300 font-medium">Tags</flux:label>
                            <x-tags-input
                                :initial-tags="[]"
                                :max-tags="10"
                                :max-tag-length="50"
                                name="tags"
                            />
                        </div>
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
                            href="{{ route('services.index') }}"
                            wire:navigate
                            class="px-6"
                        >
                            <flux:icon name="x-mark" class="w-4 h-4 mr-2" />
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary" class="px-6 flex items-center flex-row gap-2">
                            Create Service
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
