@props([
    'name' => 'images',
    'label' => 'Upload Images',
    'description' => 'Click to select and upload images',
    'existingImages' => []
])

@php
    $componentId = uniqid('uploader_');
@endphp

<div class="w-full image-uploader-component" data-component-id="{{ $componentId }}">
<script>
(function() {
    const componentId = '{{ $componentId }}';
    const container = document.querySelector(`[data-component-id="${componentId}"]`);

    const state = {
        showModal: false,
        selectedFiles: [],
        currentEditIndex: null,
        currentEditType: null, // 'new' or 'existing'
        imageName: '',
        imageAlt: '',
        imageTitle: '',
        imageCaption: '',
        imageKeywords: '',
        dragging: false,
        existingImages: {!! json_encode($existingImages) !!},
        imagesToDelete: [],
        existingImagesMetadata: {} // Track metadata changes for existing images
    };

    function getAllImages() {
        return [...state.existingImages, ...state.selectedFiles];
    }

    function render() {
        // Update upload button visibility
        const uploadBtn = container.querySelector('.upload-button-wrapper');
        const previewGrid = container.querySelector('.preview-grid-wrapper');

        if (getAllImages().length === 0) {
            if (uploadBtn) uploadBtn.style.display = 'block';
            if (previewGrid) previewGrid.style.display = 'none';
        } else {
            if (uploadBtn) uploadBtn.style.display = 'none';
            if (previewGrid) previewGrid.style.display = 'block';
        }

        // Render existing images
        renderExistingImages();

        // Render new images
        renderNewImages();

        // Update form data
        updateFormData();
        updateDeleteData();
    }

    function renderExistingImages() {
        const existingContainer = container.querySelector('.existing-images-grid');
        if (!existingContainer) return;

        existingContainer.innerHTML = '';
        state.existingImages.forEach((img, index) => {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${img.url}" alt="${img.alt || ''}" class="w-full h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center gap-2">
                    <button type="button" onclick="window.imageUploader_${componentId}.editExistingImage(${index})"
                        class="p-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors" title="Edit metadata">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>
                    <button type="button" onclick="window.imageUploader_${componentId}.removeExistingImage(${index})"
                        class="p-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors" title="Remove image">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="absolute top-2 left-2 px-2 py-1 bg-blue-500 text-white text-xs rounded">Existing</div>
            `;
            existingContainer.appendChild(div);
        });
    }

    function renderNewImages() {
        const newContainer = container.querySelector('.new-images-grid');
        if (!newContainer) return;

        newContainer.innerHTML = '';
        state.selectedFiles.forEach((img, index) => {
            const div = document.createElement('div');
            div.className = 'relative group';
            div.innerHTML = `
                <img src="${img.preview}" alt="${img.name}" class="w-full h-32 object-cover rounded-lg border border-zinc-200 dark:border-zinc-700">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center gap-2">
                    <button type="button" onclick="window.imageUploader_${componentId}.editImage(${index})"
                        class="p-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors" title="Edit metadata">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                    </button>
                    <button type="button" onclick="window.imageUploader_${componentId}.removeNewImage(${index})"
                        class="p-2 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors" title="Remove image">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
                <div class="absolute top-2 left-2 px-2 py-1 bg-green-500 text-white text-xs rounded">New</div>
            `;
            newContainer.appendChild(div);
        });
    }

    function handleFileSelect(event) {
        const files = Array.from(event.target.files);
        files.forEach(file => {
                if (file.type.startsWith('image/')) {
                addFile(file);
            }
        });
        event.target.value = '';
    }

    function addFile(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
            state.selectedFiles.push({
                file: file,
                preview: e.target.result,
                name: file.name.replace(/\.[^/.]+$/, ''),
                alt: '',
                title: '',
                caption: '',
                keywords: ''
            });
            render();
            };
            reader.readAsDataURL(file);
    }

    function removeNewImage(index) {
        state.selectedFiles.splice(index, 1);
        render();
    }

    function removeExistingImage(index) {
        const image = state.existingImages[index];
        state.imagesToDelete.push(image.id);
        state.existingImages.splice(index, 1);
        render();
    }

    function editImage(index) {
        const img = state.selectedFiles[index];
        state.imageName = img.name;
        state.imageAlt = img.alt;
        state.imageTitle = img.title;
        state.imageCaption = img.caption;
        state.imageKeywords = img.keywords;
        state.currentEditIndex = index;
        state.currentEditType = 'new';
        openModal();
    }

    function editExistingImage(index) {
        const img = state.existingImages[index];
        // Check if there are metadata updates for this image
        const metadata = state.existingImagesMetadata[img.id] || img;

        state.imageName = metadata.name || '';
        state.imageAlt = metadata.alt || '';
        state.imageTitle = metadata.title || '';
        state.imageCaption = metadata.caption || '';
        state.imageKeywords = metadata.keywords || '';
        state.currentEditIndex = index;
        state.currentEditType = 'existing';
        openModal();
    }

    function openModal() {
        const modal = container.querySelector('.metadata-modal');
        const preview = container.querySelector('.modal-preview');

        if (state.currentEditIndex !== null) {
            if (state.currentEditType === 'new' && state.selectedFiles[state.currentEditIndex]) {
                preview.src = state.selectedFiles[state.currentEditIndex].preview;
                preview.style.display = 'block';
            } else if (state.currentEditType === 'existing' && state.existingImages[state.currentEditIndex]) {
                preview.src = state.existingImages[state.currentEditIndex].url;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        } else {
            preview.style.display = 'none';
        }

        container.querySelector('#modal-imageName').value = state.imageName;
        container.querySelector('#modal-imageAlt').value = state.imageAlt;
        container.querySelector('#modal-imageTitle').value = state.imageTitle;
        container.querySelector('#modal-imageCaption').value = state.imageCaption;
        container.querySelector('#modal-imageKeywords').value = state.imageKeywords;

        modal.style.display = 'flex';
        state.showModal = true;
    }

    function closeModal() {
        const modal = container.querySelector('.metadata-modal');
        modal.style.display = 'none';
        state.showModal = false;
        state.currentEditIndex = null;
        state.currentEditType = null;
        resetForm();
    }

    function resetForm() {
        state.imageName = '';
        state.imageAlt = '';
        state.imageTitle = '';
        state.imageCaption = '';
        state.imageKeywords = '';
    }

    function saveMetadata() {
        state.imageName = container.querySelector('#modal-imageName').value.trim();
        state.imageAlt = container.querySelector('#modal-imageAlt').value.trim();
        state.imageTitle = container.querySelector('#modal-imageTitle').value.trim();
        state.imageCaption = container.querySelector('#modal-imageCaption').value.trim();
        state.imageKeywords = container.querySelector('#modal-imageKeywords').value.trim();

        // Validate required field
        if (!state.imageName) {
            alert('Please enter an image name');
            container.querySelector('#modal-imageName').focus();
            return;
        }

        if (state.currentEditIndex !== null) {
            if (state.currentEditType === 'new' && state.currentEditIndex < state.selectedFiles.length) {
                // Update new image metadata
                state.selectedFiles[state.currentEditIndex].name = state.imageName;
                state.selectedFiles[state.currentEditIndex].alt = state.imageAlt;
                state.selectedFiles[state.currentEditIndex].title = state.imageTitle;
                state.selectedFiles[state.currentEditIndex].caption = state.imageCaption;
                state.selectedFiles[state.currentEditIndex].keywords = state.imageKeywords;
            } else if (state.currentEditType === 'existing' && state.currentEditIndex < state.existingImages.length) {
                // Update existing image metadata
                const img = state.existingImages[state.currentEditIndex];
                state.existingImagesMetadata[img.id] = {
                    name: state.imageName,
                    alt: state.imageAlt,
                    title: state.imageTitle,
                    caption: state.imageCaption,
                    keywords: state.imageKeywords
                };
            }
        }
        closeModal();
        render();
    }

    function updateFormData() {
        const dt = new DataTransfer();
        state.selectedFiles.forEach(img => {
            dt.items.add(img.file);
        });

        const fileInput = container.querySelector('input[type="file"]');
        if (fileInput) {
            fileInput.files = dt.files;
        }

        const metadataContainer = container.querySelector('.metadata-inputs');
        metadataContainer.innerHTML = '';

        state.selectedFiles.forEach((img, index) => {
            metadataContainer.innerHTML += `
                <input type="text" name="imagesMetadata[${index}][name]" value="${img.name}" class="hidden">
                <input type="text" name="imagesMetadata[${index}][alt]" value="${img.alt}" class="hidden">
                <input type="text" name="imagesMetadata[${index}][title]" value="${img.title}" class="hidden">
                <textarea name="imagesMetadata[${index}][caption]" class="hidden">${img.caption}</textarea>
                <input type="text" name="imagesMetadata[${index}][keywords]" value="${img.keywords}" class="hidden">
            `;
        });
    }

    function updateDeleteData() {
        const deleteInput = container.querySelector('input[name="imagesToDelete"]');
        if (deleteInput) {
            deleteInput.value = JSON.stringify(state.imagesToDelete);
        }

        // Update existing images metadata
        const metadataContainer = container.querySelector('.existing-metadata-inputs');
        if (metadataContainer) {
            metadataContainer.innerHTML = '';

            Object.keys(state.existingImagesMetadata).forEach(imageId => {
                const metadata = state.existingImagesMetadata[imageId];
                metadataContainer.innerHTML += `
                    <input type="hidden" name="existingImagesMetadata[${imageId}][name]" value="${metadata.name}">
                    <input type="hidden" name="existingImagesMetadata[${imageId}][alt]" value="${metadata.alt}">
                    <input type="hidden" name="existingImagesMetadata[${imageId}][title]" value="${metadata.title}">
                    <textarea name="existingImagesMetadata[${imageId}][caption]" class="hidden">${metadata.caption}</textarea>
                    <input type="hidden" name="existingImagesMetadata[${imageId}][keywords]" value="${metadata.keywords}">
                `;
            });
        }
    }

    // Expose functions globally for this component
    window[`imageUploader_${componentId}`] = {
        handleFileSelect,
        removeNewImage,
        removeExistingImage,
        editImage,
        editExistingImage,
        saveMetadata,
        closeModal
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = container.querySelector('input[type="file"]');
        fileInput.addEventListener('change', handleFileSelect);
        render();
    });
})();
</script>
    <!-- Hidden Input Fields for Form Submission -->
    <input type="file" name="{{ $name }}[]" multiple accept="image/*" class="hidden file-input-main">
    <input type="hidden" name="imagesToDelete" value="">
    <div class="metadata-inputs"></div>
    <div class="existing-metadata-inputs"></div>

    <!-- Upload Button (shown when no images) -->
    <div class="upload-button-wrapper text-center">
        <button
            type="button"
            onclick="this.parentElement.parentElement.querySelector('.file-input-main').click()"
            class="w-full py-8 bg-white rounded-lg dark:bg-white/10 border-2 border-dashed border-white/20 hover:border-zinc-400 cursor-pointer transition-colors"
        >
            <div class="flex flex-col items-center gap-3">
                <flux:icon name="photo" class="w-8 h-8 text-zinc-500" />
                <div>
                    <div class="text-sm font-medium text-zinc-900 dark:text-white">{{ $label }}</div>
                    <div class="text-xs text-zinc-500 dark:text-zinc-400">{{ $description }}</div>
                </div>
            </div>
        </button>
    </div>

    <!-- Image Previews Grid -->
    <div class="preview-grid-wrapper space-y-4" style="display: none;">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            <!-- Existing Images Container -->
            <div class="existing-images-grid contents"></div>

            <!-- New Selected Images Container -->
            <div class="new-images-grid contents"></div>
            </div>

        <!-- Add More Images Button -->
        <div class="flex justify-center">
            <button
                                type="button"
                onclick="this.parentElement.parentElement.parentElement.querySelector('.file-input-main').click()"
                class="px-6 py-3 bg-white dark:bg-zinc-700 border-2 border-dashed border-zinc-300 dark:border-zinc-600 rounded-lg hover:border-zinc-400 dark:hover:border-zinc-500 transition-colors flex items-center gap-2"
            >
                <flux:icon name="plus" class="w-5 h-5 text-zinc-600 dark:text-zinc-400" />
                <span class="text-sm font-medium text-zinc-900 dark:text-white">Add More Images</span>
            </button>
                        </div>
                    </div>

    <!-- Modal for Editing Image Metadata -->
    <div class="metadata-modal fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4" style="display: none;">
        <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="mb-6">
                    <h3 class="text-xl font-semibold text-zinc-900 dark:text-white">Edit Image Metadata</h3>
                </div>

                <!-- Image Preview in Modal -->
                <div class="mb-6 text-center">
                        <img
                        src=""
                            alt="Preview"
                        class="modal-preview max-w-full max-h-48 mx-auto rounded-lg shadow-md"
                        style="display: none;"
                    >
                </div>

                <!-- Metadata Form -->
                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="modal-imageName" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                                Name <span class="text-red-500">*</span>
                            </label>
                            <input
                                type="text"
                                id="modal-imageName"
                                placeholder="Enter image name"
                                class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                        </div>

                        <div>
                            <label for="modal-imageAlt" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                                Alt Text
                            </label>
                            <input
                                type="text"
                                id="modal-imageAlt"
                                placeholder="Enter alt text for accessibility"
                                class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            />
                        </div>
                    </div>

                    <div>
                        <label for="modal-imageTitle" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Title
                        </label>
                        <input
                            type="text"
                            id="modal-imageTitle"
                            placeholder="Enter image title"
                            class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        />
                    </div>

                    <div>
                        <label for="modal-imageCaption" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Caption
                        </label>
                        <textarea
                            id="modal-imageCaption"
                            placeholder="Enter image caption"
                            rows="3"
                            class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        ></textarea>
                    </div>

                    <div>
                        <label for="modal-imageKeywords" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">
                            Keywords (comma-separated)
                        </label>
                        <input
                            type="text"
                            id="modal-imageKeywords"
                            placeholder="keyword1, keyword2, keyword3"
                            class="w-full px-3 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-900 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        />
                    </div>
                </div>

            <div class="flex justify-end gap-3 mt-8">
                    <button
                    type="button"
                        onclick="window.imageUploader_{{ $componentId }}.closeModal()"
                        class="px-4 py-2 border border-zinc-300 dark:border-zinc-600 rounded-lg text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors"
                >
                    Cancel
                    </button>

                    <button
                    type="button"
                        onclick="window.imageUploader_{{ $componentId }}.saveMetadata()"
                        class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg transition-colors flex items-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Save Metadata
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
