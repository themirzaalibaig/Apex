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
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Edit Team Member</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Update the information for {{ $team->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <form action="{{ route('teams.update', $team->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-8">
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

                <!-- Basic Information Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="information-circle" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Basic Information</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label for="name" required class="text-zinc-700 dark:text-zinc-300 font-medium">Full Name</flux:label>
                            <flux:input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name', $team->name) }}"
                                required
                                placeholder="Enter full name"
                                class="w-full"
                            />
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <flux:label for="designation" required class="text-zinc-700 dark:text-zinc-300 font-medium">Designation</flux:label>
                            <flux:input
                                id="designation"
                                type="text"
                                name="designation"
                                value="{{ old('designation', $team->designation) }}"
                                required
                                placeholder="e.g., Senior Developer"
                                class="w-full"
                            />
                            @error('designation')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <flux:label for="email" class="text-zinc-700 dark:text-zinc-300 font-medium">Email Address</flux:label>
                        <flux:input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email', $team->email) }}"
                            placeholder="email@example.com"
                            class="w-full"
                        />
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Social Links Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="share" class="w-5 h-5 text-blue-600 dark:text-blue-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Social Media Links</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <flux:label for="facebook" class="text-zinc-700 dark:text-zinc-300 font-medium">Facebook</flux:label>
                            <flux:input
                                id="facebook"
                                type="url"
                                name="facebook"
                                value="{{ old('facebook', $team->facebook) }}"
                                placeholder="https://facebook.com/username"
                                class="w-full"
                            />
                        </div>

                        <div class="space-y-2">
                            <flux:label for="twitter" class="text-zinc-700 dark:text-zinc-300 font-medium">Twitter</flux:label>
                            <flux:input
                                id="twitter"
                                type="url"
                                name="twitter"
                                value="{{ old('twitter', $team->twitter) }}"
                                placeholder="https://twitter.com/username"
                                class="w-full"
                            />
                        </div>

                        <div class="space-y-2">
                            <flux:label for="instagram" class="text-zinc-700 dark:text-zinc-300 font-medium">Instagram</flux:label>
                            <flux:input
                                id="instagram"
                                type="url"
                                name="instagram"
                                value="{{ old('instagram', $team->instagram) }}"
                                placeholder="https://instagram.com/username"
                                class="w-full"
                            />
                        </div>

                        <div class="space-y-2">
                            <flux:label for="linkedin" class="text-zinc-700 dark:text-zinc-300 font-medium">LinkedIn</flux:label>
                            <flux:input
                                id="linkedin"
                                type="url"
                                name="linkedin"
                                value="{{ old('linkedin', $team->linkedin) }}"
                                placeholder="https://linkedin.com/in/username"
                                class="w-full"
                            />
                        </div>

                        <div class="space-y-2">
                            <flux:label for="github" class="text-zinc-700 dark:text-zinc-300 font-medium">GitHub</flux:label>
                            <flux:input
                                id="github"
                                type="url"
                                name="github"
                                value="{{ old('github', $team->github) }}"
                                placeholder="https://github.com/username"
                                class="w-full"
                            />
                        </div>
                    </div>
                </div>

                <!-- Photo Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="photo" class="w-5 h-5 text-purple-600 dark:text-purple-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Profile Photo</h4>
                    </div>

                    <x-image-uploader
                        name="images"
                        label="Upload Photo"
                        description="Click to select and upload photos for the team member"
                        :existingImages="$team->images->map(fn($img) => [
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

                <!-- Configuration Section -->
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <flux:icon name="cog-6-tooth" class="w-5 h-5 text-green-600 dark:text-green-400" />
                        <h4 class="text-lg font-medium text-zinc-900 dark:text-white">Status</h4>
                    </div>

                    <div class="space-y-2">
                        <flux:label for="status" required class="text-zinc-700 dark:text-zinc-300 font-medium">Member Status</flux:label>
                        <x-toggle-switch :status="$team->status" name="status" />
                        @error('status')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
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
                            onclick="window.location.href='{{ route('teams.index') }}'"
                            class="px-6"
                        >
                            <flux:icon name="x-mark" class="w-4 h-4 mr-2" />
                            Cancel
                        </flux:button>
                        <flux:button type="submit" variant="primary" class="px-6 flex items-center flex-row gap-2">
                            <flux:icon name="check" class="w-4 h-4" />
                            Update Member
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

