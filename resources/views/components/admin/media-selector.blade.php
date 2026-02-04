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
    <div class="flex items-center justify-between mb-3">
        <div>
            <div class="text-sm font-medium text-zinc-900 dark:text-white">{{ $label }}</div>
            <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $description }}</div>
        </div>
        <button type="button" class="px-3 py-2 bg-zinc-100 dark:bg-zinc-700 rounded-lg text-sm" onclick="window.mediaLibrary.openPicker({
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
            Browse
        </button>
    </div>

    <div class="selected-list grid grid-cols-1 md:grid-cols-2 gap-3"></div>
</div>

@once
    <div id="media-selector-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden">
            <div class="flex items-center justify-between p-4 border-b border-zinc-200 dark:border-zinc-700">
                <h3 class="text-lg font-semibold text-zinc-900 dark:text-white">Media Library</h3>
                <button type="button" onclick="window.mediaLibrary.close()" class="text-zinc-500 hover:text-zinc-700">✕</button>
            </div>
            <div class="p-4 flex flex-col gap-4">
                <input type="text" id="media-search" placeholder="Search media" class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white">

                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 overflow-y-auto max-h-[40vh]" id="media-list"></div>

                <div class="flex items-center justify-end gap-3">
                    <button type="button" class="px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg" onclick="window.mediaLibrary.close()">Cancel</button>
                    <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-lg" onclick="window.mediaLibrary.confirmSelection()">Add Selected</button>
                </div>

                <div class="border-t border-zinc-200 dark:border-zinc-700 pt-4">
                    <h4 class="text-sm font-semibold text-zinc-900 dark:text-white mb-2">Upload New</h4>
                    <form id="media-upload-form" class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <input type="file" name="uploads[]" accept="image/*">
                        <input type="text" name="external_urls" placeholder="External URL">
                        <input type="text" name="file_name" placeholder="File name">
                        <input type="text" name="seo_alt_text" placeholder="Alt text">
                        <input type="text" name="seo_meta_title" placeholder="Meta title">
                        <input type="text" name="seo_meta_description" placeholder="Meta description">
                        <div class="md:col-span-2">
                            <div class="tags-input" data-target="modal_seo_meta_keywords"></div>
                            <input type="hidden" name="seo_meta_keywords" id="modal_seo_meta_keywords" value="[]">
                        </div>
                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    window.mediaLibrary = window.mediaLibrary || {
        uploads: @json($availableUploads),
        selectors: {},
        active: null,
        openPicker(config) {
            this.active = {
                multiple: config.multiple,
                preselected: new Set(config.preselected || []),
                onSelect: config.onSelect
            };
            this.renderList();
            document.getElementById('media-selector-modal').classList.remove('hidden');
            document.getElementById('media-selector-modal').classList.add('flex');
        },
        close() {
            document.getElementById('media-selector-modal').classList.add('hidden');
            document.getElementById('media-selector-modal').classList.remove('flex');
            this.active = null;
        },
        renderList(filter = '') {
            const list = document.getElementById('media-list');
            list.innerHTML = '';
            const filtered = this.uploads.filter(u => {
                const hay = `${u.file_name} ${u.url} ${u.seo_alt_text || ''}`.toLowerCase();
                return hay.includes(filter.toLowerCase());
            });
            filtered.forEach(upload => {
                const card = document.createElement('div');
                card.className = 'border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden cursor-pointer';
                card.innerHTML = `
                    <div class="aspect-square bg-zinc-100 dark:bg-zinc-900">
                        <img src="${upload.url}" alt="" class="object-cover w-full h-full">
                    </div>
                    <div class="p-2 text-xs truncate">${upload.file_name}</div>
                `;
                card.onclick = () => {
                    if (!this.active) return;
                    if (this.active.multiple) {
                        if (this.active.preselected.has(upload.id)) {
                            this.active.preselected.delete(upload.id);
                            card.classList.remove('ring-2', 'ring-blue-500');
                        } else {
                            this.active.preselected.add(upload.id);
                            card.classList.add('ring-2', 'ring-blue-500');
                        }
                    } else {
                        this.active.preselected = new Set([upload.id]);
                        Array.from(list.children).forEach(el => el.classList.remove('ring-2', 'ring-blue-500'));
                        card.classList.add('ring-2', 'ring-blue-500');
                    }
                };
                if (this.active && this.active.preselected.has(upload.id)) {
                    card.classList.add('ring-2', 'ring-blue-500');
                }
                list.appendChild(card);
            });
        },
        confirmSelection() {
            if (!this.active) return;
            const selected = this.uploads.filter(u => this.active.preselected.has(u.id));
            this.active.onSelect(selected);
            this.close();
        }
    };

    document.addEventListener('DOMContentLoaded', () => {
        const search = document.getElementById('media-search');
        if (search) {
            search.addEventListener('input', (e) => window.mediaLibrary.renderList(e.target.value));
        }

        const uploadForm = document.getElementById('media-upload-form');
        if (uploadForm) {
            uploadForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(uploadForm);
                const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const res = await fetch('{{ route('media.store') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest' },
                    body: formData
                });
                if (res.ok) {
                    const data = await res.json();
                    data.uploads.forEach(u => window.mediaLibrary.uploads.unshift(u));
                    uploadForm.reset();
                    window.mediaLibrary.renderList();
                }
            });
        }
    });

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

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.tags-input').forEach(initTagsInput);
    });
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
            card.className = 'flex items-center gap-3 border border-zinc-200 dark:border-zinc-700 rounded-lg p-2';
            card.innerHTML = `
                <img src="${item.url}" alt="" class="w-12 h-12 object-cover rounded">
                <div class="flex-1">
                    <div class="text-xs text-zinc-700 dark:text-zinc-300 truncate">${item.file_name}</div>
                    <input type="hidden" name="${state.name}[${index}][upload_id]" value="${item.upload_id}">
                    <input type="text" name="${state.name}[${index}][type]" value="${item.type || ''}" placeholder="type"
                        class="mt-1 w-full px-2 py-1 text-xs border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white">
                </div>
                <button type="button" class="text-red-500 text-xs">Remove</button>
            `;
            card.querySelector('button').onclick = () => {
                state.selected.splice(index, 1);
                renderSelected();
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
