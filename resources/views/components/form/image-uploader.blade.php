{{-- Komponen Image Uploader dengan Drag-Drop --}}
@props([
    'name' => null,
    'label' => null,
    'accept' => 'image/*',
    'maxSize' => 5242880,
    'error' => null,
    'required' => false,
    'disabled' => false,
])

@php
    $uniqueId = 'uploader-' . uniqid();
    $maxSizeMB = round($maxSize / 1024 / 1024, 1);
@endphp

<div class="flex flex-col gap-2">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div x-data="imageUploaderComponent('{{ $uniqueId }}', {{ $maxSize }})" class="flex flex-col gap-2">
        <!-- Upload Area -->
        <div
            @dragover.prevent="isDragging = true"
            @dragleave.prevent="isDragging = false"
            @drop.prevent="handleDrop"
            @click="document.getElementById('{{ $uniqueId }}-input').click()"
            class="relative p-6 rounded-lg border-2 border-dashed transition-colors cursor-pointer {{ $error ? 'border-red-400 bg-red-50 dark:bg-red-900/10' : 'border-gray-300 dark:border-gray-600' }} {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
            :class="isDragging ? 'border-blue-500 bg-blue-50 dark:bg-blue-900/10' : 'hover:border-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/10'"
        >
            <input
                type="file"
                id="{{ $uniqueId }}-input"
                name="{{ $name }}"
                accept="{{ $accept }}"
                @change="handleFileSelect"
                class="hidden"
                {{ $disabled ? 'disabled' : '' }}
            />

            <div class="text-center">
                <p class="text-4xl mb-2">🖼️</p>
                <p class="font-semibold text-gray-900 dark:text-white mb-1">Drag & drop gambar di sini</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">atau klik untuk memilih file</p>
                <p class="text-xs text-gray-500 mt-2">Max. {{ $maxSizeMB }}MB</p>
            </div>
        </div>

        <!-- Image Preview -->
        <div x-show="previewUrl" class="flex gap-4 items-start">
            <div class="flex-1">
                <img :src="previewUrl" alt="Preview" class="max-w-xs h-40 rounded-lg object-cover border border-gray-200 dark:border-gray-700" />
            </div>
            <div class="flex-1">
                <p class="text-sm font-semibold text-gray-900 dark:text-white mb-2">File Info:</p>
                <p class="text-xs text-gray-600 dark:text-gray-400" x-text="'Nama: ' + fileName"></p>
                <p class="text-xs text-gray-600 dark:text-gray-400" x-text="'Ukuran: ' + fileSizeFormatted"></p>
                <p class="text-xs text-gray-600 dark:text-gray-400" x-text="'Tipe: ' + fileType"></p>

                <!-- Progress Bar -->
                <div x-show="isUploading" class="mt-3">
                    <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2 overflow-hidden">
                        <div class="bg-blue-500 h-2 rounded-full transition-all" :style="'width: ' + uploadProgress + '%'"></div>
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1" x-text="uploadProgress + '%'"></p>
                </div>

                <!-- Clear Button -->
                <button @click="clearPreview" type="button" class="mt-3 px-3 py-1 text-sm bg-red-500 text-white rounded hover:bg-red-600">
                    Hapus
                </button>
            </div>
        </div>

        <!-- Error Message -->
        @if($error)
            <p class="text-sm text-red-500 flex items-center gap-1">
                <span>⚠️</span>
                {{ $error }}
            </p>
        @endif

        <p x-show="errorMessage" class="text-sm text-red-500 flex items-center gap-1">
            <span>⚠️</span>
            <span x-text="errorMessage"></span>
        </p>
    </div>
</div>

<script>
function imageUploaderComponent(uniqueId, maxSize) {
    return {
        uniqueId,
        maxSize,
        isDragging: false,
        previewUrl: null,
        fileName: '',
        fileType: '',
        fileSizeFormatted: '',
        uploadProgress: 0,
        isUploading: false,
        errorMessage: '',

        handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) this.processFile(file);
        },

        handleDrop(event) {
            this.isDragging = false;
            const file = event.dataTransfer.files[0];
            if (file) this.processFile(file);
        },

        processFile(file) {
            this.errorMessage = '';

            if (!file.type.startsWith('image/')) {
                this.errorMessage = 'File harus berupa gambar!';
                return;
            }

            if (file.size > this.maxSize) {
                this.errorMessage = `Ukuran file terlalu besar (Max. ${Math.round(this.maxSize / 1024 / 1024)}MB)`;
                return;
            }

            this.fileName = file.name;
            this.fileType = file.type;
            this.fileSizeFormatted = this.formatFileSize(file.size);

            const reader = new FileReader();
            reader.onload = (e) => {
                this.previewUrl = e.target.result;
                this.simulateUpload();
            };
            reader.readAsDataURL(file);
        },

        simulateUpload() {
            this.isUploading = true;
            let progress = 0;

            const interval = setInterval(() => {
                progress += Math.random() * 30;
                this.uploadProgress = Math.min(progress, 100);

                if (this.uploadProgress >= 100) {
                    clearInterval(interval);
                    this.isUploading = false;
                    this.uploadProgress = 0;
                }
            }, 200);
        },

        clearPreview() {
            this.previewUrl = null;
            this.fileName = '';
            this.fileType = '';
            this.fileSizeFormatted = '';
            this.uploadProgress = 0;
            document.getElementById(this.uniqueId + '-input').value = '';
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 B';
            const k = 1024;
            const sizes = ['B', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }
    };
}
</script>
