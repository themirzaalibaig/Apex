@extends('components.layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-lg border border-zinc-200 dark:border-zinc-700 overflow-hidden">
            <div class="m-6 px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-700/50">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-zinc-100 dark:bg-zinc-900/30 rounded-lg flex items-center justify-center">
                        <flux:icon name="photo" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Upload Media</h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400">Upload files or add external URLs</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Upload Files</label>
                    <input type="file" name="uploads[]" multiple accept="image/*" class="w-full" />
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">External URLs (one per line)</label>
                    <textarea name="external_urls" rows="3" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">File Name (optional)</label>
                        <input type="text" name="file_name" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Alt Text</label>
                        <input type="text" name="seo_alt_text" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white" />
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Meta Title</label>
                        <input type="text" name="seo_meta_title" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white" />
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Meta Description</label>
                        <input type="text" name="seo_meta_description" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white" />
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Meta Keywords</label>
                    <div class="tags-input" data-target="seo_meta_keywords"></div>
                    <input type="hidden" name="seo_meta_keywords" id="seo_meta_keywords" value="[]">
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-zinc-200 dark:border-zinc-700">
                    <flux:button type="button" variant="outline" onclick="window.location.href='{{ route('media.index') }}'">Cancel</flux:button>
                    <flux:button type="submit" variant="primary">Upload</flux:button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function initTagsInput(container) {
    const input = document.createElement('input');
    input.type = 'text';
    input.placeholder = 'Type and press Enter';
    input.className = 'w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white';
    container.appendChild(input);

    const hiddenId = container.getAttribute('data-target');
    const hiddenInput = document.getElementById(hiddenId);
    let tags = [];

    function renderTags() {
        container.querySelectorAll('.tag-item').forEach(el => el.remove());
        tags.forEach((tag, index) => {
            const tagEl = document.createElement('span');
            tagEl.className = 'tag-item inline-flex items-center gap-1 px-2 py-1 bg-zinc-100 dark:bg-zinc-700 text-xs rounded mr-2 mb-2';
            tagEl.textContent = tag;
            const remove = document.createElement('button');
            remove.type = 'button';
            remove.textContent = '×';
            remove.className = 'text-red-500';
            remove.onclick = () => {
                tags.splice(index, 1);
                sync();
            };
            tagEl.appendChild(remove);
            container.insertBefore(tagEl, input);
        });
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
        }
    });
}

document.querySelectorAll('.tags-input').forEach(initTagsInput);
</script>
@endpush
@endsection
