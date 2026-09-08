{{-- Komponen Auto-Complete dengan Dropdown Suggestion --}}
@props([
    'name' => null,
    'label' => null,
    'options' => [],
    'placeholder' => 'Ketik untuk mencari...',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-2.5 text-base',
        'xl' => 'px-5 py-3 text-lg',
        default => 'px-4 py-2 text-sm',
    };
    $uniqueId = 'autocomplete-' . uniqid();
    $optionsJson = json_encode($options);
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

    <div x-data="autoCompleteComponent('{{ $uniqueId }}', {{ $optionsJson }}, {{ $disabled ? 'true' : 'false' }})" @click.outside="isOpen = false" class="relative">
        <input
            type="text"
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            x-model="selectedText"
            @input="filterSuggestions"
            @keydown.arrow-down.prevent="highlightNext"
            @keydown.arrow-up.prevent="highlightPrev"
            @keydown.enter.prevent="selectHighlighted"
            @focus="isOpen = true"
            @keydown.escape="isOpen = false"
            class="w-full {{ $sizeClass }} rounded-lg border transition-colors duration-200 focus:outline-none focus:ring-2 {{ $error ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500' }} bg-white dark:bg-gray-700 text-gray-900 dark:text-white {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
            {{ $disabled ? 'disabled' : '' }}
        />

        <!-- Suggestions Dropdown -->
        <div x-show="isOpen && suggestions.length > 0" class="absolute top-full left-0 right-0 mt-1 z-50 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">
            <template x-for="(suggestion, index) in suggestions" :key="index">
                <div
                    @click="selectSuggestion(index)"
                    @mouseenter="highlightedIndex = index"
                    class="px-4 py-2 cursor-pointer text-gray-900 dark:text-white hover:bg-blue-50 dark:hover:bg-blue-900/30"
                    :class="highlightedIndex === index ? 'bg-blue-100 dark:bg-blue-900/20 font-semibold' : ''"
                >
                    <span x-text="suggestion"></span>
                </div>
            </template>
        </div>

        @if($error)
            <p class="text-sm text-red-500 flex items-center gap-1 mt-1">
                <span>⚠️</span>
                {{ $error }}
            </p>
        @endif
    </div>

    <p class="text-xs text-gray-500 dark:text-gray-400">
        ✓ Ketik untuk mencari, gunakan ↑↓ untuk navigasi, Enter untuk pilih
    </p>
</div>

<script>
function autoCompleteComponent(uniqueId, allOptions, isDisabled) {
    return {
        uniqueId,
        allOptions,
        isDisabled,
        selectedText: '',
        suggestions: [...allOptions],
        highlightedIndex: -1,
        isOpen: false,

        filterSuggestions() {
            if (!this.selectedText.trim()) {
                this.suggestions = [...this.allOptions];
                this.highlightedIndex = -1;
                return;
            }

            const query = this.selectedText.toLowerCase();
            this.suggestions = this.allOptions.filter(option =>
                option.toLowerCase().includes(query)
            );
            this.highlightedIndex = -1;
        },

        highlightNext() {
            if (this.highlightedIndex < this.suggestions.length - 1) {
                this.highlightedIndex++;
            }
        },

        highlightPrev() {
            if (this.highlightedIndex > 0) {
                this.highlightedIndex--;
            }
        },

        selectHighlighted() {
            if (this.highlightedIndex >= 0 && this.suggestions[this.highlightedIndex]) {
                this.selectSuggestion(this.highlightedIndex);
            }
        },

        selectSuggestion(index) {
            this.selectedText = this.suggestions[index];
            this.isOpen = false;
            this.highlightedIndex = -1;
        }
    };
}
</script>
