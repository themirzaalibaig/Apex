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
                        <flux:icon name="pencil" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Edit Hero Section</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Update the information for this hero section</p>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <form action="{{ route('hero-sections.update', $heroSection->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
                @csrf
                @method('PUT')
                @if (session()->has('error'))
                <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2">
                        <flux:icon name="exclamation-triangle" class="w-5 h-5 text-red-600 dark:text-red-400" />
                        <span class="text-red-800 dark:text-red-200 font-medium">{{ session('error') }}</span>
                    </div>
                </div>
                @endif

                @if (session()->has('success'))
                <div class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2">
                        <flux:icon name="check-circle" class="w-5 h-5 text-green-600 dark:text-green-400" />
                        <span class="text-green-800 dark:text-green-200 font-medium">{{ session('success') }}</span>
                    </div>
                </div>
                @endif

                <!-- Hero Section Information -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="information-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Hero Section Information</h4>
                    </div>

                    <div class="space-y-2">
                        <flux:label for="subtitle" required class="text-zinc-700 dark:text-zinc-300 font-medium">Subtitle</flux:label>
                        <flux:input
                            id="subtitle"
                            type="text"
                            name="subtitle"
                            value="{{ old('subtitle', $heroSection->subtitle) }}"
                            required
                            placeholder="Enter subtitle text"
                            class="w-full"
                        />
                        @error('subtitle')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label for="title1" required class="text-zinc-700 dark:text-zinc-300 font-medium">Title Line 1</flux:label>
                            <flux:input
                                id="title1"
                                type="text"
                                name="title1"
                                value="{{ old('title1', $heroSection->title1) }}"
                                required
                                placeholder="First title line"
                                class="w-full"
                            />
                            @error('title1')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <flux:label for="title2" required class="text-zinc-700 dark:text-zinc-300 font-medium">Title Line 2</flux:label>
                            <flux:input
                                id="title2"
                                type="text"
                                name="title2"
                                value="{{ old('title2', $heroSection->title2) }}"
                                required
                                placeholder="Second title line"
                                class="w-full"
                            />
                            @error('title2')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label for="cta" required class="text-zinc-700 dark:text-zinc-300 font-medium">CTA Button Text</flux:label>
                            <flux:input
                                id="cta"
                                type="text"
                                name="cta"
                                value="{{ old('cta', $heroSection->cta) }}"
                                required
                                placeholder="e.g., Get Started"
                                class="w-full"
                            />
                            @error('cta')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <flux:label for="cta_url" required class="text-zinc-700 dark:text-zinc-300 font-medium">CTA Button URL</flux:label>
                            <flux:input
                                id="cta_url"
                                type="text"
                                name="cta_url"
                                value="{{ old('cta_url', $heroSection->cta_url) }}"
                                required
                                placeholder="/contact or https://example.com"
                                class="w-full"
                            />
                            @error('cta_url')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Configuration Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="cog-6-tooth" class="w-5 h-5 text-green-600 dark:text-green-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Configuration</h4>
                    </div>

                    <div class="space-y-2">
                        <flux:label for="status" required class="text-zinc-700 dark:text-zinc-300 font-medium">Status</flux:label>
                        <x-toggle-switch :status="$heroSection->status" name="status" />
                        @error('status')
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
                        label="Upload Hero Images"
                        description="Click to select and upload images for the hero section"
                        :existingImages="$heroSection->images->map(fn($img) => [
                            'id' => $img->id,
                            'url' => \Storage::url($img->image),
                            'name' => $img->name,
                            'alt' => $img->alt,
                            'title' => $img->title,
                            'caption' => $img->caption,
                            'keywords' => $img->keywords
                        ])->toArray()"
                    />
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
                            onclick="window.location.href='{{ route('hero-sections.index') }}'"
                            class="px-6"
                        >
                            <flux:icon name="x-mark" class="w-4 h-4 mr-2" />
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary" class="px-6 flex items-center flex-row gap-2">
                            <flux:icon name="check" class="w-4 h-4" />
                            Update Hero Section
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
