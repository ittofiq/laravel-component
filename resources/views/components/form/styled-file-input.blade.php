{{-- Komponen Styled File Input dengan Preview + Drag-Drop --}}
@props([
    'name' => null,
    'label' => null,
    'accept' => 'image/*',
    'multiple' => false,
    'maxSize' => 5, // MB
    'preview' => true,
    'required' => false,
    'disabled' => false,
])

@php $uniqueId = 'file-' . uniqid(); @endphp

<div class="flex flex-col gap-2" x-data="styledFileInput('{{ $uniqueId }}', {{ $maxSize }})" data-multiple="{{ $multiple ? '1' : '0' }}">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    {{-- Drop Zone --}}
    <div
        @dragover.prevent="isDragging = true"
        @dragleave.prevent="isDragging = false"
        @drop.prevent="handleDrop($event)"
        class="relative border-2 border-dashed rounded-xl transition-all duration-200"
        :class="{
            'border-blue-400 bg-blue-50 dark:bg-blue-900/20': isDragging,
            'border-gray-300 dark:border-gray-600': !isDragging && files.length === 0,
            'border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50': files.length > 0,
            'opacity-60 cursor-not-allowed': {{ $disabled ? 'true' : 'false' }}
        }"
    >
        <input
            type="file"
            id="{{ $uniqueId }}"
            name="{{ $name }}{{ $multiple ? '[]' : '' }}"
            accept="{{ $accept }}"
            @change="handleFileSelect($event)"
            class="hidden"
            @if($disabled) disabled @endif
        />

        {{-- Upload Icon --}}
        <div x-show="files.length === 0" @click="window.openFileDialog('{{ $uniqueId }}')" class="p-8 text-center cursor-pointer">
            <svg class="mx-auto w-12 h-12 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
            <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
                <span class="font-semibold text-blue-500 hover:text-blue-600">Click to upload</span>
                or drag and drop
            </p>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-500">{{ strtoupper(str_replace('image/', '', $accept)) }} up to {{ $maxSize }}MB</p>
        </div>

        {{-- File Previews --}}
        <div x-show="files.length > 0" class="grid grid-cols-2 sm:grid-cols-3 gap-3">
            <template x-for="(file, index) in files" :key="index">
                <div class="relative group bg-gray-100 dark:bg-gray-700 rounded-lg overflow-hidden">
                    {{-- Image Preview --}}
                    <img x-show="file.type.startsWith('image/')" :src="file.preview" class="w-full h-24 object-cover" />
                    {{-- File Icon --}}
                    <div x-show="!file.type.startsWith('image/')" class="flex flex-col items-center justify-center h-24">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span class="text-xs text-gray-500 mt-1 truncate max-w-[80px]" x-text="file.name"></span>
                    </div>
                    {{-- Remove Button --}}
                    <button @click.stop="removeFile(index)" class="absolute top-1 right-1 w-5 h-5 bg-red-500 text-white rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-xs">×</button>
                    {{-- Error Badge --}}
                    <div x-show="file.error" class="absolute inset-0 bg-red-500/80 flex items-center justify-center">
                        <p class="text-white text-xs text-center px-2" x-text="file.error"></p>
                    </div>
                </div>
            </template>

            {{-- Add More Button --}}
            <button x-show="files.length > 0" @click.stop="window.openFileDialog('{{ $uniqueId }}')" class="h-24 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg flex items-center justify-center hover:border-blue-400 transition">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            </button>
        </div>
    </div>

    {{-- File Info --}}
    <div x-show="files.length > 0" class="text-xs text-gray-500 dark:text-gray-400">
        <span x-text="files.length + ' file(s) selected'"></span>
        <span x-show="totalSize > 0" x-text="' · ' + formatSize(totalSize)"></span>
    </div>
</div>

<script>
// Global helper to open file dialog
window.openFileDialog = function(inputId) {
    const input = document.getElementById(inputId);
    if (input) {
        input.value = '';
        input.click();
    }
};

function styledFileInput(uniqueId, maxSizeMB) {
    return {
        files: [],
        isDragging: false,
        maxSize: maxSizeMB * 1024 * 1024,
        multiple: false,
        totalSize: 0,

        init() {
            this.multiple = this.$el.getAttribute('data-multiple') === '1';
        },

        handleFileSelect(event) {
            const files = Array.from(event.target.files);
            if (files.length === 0) return;
            if (!this.multiple) {
                this.files.forEach(f => { if (f.preview) URL.revokeObjectURL(f.preview); });
                this.files = [];
            }
            this.addFiles(files);
            event.target.value = '';
        },

        handleDrop(event) {
            this.isDragging = false;
            const files = Array.from(event.dataTransfer.files);
            if (!this.multiple) {
                this.files.forEach(f => { if (f.preview) URL.revokeObjectURL(f.preview); });
                this.files = [];
            }
            this.addFiles(files);
        },

        addFiles(fileList) {
            fileList.forEach(file => {
                if (file.size > this.maxSize) {
                    this.files.push({
                        name: file.name,
                        size: file.size,
                        type: file.type,
                        preview: null,
                        error: 'Max ' + this.formatSize(this.maxSize)
                    });
                    return;
                }

                const preview = file.type.startsWith('image/')
                    ? URL.createObjectURL(file)
                    : null;

                this.files.push({
                    name: file.name,
                    size: file.size,
                    type: file.type,
                    preview: preview,
                    error: null
                });
            });

            this.totalSize = this.files.reduce((sum, f) => sum + f.size, 0);
        },

        removeFile(index) {
            const file = this.files[index];
            if (file.preview) URL.revokeObjectURL(file.preview);
            this.files.splice(index, 1);
            this.totalSize = this.files.reduce((sum, f) => sum + f.size, 0);
        },

        formatSize(bytes) {
            if (bytes === 0) return '0 B';
            const k = 1024, sizes = ['B', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(1)) + ' ' + sizes[i];
        }
    };
}
</script>