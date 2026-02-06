@extends('components.layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-zinc-900 dark:text-white tracking-tight">Upload Media</h1>
            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">Add new images or documents to your library.</p>
        </div>

        <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-800 shadow-sm overflow-hidden">
            <form action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="p-6 sm:p-8 space-y-8">
                    {{-- File Upload Section --}}
                    <div class="space-y-4">
                        <flux:heading size="lg">Files</flux:heading>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Drop Zone --}}
                            <div class="col-span-1">
                                <flux:field>
                                    <flux:label>Upload from Computer</flux:label>
                                    <div id="media-dropzone" class="mt-2 flex justify-center rounded-xl border-2 border-dashed border-zinc-200 dark:border-zinc-700 px-6 py-10 hover:border-indigo-500 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/10 transition-colors group cursor-pointer relative">
                                        <div class="text-center">
                                            <div class="mx-auto h-12 w-12 text-zinc-300 dark:text-zinc-600 group-hover:text-indigo-500 transition-colors">
                                                <flux:icon name="cloud-arrow-up" class="w-full h-full" />
                                            </div>
                                            <div class="mt-4 flex text-sm leading-6 text-zinc-600 dark:text-zinc-400">
                                                <span class="relative cursor-pointer rounded-md font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                    <span>Upload a file</span>
                                                    <input id="media-file-input" type="file" name="uploads[]" multiple accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                                                </span>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs leading-5 text-zinc-500 dark:text-zinc-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                        <p id="media-file-list" class="mt-2 text-xs text-zinc-500 dark:text-zinc-500 hidden"></p>
                                    </div>
                                </flux:field>
                            </div>

                            {{-- External URL --}}
                            <div class="col-span-1">
                                <flux:textarea 
                                    name="external_urls" 
                                    label="External URLs" 
                                    placeholder="https://example.com/image.jpg" 
                                    rows="6"
                                    description="Enter one URL per line to import from the web."
                                />
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-zinc-100 dark:border-zinc-800 pt-8 space-y-4">
                        <flux:heading size="lg">Metadata</flux:heading>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 -mt-3 mb-4">Optional SEO details for better visibility.</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <flux:input name="file_name" label="File Name" placeholder="Custom filename (optional)" />
                            <flux:input name="seo_alt_text" label="Alt Text" placeholder="Describe the image for accessibility" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <flux:input name="seo_meta_title" label="Meta Title" placeholder="SEO Title" />
                            <flux:input name="seo_meta_description" label="Meta Description" placeholder="SEO Description" />
                        </div>

                        {{-- Tags Input --}}
                        <div class="space-y-2">
                            <flux:label>Meta Keywords</flux:label>
                            <div class="tags-input min-h-[42px] w-full rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 px-3 py-2 shadow-sm focus-within:ring-2 focus-within:ring-indigo-600" data-target="seo_meta_keywords"></div>
                            <input type="hidden" name="seo_meta_keywords" id="seo_meta_keywords" value="[]">
                            <flux:description>Press Enter or comma to add tags.</flux:description>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-end gap-3 px-6 py-4 bg-zinc-50 dark:bg-zinc-900/50 border-t border-zinc-200 dark:border-zinc-800">
                    <flux:button href="{{ route('media.index') }}" variant="subtle">Cancel</flux:button>
                    <flux:button type="submit" variant="primary">Save Media</flux:button>
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
        // Ensure input is always last
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

    // Focus input when clicking container
    container.addEventListener('click', () => input.focus());
}

function initMediaCreate() {
    document.querySelectorAll('.tags-input').forEach(initTagsInput);

    const dropzone = document.getElementById('media-dropzone');
    const fileInput = document.getElementById('media-file-input');
    const fileList = document.getElementById('media-file-list');

    if (dropzone && fileInput) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
            });
        });

        ['dragenter', 'dragover'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => {
                dropzone.classList.add('border-indigo-500', 'bg-indigo-50/50', 'dark:bg-indigo-900/10');
            });
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropzone.addEventListener(eventName, () => {
                dropzone.classList.remove('border-indigo-500', 'bg-indigo-50/50', 'dark:bg-indigo-900/10');
            });
        });

        dropzone.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            fileInput.files = files;
            updateFileList(files, fileList);
        });

        fileInput.addEventListener('change', () => {
            updateFileList(fileInput.files, fileList);
        });
    }
}

function updateFileList(files, fileList) {
    if (!fileList) return;
    if (!files || files.length === 0) {
        fileList.classList.add('hidden');
        fileList.textContent = '';
        return;
    }
    fileList.classList.remove('hidden');
    fileList.textContent = `${files.length} file(s) selected`;
}

document.addEventListener('DOMContentLoaded', initMediaCreate);
document.addEventListener('livewire:navigated', initMediaCreate);
</script>
@endpush
@endsection
