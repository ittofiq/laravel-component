{{-- Komponen Select Sophisticated dengan search, keyboard nav, dan custom styling --}}
@props([
    'name' => null,
    'label' => null,
    'options' => [],
    'placeholder' => 'Pilih opsi...',
    'size' => 'md',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'searchable' => true,
    'clearable' => false,
])

@php
    $uniqueId = 'select-' . uniqid();
    $optionsJson = json_encode($options);
    $sizeClass = match($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-4 py-2.5 text-lg',
        'xl' => 'px-5 py-3 text-xl',
        default => 'px-4 py-2 text-base',
    };
@endphp

<div class="flex flex-col gap-2">
    @if($label)
        <label for="{{ $uniqueId }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div x-data="selectComponent('{{ $uniqueId }}', {{ $optionsJson }}, {{ $disabled ? 'true' : 'false' }})" @click.outside="isOpen = false" class="relative">
        <!-- Hidden select untuk form submission -->
        <select
            id="{{ $uniqueId }}-hidden"
            name="{{ $name }}"
            class="hidden"
            x-model="selectedValue"
            @if($disabled) disabled @endif
        >
            <option value="">{{ $placeholder }}</option>
            @foreach($options as $value => $text)
                <option value="{{ $value }}">{{ $text }}</option>
            @endforeach
        </select>

        <!-- Custom Select Button -->
        <div class="relative">
            <button
                type="button"
                @click="isOpen = !isOpen"
                class="w-full {{ $sizeClass }} rounded-lg border transition-all duration-200 focus:outline-none focus:ring-2 text-left flex items-center justify-between
                    {{ $error
                        ? 'border-red-500 focus:ring-red-500 focus:border-red-500'
                        : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500'
                    }}
                    bg-white dark:bg-gray-700 text-gray-900 dark:text-white
                    {{ $disabled ? 'opacity-60 cursor-not-allowed' : 'hover:border-gray-400 dark:hover:border-gray-500' }}"
                {{ $disabled ? 'disabled' : '' }}
            >
                <span x-text="getDisplayText()" class="flex-1 truncate"></span>
                <div class="flex items-center gap-1">
                    @if($clearable)
                        <button type="button" @click.stop="clearSelection()" x-show="selectedValue" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            ✕
                        </button>
                    @endif
                    <svg class="w-4 h-4 transition-transform" :class="{'rotate-180': isOpen}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>
            </button>

            <!-- Dropdown List -->
            <div x-show="isOpen" class="absolute top-full left-0 right-0 mt-1 z-50 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg">
                <!-- Search Input -->
                @if($searchable)
                    <div class="p-2 border-b border-gray-200 dark:border-gray-700">
                        <input
                            type="text"
                            placeholder="Cari opsi..."
                            x-model="searchQuery"
                            @input="filterOptions()"
                            @keydown.arrow-down="highlightNext()"
                            @keydown.arrow-up="highlightPrev()"
                            @keydown.enter="selectHighlighted()"
                            @keydown.escape="isOpen = false"
                            class="w-full px-3 py-1.5 rounded border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm"
                            @focus="searchFocused = true"
                        />
                    </div>
                @endif

                <!-- Options List -->
                <div class="max-h-60 overflow-y-auto">
                    <template x-for="(text, value, idx) in filteredOptions" :key="value">
                        <button
                            type="button"
                            @click.stop="selectOption(value)"
                            @mouseenter="highlightedIdx = idx"
                            class="w-full text-left px-4 py-2 text-gray-900 dark:text-white transition-colors
                                {{ $searchable ? 'hover:bg-blue-50 dark:hover:bg-blue-900/30' : 'hover:bg-gray-50 dark:hover:bg-gray-700' }}"
                            :class="{'bg-blue-100 dark:bg-blue-900/20 font-semibold': selectedValue === value, 'bg-blue-50 dark:bg-blue-900/10': highlightedIdx === idx}"
                        >
                            <span x-text="text"></span>
                            <span x-show="selectedValue === value" class="float-right text-blue-500">✓</span>
                        </button>
                    </template>

                    <div x-show="Object.keys(filteredOptions).length === 0" class="px-4 py-3 text-center text-gray-500 dark:text-gray-400 text-sm">
                        Tidak ada opsi
                    </div>
                </div>
            </div>
        </div>

        @if($error)
            <p class="text-sm text-red-500 flex items-center gap-1 mt-1">
                <span>⚠️</span>
                {{ $error }}
            </p>
        @endif
    </div>
</div>

<script>
function selectComponent(uniqueId, allOptions, isDisabled) {
    return {
        uniqueId,
        allOptions,
        isDisabled,
        selectedValue: '',
        searchQuery: '',
        filteredOptions: allOptions,
        isOpen: false,
        searchFocused: false,
        highlightedIdx: -1,

        init() {
            this.filteredOptions = { ...this.allOptions };
        },

        getDisplayText() {
            return this.allOptions[this.selectedValue] || '{{ $placeholder }}';
        },

        selectOption(value) {
            this.selectedValue = value;
            this.isOpen = false;
            this.searchQuery = '';
            this.filteredOptions = { ...this.allOptions };
        },

        clearSelection() {
            this.selectedValue = '';
        },

        filterOptions() {
            if (!this.searchQuery.trim()) {
                this.filteredOptions = { ...this.allOptions };
                return;
            }
            const query = this.searchQuery.toLowerCase();
            this.filteredOptions = Object.fromEntries(
                Object.entries(this.allOptions).filter(([value, text]) =>
                    text.toLowerCase().includes(query) || value.toLowerCase().includes(query)
                )
            );
            this.highlightedIdx = 0;
        },

        highlightNext() {
            const keys = Object.keys(this.filteredOptions);
            this.highlightedIdx = Math.min(this.highlightedIdx + 1, keys.length - 1);
        },

        highlightPrev() {
            this.highlightedIdx = Math.max(this.highlightedIdx - 1, 0);
        },

        selectHighlighted() {
            const keys = Object.keys(this.filteredOptions);
            if (this.highlightedIdx >= 0 && this.highlightedIdx < keys.length) {
                this.selectOption(keys[this.highlightedIdx]);
            }
        }
    };
}
</script>
