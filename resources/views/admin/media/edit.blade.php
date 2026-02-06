@extends('components.layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Edit Media</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Update file details and SEO metadata.</p>
        </div>

        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm overflow-hidden">
            <form action="{{ route('media.update', $upload->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-6 sm:p-8">
                    {{-- Left Column: Preview --}}
                    <div class="lg:col-span-1 space-y-6">
                        <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-950 p-2 overflow-hidden shadow-sm">
                            <img src="{{ $upload->url }}" alt="{{ $upload->seo_alt_text ?? 'Preview' }}" class="w-full h-auto rounded-lg object-contain" />
                        </div>
                        
                        <div class="p-4 bg-zinc-50 dark:bg-zinc-900/50 rounded-lg border border-zinc-100 dark:border-zinc-800 space-y-3">
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-zinc-500">File Type</span>
                                <span class="text-xs font-medium uppercase text-zinc-700 dark:text-zinc-300">{{ pathinfo($upload->url, PATHINFO_EXTENSION) }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-zinc-500">Created</span>
                                <span class="text-xs font-medium text-zinc-700 dark:text-zinc-300">{{ $upload->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="pt-3 border-t border-zinc-200 dark:border-zinc-700">
                                <flux:checkbox name="is_active" label="Active" :checked="$upload->is_active" />
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <a href="{{ $upload->url }}" target="_blank" class="text-xs text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 hover:underline">
                                Open Original File &rarr;
                            </a>
                        </div>
                    </div>

                    {{-- Right Column: Form Fields --}}
                    <div class="lg:col-span-2 space-y-6">
                        <flux:heading size="lg">Details</flux:heading>

                        <div class="space-y-4">
                            <flux:input name="file_name" label="File Name" value="{{ $upload->file_name }}" />
                            <flux:input name="url" label="Public URL" value="{{ $upload->url }}" readonly copyable />
                        </div>

                        <div class="border-t border-zinc-100 dark:border-zinc-800 pt-6 space-y-4">
                            <flux:heading size="lg">SEO Metadata</flux:heading>
                            
                            <flux:input name="seo_alt_text" label="Alt Text" value="{{ $upload->seo_alt_text }}" />
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <flux:input name="seo_meta_title" label="Meta Title" value="{{ $upload->seo_meta_title }}" />
                                <flux:input name="seo_meta_description" label="Meta Description" value="{{ $upload->seo_meta_description }}" />
                            </div>

                            <div class="space-y-2">
                                <flux:label>Meta Keywords</flux:label>
                                <div class="tags-input min-h-[42px] w-full rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 px-3 py-2 shadow-sm focus-within:ring-2 focus-within:ring-indigo-600" data-target="seo_meta_keywords"></div>
                                <input type="hidden" name="seo_meta_keywords" id="seo_meta_keywords" value="{{ json_encode($upload->seo_meta_keywords ?? []) }}">
                                <flux:description>Press Enter or comma to add tags.</flux:description>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-between px-6 py-4 bg-zinc-50 dark:bg-zinc-900/50 border-t border-zinc-200 dark:border-zinc-800">
                     <form method="POST" action="{{ route('media.destroy', $upload->id) }}" onsubmit="return confirm('Are you sure you want to delete this file?');" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-sm text-red-600 hover:text-red-700 font-medium transition-colors">
                            Delete File
                        </button>
                    </form>
                    
                    <div class="flex items-center gap-3">
                        <flux:button href="{{ route('media.index') }}" variant="subtle">Cancel</flux:button>
                        <flux:button type="submit" variant="primary">Update Media</flux:button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
<script>
function initTagsInput(container) {
    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Add keyword...';
    input.className = 'outline-none bg-transparent text-sm text-zinc-900 dark:text-white placeholder-zinc-400 flex-1 min-w-[120px]';
    
    // Wrapper for tags and input
    const wrapper = document.createElement('div');
    wrapper.className = 'flex flex-wrap gap-2 items-center w-full';
    container.appendChild(wrapper);

    const hiddenId = container.getAttribute('data-target');
    const hiddenInput = document.getElementById(hiddenId);
    let tags = [];

    try {
        tags = JSON.parse(hiddenInput.value || '[]');
        // Handle case where it might be a comma-separated string if legacy
        if (typeof tags === 'string') tags = [tags];
    } catch (e) {
        tags = [];
    }

    function renderTags() {
        wrapper.querySelectorAll('.tag-item').forEach(el => el.remove());
        tags.forEach((tag, index) => {
            const tagEl = document.createElement('span');
            tagEl.className = 'tag-item inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-300 border border-indigo-100 dark:border-indigo-500/30';
            tagEl.textContent = tag;
            
            const remove = document.createElement('button');
            remove.type = 'button';
            remove.innerHTML = '&times;';
            remove.className = 'ml-1 hover:text-indigo-900 dark:hover:text-white focus:outline-none';
            remove.onclick = () => {
                tags.splice(index, 1);
                sync();
            };
            tagEl.appendChild(remove);
            wrapper.insertBefore(tagEl, input);
        });
        wrapper.appendChild(input);
    }

    function sync() {
        hiddenInput.value = JSON.stringify(tags);
        renderTags();
    }

    input.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ',') {
            e.preventDefault();
            const value = input.value.trim().replace(/,$/, '');
            if (value && !tags.includes(value)) {
                tags.push(value);
                input.value = '';
                sync();
            }
        } else if (e.key === 'Backspace' && !input.value && tags.length > 0) {
            tags.pop();
            sync();
        }
    });

    container.addEventListener('click', () => input.focus());
    renderTags();
}

function initMediaEdit() {
    document.querySelectorAll('.tags-input').forEach(initTagsInput);
}

document.addEventListener('DOMContentLoaded', initMediaEdit);
document.addEventListener('livewire:navigated', initMediaEdit);
</script>
@endpush
@endsection
