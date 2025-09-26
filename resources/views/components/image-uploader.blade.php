@props([
    'name' => 'image',
    'label' => 'Upload Image',
    'description' => 'Click to select and upload an image'
])

<div
    x-data="{
        showModal: false,
        selectedFile: null,
        imagePreview: null,
        imageName: '',
        imageAlt: '',
        imageTitle: '',
        imageCaption: '',
        imageKeywords: '',
        dragging: false,

        openModal() {
            this.showModal = true;
        },

        closeModal() {
            this.showModal = false;
        },

        resetAll() {
            this.resetForm();
            // Clear form inputs
            const nameInput = document.querySelector('input[name=\'imageName\']');
            const altInput = document.querySelector('input[name=\'imageAlt\']');
            const titleInput = document.querySelector('input[name=\'imageTitle\']');
            const captionInput = document.querySelector('textarea[name=\'imageCaption\']');
            const keywordsInput = document.querySelector('input[name=\'imageKeywords\']');
            const fileInput = document.querySelector('input[name=\'{{ $name }}\']');

            if (nameInput) nameInput.value = '';
            if (altInput) altInput.value = '';
            if (titleInput) titleInput.value = '';
            if (captionInput) captionInput.value = '';
            if (keywordsInput) keywordsInput.value = '';
            if (fileInput) fileInput.value = '';
        },

        resetForm() {
            this.selectedFile = null;
            this.imagePreview = null;
            this.imageName = '';
            this.imageAlt = '';
            this.imageTitle = '';
            this.imageCaption = '';
            this.imageKeywords = '';
        },

        handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) {
                this.selectedFile = file;
                this.imageName = file.name.replace(/\.[^/.]+$/, ''); // Remove extension
                this.previewImage(file);
            }
        },

        handleDrop(event) {
            event.preventDefault();
            this.dragging = false;

            const files = event.dataTransfer.files;
            if (files.length > 0) {
                const file = files[0];
                if (file.type.startsWith('image/')) {
                    this.selectedFile = file;
                    this.imageName = file.name.replace(/\.[^/.]+$/, '');
                    this.previewImage(file);
                }
            }
        },

        previewImage(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                this.imagePreview = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        saveImage() {
            if (this.selectedFile) {
                // Update form inputs with the metadata
                const nameInput = document.querySelector('input[name=\'imageName\']');
                const altInput = document.querySelector('input[name=\'imageAlt\']');
                const titleInput = document.querySelector('input[name=\'imageTitle\']');
                const captionInput = document.querySelector('textarea[name=\'imageCaption\']');
                const keywordsInput = document.querySelector('input[name=\'imageKeywords\']');

                if (nameInput) nameInput.value = this.imageName;
                if (altInput) altInput.value = this.imageAlt;
                if (titleInput) titleInput.value = this.imageTitle;
                if (captionInput) captionInput.value = this.imageCaption;
                if (keywordsInput) keywordsInput.value = this.imageKeywords;

                // Dispatch custom event for parent components
                if (typeof this.$dispatch === 'function') {
                    this.$dispatch('image-selected', {
                        file: this.selectedFile,
                        name: this.imageName,
                        alt: this.imageAlt,
                        title: this.imageTitle,
                        caption: this.imageCaption,
                        keywords: this.imageKeywords,
                        preview: this.imagePreview
                    });
                }

                this.closeModal();
            }
        }
    }"
    class="w-full"
>
    <!-- Upload Button -->
    <div class="text-center">
        <button
            type="button"
            @click="openModal()"
            class="w-full py-8 bg-white rounded-lg dark:bg-white/10 border-2 border-dashed border-white/20 hover:border-zinc-400 cursor-pointer"
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

    <!-- Modal -->
    <flux:modal x-model="showModal">
        <div class="p-6">
            <div class="mb-6">
                <flux:heading size="lg">{{ $label }}</flux:heading>
            </div>
            <div class="space-y-6">
                <!-- Drag & Drop Area -->
                <div
                    x-show="!selectedFile"
                    @dragover.prevent="dragging = true"
                    @dragleave.prevent="dragging = false"
                    @drop.prevent="handleDrop($event)"
                    :class="dragging ? 'border-blue-500 bg-blue-50' : 'border-white/20'"
                    class="border-2 border-dashed rounded-lg p-8 text-center transition-colors"
                >
                    <input
                        type="file"
                        @change="handleFileSelect($event)"
                        accept="image/*"
                        class="hidden"
                        x-ref="fileInput"
                        name="{{ $name }}"
                    >

                    <div class="flex flex-col items-center gap-4">
                        <flux:icon name="photo" class="w-12 h-12 text-zinc-400" />

                        <div>
                            <p class="text-lg font-medium text-zinc-900 dark:text-white mb-2">
                                Drop your image here or click to browse
                            </p>
                            <p class="text-sm text-zinc-500 dark:text-zinc-400 mb-4">
                                PNG, JPG up to 2MB
                            </p>

                            <flux:button
                                type="button"
                                variant="outline"
                                @click="$refs.fileInput.click()"
                            >
                                <flux:icon name="photo" class="w-4 h-4 mr-2" />
                                Select Image
                            </flux:button>
                        </div>
                    </div>
                </div>

                <!-- Image Preview -->
                <div x-show="imagePreview" class="text-center">
                    <div class="relative inline-block group">
                        <img
                            :src="imagePreview"
                            alt="Preview"
                            class="max-w-full max-h-64 mx-auto rounded-lg shadow-md"
                        >
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black/50 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                            <flux:button
                                type="button"
                                variant="outline"
                                @click="$refs.fileInput.click()"
                                class="bg-white text-black hover:bg-gray-100"
                            >
                                <flux:icon name="photo" class="w-4 h-4 mr-2" />
                                Change Image
                            </flux:button>
                        </div>
                    </div>
                </div>

                <!-- Metadata Form -->
                <div x-show="selectedFile" class="space-y-4">
                    <div class="flex justify-between items-center">
                        <flux:heading size="md">Image Metadata</flux:heading>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <flux:label for="imageName" required>Name</flux:label>
                            <flux:input
                                id="imageName"
                                x-model="imageName"
                                placeholder="Enter image name"
                                required
                                name="imageName"
                            />
                        </div>

                        <div>
                            <flux:label for="imageAlt">Alt Text</flux:label>
                            <flux:input
                                id="imageAlt"
                                x-model="imageAlt"
                                placeholder="Enter alt text for accessibility"
                                name="imageAlt"
                            />
                        </div>
                    </div>

                    <div>
                        <flux:label for="imageTitle">Title</flux:label>
                        <flux:input
                            id="imageTitle"
                            x-model="imageTitle"
                            placeholder="Enter image title"
                            name="imageTitle"
                        />
                    </div>

                    <div>
                        <flux:label for="imageCaption">Caption</flux:label>
                        <flux:textarea
                            id="imageCaption"
                            x-model="imageCaption"
                            placeholder="Enter image caption"
                            rows="3"
                            name="imageCaption"
                        />
                    </div>

                    <div>
                        <flux:label for="imageKeywords">Keywords (comma-separated)</flux:label>
                        <flux:input
                            id="imageKeywords"
                            x-model="imageKeywords"
                            placeholder="keyword1, keyword2, keyword3"
                            name="imageKeywords"
                        />
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-3 mt-8">
                <flux:button
                    type="button"
                    variant="outline"
                    @click="resetAll(); closeModal()"
                >
                    Cancel
                </flux:button>

                <flux:button
                    type="button"
                    variant="primary"
                    @click="saveImage()"
                    x-show="selectedFile"
                >
                    <flux:icon name="check" class="w-4 h-4 mr-2" />
                    Save Image
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
