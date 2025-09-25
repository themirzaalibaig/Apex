<flux:modal name="service-view" variant="flyout" class="flex flex-col w-full rounded-lg shadow-xl p-0!">
    @if($service)
        <!-- Header -->
        <div class="flex-shrink-0 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 rounded-t-lg">
            <flux:heading size="lg" class="flex items-center">
                <flux:icon name="briefcase" class="mr-2 bg-accent text-accent-foreground rounded-md p-1" />
                {{ $service->name }}
            </flux:heading>
            <flux:text class="mt-1">Service Details</flux:text>
        </div>

        <!-- Scrollable Body -->
        <div class="flex-1 overflow-y-auto px-6 py-4 scrollbar-thin">
            <div class="space-y-6">
                <!-- Service Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <flux:heading size="sm" class="mb-2">Basic Information</flux:heading>
                        <div class="space-y-3">
                            <div>
                                <flux:text class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Name</flux:text>
                                <flux:text class="text-sm text-zinc-900 dark:text-white">{{ $service->name }}</flux:text>
                            </div>
                            <div>
                                <flux:text class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Slug</flux:text>
                                <flux:text class="text-sm text-zinc-900 dark:text-white">{{ $service->slug }}</flux:text>
                            </div>
                            <div>
                                <flux:text class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Status</flux:text>
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
                            </div>
                        </div>
                    </div>

                    <div>
                        <flux:heading size="sm" class="mb-2">Additional Details</flux:heading>
                        <div class="space-y-3">
                            <div>
                                <flux:text class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Created</flux:text>
                                <flux:text class="text-sm text-zinc-900 dark:text-white">{{ $service->created_at->format('M d, Y H:i') }}</flux:text>
                            </div>
                            <div>
                                <flux:text class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Updated</flux:text>
                                <flux:text class="text-sm text-zinc-900 dark:text-white">{{ $service->updated_at->format('M d, Y H:i') }}</flux:text>
                            </div>
                            <div>
                                <flux:text class="text-sm font-medium text-zinc-500 dark:text-zinc-400">Images</flux:text>
                                <flux:text class="text-sm text-zinc-900 dark:text-white">{{ $service->images->count() }} image(s)</flux:text>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                @if($service->description)
                    <div>
                        <flux:heading size="sm" class="mb-2">Description</flux:heading>
                        <div class="bg-zinc-50 dark:bg-zinc-800 rounded-lg p-4">
                            <flux:text class="text-sm text-zinc-900 dark:text-white whitespace-pre-wrap">{{ $service->description }}</flux:text>
                        </div>
                    </div>
                @endif

                <!-- Tags -->
                @if($service->tags)
                    <div>
                        <flux:heading size="sm" class="mb-2">Tags</flux:heading>
                        <div class="flex flex-wrap gap-2">
                            @foreach(collect(explode(',', $service->tags))->filter() as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                    {{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Images -->
                @if($service->images->count() > 0)
                    <div>
                        <flux:heading size="sm" class="mb-2">Images</flux:heading>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($service->images as $image)
                                <div class="aspect-square bg-zinc-100 dark:bg-zinc-800 rounded-lg overflow-hidden">
                                    <img src="{{ $image->url }}" alt="{{ $service->name }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sticky Footer -->
        <div class="flex-shrink-0 px-6 py-4 border-t border-zinc-200 dark:border-zinc-700 rounded-b-lg flex justify-end space-x-3">
            <flux:button variant="outline" x-on:click="$flux.modals().close()">Close</flux:button>
        </div>
    @endif
</flux:modal>
