<div class="w-full">
    <!-- Tags Container -->
    <div class="relative flex flex-wrap items-start gap-2 p-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-white/10 focus-within:ring-2 focus-within:ring-black dark:focus-within:ring-white focus-within:border-white dark:focus-within:border-white transition-all duration-200">

        <!-- Display Tags -->
        @foreach ($tags as $index => $tag)
            <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-accent/10 text-accent dark:text-accent text-sm font-medium rounded-full border border-accent dark:border-accent-700 hover:bg-accent-100 dark:hover:bg-accent-900/50 transition-colors duration-150">
                <span class="truncate max-w-[120px]">{{ $tag }}</span>
                <button
                    type="button"
                    wire:click="removeTag({{ $index }})"
                    class="flex-shrink-0 ml-1 text-accent-500 dark:text-accent-400 hover:text-accent-700 dark:hover:text-accent-200 focus:outline-none focus:ring-1 focus:ring-accent-300 dark:focus:ring-accent-600 rounded-full p-0.5 transition-colors duration-150"
                    title="Remove tag"
                >
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </span>
        @endforeach

        <!-- Input Field -->
        <input
            type="text"
            wire:model.live="input"
            wire:keydown.enter.prevent="addTag"
            wire:keydown.comma.prevent="addTag"
            class="flex-1 min-w-[120px] border-none outline-none text-sm bg-transparent text-zinc-900 dark:text-zinc-100 placeholder-zinc-500 dark:placeholder-zinc-400 py-1"
            placeholder="{{ count($tags) >= $maxTags ? 'Maximum tags reached' : 'Add tags (press Enter or comma)' }}"
            @if(count($tags) >= $maxTags) disabled @endif
        />
    </div>

    <!-- Helper Text -->
    <div class="flex justify-between items-center mt-2">
        <div class="flex items-center gap-4 text-xs text-zinc-500 dark:text-zinc-400">
            <span>{{ count($tags) }}/{{ $maxTags }} tags</span>
            <span>Max {{ $maxTagLength }} chars per tag</span>
        </div>

        @if(count($tags) > 0)
            <button
                type="button"
                wire:click="$set('tags', [])"
                class="text-xs text-red-500 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium transition-colors duration-150"
            >
                Clear all
            </button>
        @endif
    </div>

    <!-- Hidden Input for Form Submission -->
    <input
        type="hidden"
        name="tags"
        value="{{ implode(',', $tags) }}"
    />

    <!-- Error Messages -->
    <div class="mt-2 space-y-1">
        @error('tags')
            <div class="flex items-center gap-2 text-red-600 dark:text-red-400 text-sm">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ $message }}
            </div>
        @enderror

        @error('input')
            <div class="flex items-center gap-2 text-red-600 dark:text-red-400 text-sm">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
