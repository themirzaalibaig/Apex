@props([
    'initialTags' => [],
    'maxTags' => 10,
    'maxTagLength' => 50,
    'name' => 'tags',
    'placeholder' => 'Add tags (press Enter or comma)'
])

<div
    x-data="{
        tags: @js($initialTags),
        input: '',
        maxTags: {{ $maxTags }},
        maxTagLength: {{ $maxTagLength }},

        addTag() {
            if (this.input.trim() && this.tags.length < this.maxTags) {
                const tag = this.input.trim().replace(/[,\s]+$/, '');
                if (tag && tag.length <= this.maxTagLength && !this.tags.includes(tag)) {
                    this.tags.push(tag);
                    this.input = '';
                    this.updateHiddenInput();
                }
            }
        },

        removeTag(index) {
            this.tags.splice(index, 1);
            this.updateHiddenInput();
        },

        clearAll() {
            this.tags = [];
            this.updateHiddenInput();
        },

        updateHiddenInput() {
            // Update the hidden input for form submission
            const hiddenInput = document.querySelector('input[name=\'{{ $name }}\']');
            if (hiddenInput) {
                hiddenInput.value = this.tags.join(',');
            }

            // Dispatch custom event for Livewire if needed
            this.$dispatch('tags-updated', { tags: this.tags });
        },

        handleKeydown(event) {
            if (event.key === 'Enter' || event.key === ',') {
                event.preventDefault();
                this.addTag();
            }
        }
    }"
    class="w-full"
>
    <!-- Tags Container -->
    <div class="relative flex flex-wrap items-start gap-2 p-3 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-white/10 focus-within:ring-2 focus-within:ring-black dark:focus-within:ring-white focus-within:border-white dark:focus-within:border-white transition-all duration-200 @error($name) ring-2 ring-red-500 @enderror">

        <!-- Display Tags -->
        <template x-for="(tag, index) in tags" :key="index">
            <span class="inline-flex items-center gap-1 px-3 py-1.5 bg-accent/10 text-accent dark:text-accent text-sm font-medium rounded-full border border-accent dark:border-accent-700 hover:bg-accent-100 dark:hover:bg-accent-900/50 transition-colors duration-150">
                <span class="truncate max-w-[120px]" x-text="tag"></span>
                <button
                    type="button"
                    @click="removeTag(index)"
                    class="flex-shrink-0 ml-1 text-accent-500 dark:text-accent-400 hover:text-accent-700 dark:hover:text-accent-200 focus:outline-none focus:ring-1 focus:ring-accent-300 dark:focus:ring-accent-600 rounded-full p-0.5 transition-colors duration-150"
                    title="Remove tag"
                >
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </span>
        </template>

        <!-- Input Field -->
        <input
            type="text"
            x-model="input"
            @keydown="handleKeydown"
            class="flex-1 min-w-[120px] border-none outline-none text-sm bg-transparent text-zinc-900 dark:text-zinc-100 placeholder-zinc-500 dark:placeholder-zinc-400 py-1"
            :placeholder="tags.length >= maxTags ? 'Maximum tags reached' : '{{ $placeholder }}'"
            :disabled="tags.length >= maxTags"
        />
    </div>
    <!-- Hidden Input for Form Submission -->
    <input
        type="hidden"
        name="{{ $name }}"
        :value="tags.join(',')"
    />

    <!-- Error Display -->
    <div class="mt-2 space-y-1">
        @error($name)
            <div class="flex items-center gap-2 text-red-600 dark:text-red-400 text-sm">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                </svg>
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
