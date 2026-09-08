{{-- Komponen Textarea Sophisticated dengan auto-resize, counter, dan markdown preview --}}
@props([
    'name' => null,
    'label' => null,
    'placeholder' => null,
    'size' => 'md',
    'rows' => 4,
    'error' => null,
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'helperText' => null,
    'maxLength' => null,
    'minLength' => null,
    'value' => null,
    'autoResize' => true,
    'showPreview' => false,
])

@php
    $uniqueId = 'textarea-' . uniqid();
    $sizeClass = match($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-2.5 text-base',
        'xl' => 'px-5 py-3 text-lg',
        default => 'px-4 py-2 text-sm',
    };
@endphp

<div x-data="{
    content: '{{ addslashes($value ?? old($name) ?? '') }}',
    charCount: 0,
    wordCount: 0,
    showPreview: false,
    isFocused: false,
    updateCounts() {
        this.charCount = this.content.length;
        this.wordCount = this.content.trim().split(/\s+/).filter(w => w).length;
    },
    togglePreview() {
        this.showPreview = !this.showPreview;
    },
    autoResize() {
        const textarea = document.getElementById('{{ $uniqueId }}');
        if(textarea) {
            textarea.style.height = 'auto';
            textarea.style.height = Math.min(textarea.scrollHeight, 400) + 'px';
        }
    }
}" class="flex flex-col gap-2">
    {{-- Label --}}
    @if($label)
        <label for="{{ $uniqueId }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center justify-between">
            <span class="flex items-center gap-1">
                {{ $label }}
                @if($required)
                    <span class="text-red-500">*</span>
                @endif
            </span>
            @if($showPreview)
                <button
                    type="button"
                    @click="togglePreview()"
                    class="text-xs text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300"
                    x-text="showPreview ? 'Edit' : 'Preview'"
                ></button>
            @endif
        </label>
    @endif

    <div class="relative">
        <!-- Textarea -->
        <textarea
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            x-model="content"
            @input="updateCounts(); {{ $autoResize ? 'autoResize()' : '' }}"
            @focus="isFocused = true"
            @blur="isFocused = false"
            {{ $maxLength ? "maxlength=$maxLength" : '' }}
            {{ $minLength ? "minlength=$minLength" : '' }}
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            class="w-full {{ $sizeClass }} rounded-lg border transition-all duration-200 focus:outline-none focus:ring-2 {{ $autoResize ? 'resize-none' : 'resize-vertical' }} font-sans
                {{ $error
                    ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
                    : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500'
                }}
                bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500
                {{ $disabled || $readonly ? 'opacity-60 cursor-not-allowed' : '' }}
                {{ $showPreview ? 'hidden' : '' }}"
        ></textarea>

        <!-- Markdown Preview -->
        @if($showPreview)
            <div
                x-show="showPreview"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 min-h-[200px] prose dark:prose-invert text-sm text-gray-900 dark:text-white overflow-y-auto max-h-[400px]"
                x-html="content.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                         .replace(/\*(.*?)\*/g, '<em>$1</em>')
                         .replace(/\n/g, '<br>')"
            ></div>
        @endif
    </div>

    {{-- Helper Text & Stats --}}
    <div class="flex items-center justify-between text-xs">
        <div class="flex items-center gap-3">
            @if($helperText && !$error)
                <span class="text-gray-500 dark:text-gray-400">{{ $helperText }}</span>
            @endif
        </div>

        <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400">
            @if($maxLength)
                <span x-text="`${charCount}/${maxLength}`" :class="charCount > maxLength * 0.9 ? 'text-orange-500' : ''"></span>
            @else
                <span x-text="`${charCount} chars`"></span>
            @endif
            <span>•</span>
            <span x-text="`${wordCount} words`"></span>
        </div>
    </div>

    {{-- Error Message --}}
    @if($error)
        <div class="flex items-center gap-1">
            <span class="text-red-500 text-xs">⚠️</span>
            <p class="text-sm text-red-500">{{ $error }}</p>
        </div>
    @endif
</div>

