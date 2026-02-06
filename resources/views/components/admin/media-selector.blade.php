@props([
    'name' => 'media_usages',
    'selected' => [],
    'multiple' => true,
    'label' => 'Select Media',
    'description' => 'Choose existing media or upload new'
])

@php
    $componentId = uniqid('media_selector_');
@endphp

<div class="w-full media-selector-component" data-component-id="{{ $componentId }}">
    <div class="flex items-center justify-between mb-4">
        <div>
            <div class="text-sm font-semibold text-zinc-900 dark:text-white">{{ $label }}</div>
            <div class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">{{ $description }}</div>
        </div>
        <flux:button size="sm" icon="photo" onclick="window.mediaLibrary.openPicker({
            multiple: {{ $multiple ? 'true' : 'false' }},
            preselected: window.mediaLibrary.selectors['{{ $componentId }}'].state.selected.map(item => item.upload_id),
            onSelect: (uploads) => {
                const selector = window.mediaLibrary.selectors['{{ $componentId }}'];
                selector.state.selected = uploads.map(upload => ({
                    upload_id: upload.id,
                    url: upload.url,
                    file_name: upload.file_name,
                    seo_alt_text: upload.seo_alt_text || '',
                    type: selector.state.selected.find(s => s.upload_id === upload.id)?.type || ''
                }));
                selector.renderSelected();
            }
        })">
            Browse Library
        </flux:button>
    </div>

    {{-- Selected Items Grid --}}
    <div class="selected-list grid grid-cols-1 gap-3"></div>
</div>

@once
    {{-- Main Modal --}}
    <div id="media-selector-modal" class="fixed inset-0 z-50 hidden" role="dialog" aria-modal="true">
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-zinc-800/75 backdrop-blur-sm transition-opacity" onclick="window.mediaLibrary.close()"></div>

        {{-- Modal Panel --}}
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-xl bg-white dark:bg-zinc-900 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-5xl border border-zinc-200 dark:border-zinc-800">
                    
                    {{-- Header --}}
                    <div class="flex items-center justify-between px-6 py-4 border-b border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-900/50">
                        <div>
                            <h3 class="text-base font-semibold leading-6 text-zinc-900 dark:text-white flex items-center gap-2">
                                <flux:icon name="photo" class="w-5 h-5 text-zinc-500" />
                                Media Library
                            </h3>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-0.5">Select files or upload new ones.</p>
                        </div>
                        <button type="button" class="text-zinc-400 hover:text-zinc-500 dark:hover:text-zinc-300" onclick="window.mediaLibrary.close()">
                            <span class="sr-only">Close</span>
                            <flux:icon name="x-mark" class="w-5 h-5" />
                        </button>
                    </div>

                    {{-- Body --}}
                    <div class="p-6">
                        {{-- Tabs --}}
                        <div class="flex items-center gap-4 border-b border-zinc-200 dark:border-zinc-800 mb-6">
                            <button type="button" class="tab-btn active px-4 py-2 text-sm font-medium border-b-2 border-indigo-600 text-indigo-600 dark:text-indigo-400" data-tab="library">
                                Library
                            </button>
                            <button type="button" class="tab-btn px-4 py-2 text-sm font-medium border-b-2 border-transparent text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-300" data-tab="upload">
                                Upload New
                            </button>
                        </div>

                        {{-- Library Tab --}}
                        <div id="tab-library" class="tab-content block">
                            <div class="mb-4">
                                <flux:input icon="magnifying-glass" id="media-search" placeholder="Search by name, url, or alt text..." />
                            </div>

                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4 overflow-y-auto max-h-[50vh] min-h-[300px] p-1" id="media-list">
                                {{-- Items injected via JS --}}
                            </div>
                        </div>

                        {{-- Upload Tab --}}
                        <div id="tab-upload" class="tab-content hidden">
                            <form id="media-upload-form" class="space-y-6">
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                    {{-- Left: Upload --}}
                                    <div class="space-y-4">
                                        <flux:heading size="sm">File Source</flux:heading>
                                        
                                        {{-- Drag & Drop Zone --}}
                                        <div 
                                            class="upload-dropzone group relative flex justify-center rounded-xl border-2 border-dashed border-zinc-200 dark:border-zinc-700 px-6 py-12 transition-all hover:border-indigo-500 hover:bg-indigo-50/50 dark:hover:bg-indigo-900/10 cursor-pointer"
                                            onclick="document.getElementById('file-upload').click()"
                                        >
                                            <div class="text-center">
                                                <div class="mx-auto h-12 w-12 text-zinc-300 dark:text-zinc-600 group-hover:text-indigo-500 transition-colors">
                                                    <flux:icon name="cloud-arrow-up" class="w-full h-full" />
                                                </div>
                                                <div class="mt-4 flex text-sm leading-6 text-zinc-600 dark:text-zinc-400 justify-center">
                                                    <label for="file-upload" class="relative cursor-pointer rounded-md font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                                                        <span>Upload a file</span>
                                                        <input id="file-upload" name="uploads[]" type="file" class="sr-only" accept="image/*" multiple>
                                                    </label>
                                                    <p class="pl-1">or drag and drop</p>
                                                </div>
                                                <p class="text-xs leading-5 text-zinc-500 dark:text-zinc-500 mt-1">PNG, JPG, GIF up to 10MB</p>
                                            </div>
                                            
                                            {{-- Preview Area (Hidden by default) --}}
                                            <div id="upload-preview" class="hidden absolute inset-0 z-10 bg-white dark:bg-zinc-900 flex-col items-center justify-center rounded-xl">
                                                <img src="" alt="Preview" class="h-32 w-auto object-contain mb-2 rounded shadow-sm" />
                                                <p class="text-xs text-zinc-500 file-name truncate max-w-[80%]"></p>
                                                <button type="button" class="absolute top-2 right-2 text-zinc-400 hover:text-red-500" onclick="window.mediaLibrary.clearUpload()">
                                                    <flux:icon name="x-circle" class="w-5 h-5" />
                                                </button>
                                            </div>
                                        </div>

                                        <div class="relative">
                                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                                <div class="w-full border-t border-zinc-200 dark:border-zinc-700"></div>
                                            </div>
                                            <div class="relative flex justify-center">
                                                <span class="bg-white dark:bg-zinc-900 px-2 text-xs text-zinc-500">OR</span>
                                            </div>
                                        </div>

                                        <flux:textarea name="external_urls" placeholder="Enter external URL..." rows="3" />
                                    </div>

                                    {{-- Right: Metadata --}}
                                    <div class="space-y-4">
                                        <flux:heading size="sm">Metadata (Optional)</flux:heading>
                                        
                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <flux:input name="file_name" placeholder="File Name" />
                                            <flux:input name="seo_alt_text" placeholder="Alt Text" />
                                        </div>
                                        
                                        <flux:input name="seo_meta_title" placeholder="Meta Title" />
                                        <flux:textarea name="seo_meta_description" placeholder="Meta Description" rows="2" />
                                        
                                        <div class="space-y-2">
                                            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">Tags</label>
                                            <div class="tags-input min-h-[42px] w-full rounded-lg border border-zinc-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 px-3 py-2 shadow-sm focus-within:ring-2 focus-within:ring-indigo-600" data-target="modal_seo_meta_keywords"></div>
                                            <input type="hidden" name="seo_meta_keywords" id="modal_seo_meta_keywords" value="[]">
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end pt-4 border-t border-zinc-100 dark:border-zinc-800">
                                    <flux:button type="submit" variant="primary" icon="cloud-arrow-up">Upload & Select</flux:button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="bg-zinc-50 dark:bg-zinc-900/50 px-6 py-4 flex items-center justify-between border-t border-zinc-200 dark:border-zinc-800">
                        <div class="text-xs text-zinc-500 dark:text-zinc-400" id="selection-count">
                            0 selected
                        </div>
                        <div class="flex items-center gap-3">
                            <flux:button variant="subtle" onclick="window.mediaLibrary.close()">Cancel</flux:button>
                            <flux:button variant="primary" onclick="window.mediaLibrary.confirmSelection()">Add Selected</flux:button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    window.mediaLibrary = window.mediaLibrary || {
        uploads: @json($availableUploads),
        selectors: {},
        active: null,
        _initialized: false,
        
        init() {
            if (this._initialized) {
                return;
            }
            this._initialized = true;
            // Tab Switching
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('.tab-btn').forEach(b => {
                        b.classList.remove('border-indigo-600', 'text-indigo-600', 'dark:text-indigo-400');
                        b.classList.add('border-transparent', 'text-zinc-500', 'dark:text-zinc-400');
                    });
                    btn.classList.remove('border-transparent', 'text-zinc-500', 'dark:text-zinc-400');
                    btn.classList.add('border-indigo-600', 'text-indigo-600', 'dark:text-indigo-400');
                    
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
                    document.getElementById(`tab-${btn.dataset.tab}`).classList.remove('hidden');
                });
            });

            // File Upload Preview
            const fileInput = document.getElementById('file-upload');
            const dropZone = document.querySelector('.upload-dropzone');
            
            if (dropZone) {
                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    dropZone.addEventListener(eventName, highlight, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, unhighlight, false);
                });

                function highlight(e) {
                    dropZone.classList.add('border-indigo-500', 'bg-indigo-50/50', 'dark:bg-indigo-900/10');
                }

                function unhighlight(e) {
                    dropZone.classList.remove('border-indigo-500', 'bg-indigo-50/50', 'dark:bg-indigo-900/10');
                }

                dropZone.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;
                    fileInput.files = files;
                    handleFiles(files);
                }
            }

            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    handleFiles(this.files);
                });
            }

            function handleFiles(files) {
                if (files.length > 0) {
                    const file = files[0];
                    const preview = document.getElementById('upload-preview');
                    const img = preview.querySelector('img');
                    const name = preview.querySelector('.file-name');
                    
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            img.src = e.target.result;
                            name.textContent = file.name;
                            preview.classList.remove('hidden');
                            preview.classList.add('flex');
                        };
                        reader.readAsDataURL(file);
                    }
                }
            }
        },

        clearUpload() {
            const fileInput = document.getElementById('file-upload');
            if (fileInput) fileInput.value = '';
            const preview = document.getElementById('upload-preview');
            if (preview) {
                preview.classList.add('hidden');
                preview.classList.remove('flex');
            }
        },

        openPicker(config) {
            this.active = {
                multiple: config.multiple,
                preselected: new Set(config.preselected || []),
                onSelect: config.onSelect
            };
            this.renderList();
            this.updateSelectionCount();
            document.getElementById('media-selector-modal').classList.remove('hidden');
            // Reset to library tab
            document.querySelector('[data-tab="library"]').click();
        },

        close() {
            document.getElementById('media-selector-modal').classList.add('hidden');
            this.active = null;
        },

        renderList(filter = '') {
            const list = document.getElementById('media-list');
            list.innerHTML = '';
            
            const filtered = this.uploads.filter(u => {
                const hay = `${u.file_name} ${u.url} ${u.seo_alt_text || ''}`.toLowerCase();
                return hay.includes(filter.toLowerCase());
            });

            if (filtered.length === 0) {
                list.innerHTML = `
                    <div class="col-span-full flex flex-col items-center justify-center py-12 text-zinc-400">
                        <flux:icon name="photo" class="w-12 h-12 mb-2 opacity-50" />
                        <p class="text-sm">No media found matching your search.</p>
                    </div>
                `;
                return;
            }

            filtered.forEach(upload => {
                const isSelected = this.active && this.active.preselected.has(upload.id);
                const card = document.createElement('div');
                card.className = `
                    group relative aspect-square rounded-xl overflow-hidden cursor-pointer border-2 transition-all duration-200
                    ${isSelected ? 'border-indigo-600 ring-2 ring-indigo-600 ring-offset-2 dark:ring-offset-zinc-900' : 'border-zinc-200 dark:border-zinc-800 hover:border-indigo-400'}
                `;
                
                card.innerHTML = `
                    <div class="w-full h-full bg-zinc-100 dark:bg-zinc-900">
                        <img src="${upload.url}" alt="${upload.seo_alt_text || ''}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    </div>
                    
                    ${isSelected ? `
                        <div class="absolute inset-0 bg-indigo-600/20 z-10 flex items-center justify-center">
                            <div class="bg-indigo-600 text-white rounded-full p-1 shadow-lg transform scale-100 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    ` : ''}
                    
                    <div class="absolute bottom-0 inset-x-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent p-3 translate-y-full group-hover:translate-y-0 transition-transform duration-200">
                        <p class="text-xs text-white truncate font-medium">${upload.file_name}</p>
                        <p class="text-[10px] text-zinc-300 truncate opacity-80">${upload.width}x${upload.height} • ${upload.size_formatted}</p>
                    </div>
                `;

                card.onclick = () => this.toggleSelection(upload.id, card);
                list.appendChild(card);
            });
        },

        toggleSelection(id, cardElement) {
            if (!this.active) return;

            if (this.active.multiple) {
                if (this.active.preselected.has(id)) {
                    this.active.preselected.delete(id);
                } else {
                    this.active.preselected.add(id);
                }
            } else {
                this.active.preselected.clear();
                this.active.preselected.add(id);
            }
            
            this.renderList(document.getElementById('media-search').value);
            this.updateSelectionCount();
        },

        updateSelectionCount() {
            if (!this.active) return;
            const count = this.active.preselected.size;
            const el = document.getElementById('selection-count');
            el.textContent = `${count} selected`;
            el.className = count > 0 ? 'text-indigo-600 dark:text-indigo-400 font-medium text-xs' : 'text-zinc-500 dark:text-zinc-400 text-xs';
        },

        confirmSelection() {
            if (!this.active) return;
            const selected = this.uploads.filter(u => this.active.preselected.has(u.id));
            this.active.onSelect(selected);
            this.close();
        }
    };

function initMediaLibrary() {
        if (!window.mediaLibrary) return;
        window.mediaLibrary._initialized = false;
        window.mediaLibrary.init();

        const search = document.getElementById('media-search');
        if (search) {
            search.addEventListener('input', (e) => window.mediaLibrary.renderList(e.target.value));
        }

        const uploadForm = document.getElementById('media-upload-form');
        if (uploadForm) {
            uploadForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const btn = uploadForm.querySelector('button[type=\"submit\"]');
                const originalText = btn.innerHTML;
                btn.disabled = true;
                btn.innerHTML = 'Uploading...';

                try {
                    const formData = new FormData(uploadForm);
                    const csrf = document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content');
                    const res = await fetch('{{ route('media.store') }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' },
                        body: formData
                    });
                    
                    if (res.ok) {
                        const data = await res.json();
                        data.uploads.forEach(u => {
                            window.mediaLibrary.uploads.unshift(u);
                            if (window.mediaLibrary.active) {
                                if (!window.mediaLibrary.active.multiple) {
                                    window.mediaLibrary.active.preselected.clear();
                                }
                                window.mediaLibrary.active.preselected.add(u.id);
                            }
                        });
                        
                        uploadForm.reset();
                        window.mediaLibrary.clearUpload();
                        document.querySelector('[data-tab=\"library\"]').click();
                        window.mediaLibrary.renderList();
                        window.mediaLibrary.updateSelectionCount();
                    } else {
                        alert('Upload failed. Please check file size/type.');
                    }
                } catch (err) {
                    console.error('Upload failed:', err);
                    alert('Upload failed. Please try again.');
                } finally {
                    btn.disabled = false;
                    btn.innerHTML = originalText;
                }
            });
        }
    }

    document.addEventListener('DOMContentLoaded', initMediaLibrary);
    document.addEventListener('livewire:navigated', initMediaLibrary);
    </script>
@endonce

<script>
(function() {
    const componentId = '{{ $componentId }}';
    const container = document.querySelector(`[data-component-id="${componentId}"]`);
    if (!container) return;

    const state = {
        selected: @json($selected),
        multiple: {{ $multiple ? 'true' : 'false' }},
        name: @json($name)
    };

    function renderSelected() {
        const list = container.querySelector('.selected-list');
        list.innerHTML = '';
        
        state.selected.forEach((item, index) => {
            const card = document.createElement('div');
            card.className = 'group flex items-start gap-4 p-4 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-sm hover:shadow-md transition-all';
            
            card.innerHTML = `
                <div class="relative w-20 h-20 flex-shrink-0 bg-zinc-100 dark:bg-zinc-800 rounded-lg overflow-hidden border border-zinc-100 dark:border-zinc-700">
                    <img src="${item.url}" alt="${item.seo_alt_text || ''}" class="w-full h-full object-cover">
                </div>
                
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between mb-2">
                        <div>
                            <h4 class="text-sm font-medium text-zinc-900 dark:text-white truncate max-w-[200px]" title="${item.file_name}">${item.file_name}</h4>
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 truncate max-w-[200px]">${item.url}</p>
                        </div>
                        <button type="button" class="text-zinc-400 hover:text-red-500 transition-colors p-1 rounded-md hover:bg-zinc-100 dark:hover:bg-zinc-800" title="Remove">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-3 mt-3">
                        <div>
                            <label class="block text-[10px] font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider mb-1">Usage Type</label>
                            <input type="hidden" name="${state.name}[${index}][upload_id]" value="${item.upload_id}">
                            <input type="text" 
                                name="${state.name}[${index}][type]" 
                                value="${item.type || ''}" 
                                placeholder="e.g. hero, thumbnail"
                                class="block w-full rounded-md border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 text-xs py-1.5 px-2 focus:border-indigo-500 focus:ring-indigo-500 dark:text-white"
                            >
                        </div>
                        <div>
                             <label class="block text-[10px] font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider mb-1">Alt Text</label>
                             <input type="text" 
                                name="${state.name}[${index}][seo_alt_text]" 
                                value="${item.seo_alt_text || ''}" 
                                placeholder="SEO Alt Text"
                                class="block w-full rounded-md border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 text-xs py-1.5 px-2 focus:border-indigo-500 focus:ring-indigo-500 dark:text-white"
                            >
                        </div>
                    </div>
                </div>
            `;
            
            const removeBtn = card.querySelector('button[title="Remove"]');
            removeBtn.onclick = () => {
                if (confirm('Remove this media item?')) {
                    state.selected.splice(index, 1);
                    renderSelected();
                }
            };
            
            list.appendChild(card);
        });
    }

    window.mediaLibrary.selectors[componentId] = {
        state,
        renderSelected
    };

    renderSelected();
})();
</script>

