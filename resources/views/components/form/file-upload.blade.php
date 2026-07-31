{{-- Komponen File Upload Sophisticated dengan drag-drop, preview, dan progress --}}
@props([
    'name' => null,
    'label' => null,
    'accept' => '*',
    'multiple' => false,
    'error' => null,
    'required' => false,
    'helperText' => null,
    'maxSize' => 5242880, // 5MB default
])

@php
    $uniqueId = 'fileupload-' . uniqid();
@endphp

<div x-data="fileUploadComponent({{ $maxSize }})" class="flex flex-col gap-2">
    @if($label)
        <label for="{{ $uniqueId }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <!-- Drag & Drop Area -->
    <div
        @drag over.prevent="isDragging = true"
        @drag leave.prevent="isDragging = false"
        @drop.prevent="handleDrop($event)"
        :class="{'border-blue-500 bg-blue-50 dark:bg-blue-900/20': isDragging}"
        class="flex items-center justify-center w-full transition-colors duration-200 border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 p-6"
    >
        <label class="flex flex-col items-center justify-center w-full cursor-pointer">
            <div class="flex flex-col items-center justify-center">
                <svg class="w-10 h-10 mb-2 transition-transform" :class="{'scale-125': isDragging}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"></path>
                </svg>
                <p class="mb-1 text-sm text-gray-700 dark:text-gray-300">
                    <span class="font-semibold">Klik untuk upload</span> atau drag file di sini
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-400">
                    <span x-text="`Max ${formatFileSize(maxSize)}`"></span>
                </p>
            </div>
            <input
                type="file"
                id="{{ $uniqueId }}"
                name="{{ $name }}"
                accept="{{ $accept }}"
                @change="handleFileSelect($event)"
                class="hidden"
                {{ $multiple ? 'multiple' : '' }}
                {{ $required ? 'required' : '' }}
            />
        </label>
    </div>

    <!-- File List & Preview -->
    <div x-show="files.length > 0" class="space-y-2">
        <template x-for="(file, idx) in files" :key="idx">
            <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600">
                <div class="flex items-center gap-3 flex-1">
                    <!-- File Icon -->
                    <div class="text-2xl" x-text="getFileIcon(file.type)"></div>

                    <!-- File Info -->
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate" x-text="file.name"></p>
                        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
                            <span x-text="formatFileSize(file.size)"></span>
                            <template x-if="file.progress">
                                <span x-text="`${file.progress}%`"></span>
                            </template>
                        </div>
                    </div>

                    <!-- Progress Bar -->
                    <template x-if="file.progress">
                        <div class="w-20 h-1 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                            <div class="h-full bg-blue-500" :style="`width: ${file.progress}%`"></div>
                        </div>
                    </template>

                    <!-- Status Icon -->
                    <template x-if="file.status === 'success'">
                        <span class="text-green-500">✓</span>
                    </template>
                    <template x-if="file.status === 'error'">
                        <span class="text-red-500">✕</span>
                    </template>
                </div>

                <!-- Remove Button -->
                <button
                    type="button"
                    @click="removeFile(idx)"
                    class="ml-2 p-1 text-gray-400 hover:text-red-500 dark:hover:text-red-400"
                >
                    ✕
                </button>
            </div>

            <!-- Error Message -->
            <template x-if="file.error">
                <p class="text-xs text-red-500 flex items-center gap-1">
                    <span>⚠️</span>
                    <span x-text="file.error"></span>
                </p>
            </template>
        </template>
    </div>

    <!-- Helper Text -->
    @if($helperText && !$error)
        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $helperText }}</p>
    @endif

    @if($error)
        <p class="text-sm text-red-500 flex items-center gap-1">
            <span>⚠️</span>
            {{ $error }}
        </p>
    @endif
</div>


