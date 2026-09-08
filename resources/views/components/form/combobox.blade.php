{{-- Komponen Combobox dengan Alpine.js --}}
@props([
    'name' => null,
    'label' => null,
    'options' => [],
    'searchable' => true,
    'placeholder' => 'Pilih atau ketik...',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-4 py-2 text-base',
        'lg' => 'px-4 py-2.5 text-lg',
        'xl' => 'px-5 py-3 text-xl',
        default => 'px-4 py-2 text-base',
    };
    $uniqueId = 'combobox-' . uniqid();
    $optionsJson = json_encode(array_values($options));
@endphp

<div class="flex flex-col gap-2" x-data="comboboxComponent('{{ $uniqueId }}', {{ $optionsJson }}, {{ $disabled ? 'true' : 'false' }})">
    @if($label)
        <label for="{{ $uniqueId }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div class="relative" @click.outside="open = false">
        {{-- Hidden input for form submission --}}
        <input type="hidden" name="{{ $name }}" x-model="selected">

        {{-- Input/Button --}}
        <div class="relative flex items-center">
            <input
                type="text"
                id="{{ $uniqueId }}"
                x-model="search"
                @focus="open = true"
                @input="filter"
                @keydown.arrow-down.prevent="highlightNext"
                @keydown.arrow-up.prevent="highlightPrev"
                @keydown.enter.prevent="selectHighlighted"
                @keydown.escape="open = false"
                placeholder="{{ $placeholder }}"
                class="w-full {{ $sizeClass }} rounded-lg border transition-colors duration-200 focus:outline-none focus:ring-2 pr-10 {{ $error ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500' }} bg-white dark:bg-gray-700 text-gray-900 dark:text-white {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
                {{ $disabled ? 'disabled' : '' }}
            />
            {{-- Clear button --}}
            <button
                x-show="selected"
                @click="clear"
                type="button"
                class="absolute right-8 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            {{-- Chevron --}}
            <button
                @click="open = !open"
                type="button"
                class="absolute right-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
            >
                <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
            </button>
        </div>

        {{-- Dropdown --}}
        <div
            x-show="open && filteredOptions.length > 0"
            class="absolute top-full left-0 right-0 mt-1 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg z-20 max-h-60 overflow-y-auto"
        >
            <template x-for="(option, index) in filteredOptions" :key="index">
                <button
                    @click="selectOption(option)"
                    @mouseenter="highlighted = index"
                    type="button"
                    class="w-full text-left px-4 py-2.5 text-sm transition-colors"
                    :class="{
                        'bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300': highlighted === index,
                        'text-gray-700 dark:text-gray-300': highlighted !== index
                    }"
                    x-text="option"
                ></button>
            </template>
        </div>

        {{-- No results --}}
        <div
            x-show="open && filteredOptions.length === 0 && search.length > 0"
            class="absolute top-full left-0 right-0 mt-1 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg shadow-lg z-20 p-4 text-center text-sm text-gray-500 dark:text-gray-400"
        >
            Tidak ada hasil untuk "<span x-text="search"></span>"
        </div>
    </div>

    @if($error)
        <p class="text-sm text-red-500">{{ $error }}</p>
    @endif
</div>

<script>
function comboboxComponent(uniqueId, allOptions, isDisabled) {
    return {
        uniqueId,
        allOptions,
        isDisabled,
        selected: '',
        search: '',
        open: false,
        highlighted: -1,
        filteredOptions: allOptions,

        filter() {
            this.open = true;
            if (!this.search.trim()) {
                this.filteredOptions = [...this.allOptions];
                this.highlighted = -1;
                return;
            }
            const query = this.search.toLowerCase();
            this.filteredOptions = this.allOptions.filter(opt =>
                opt.toLowerCase().includes(query)
            );
            this.highlighted = this.filteredOptions.length > 0 ? 0 : -1;
        },

        selectOption(option) {
            this.selected = option;
            this.search = option;
            this.open = false;
            this.highlighted = -1;
        },

        clear() {
            this.selected = '';
            this.search = '';
            this.filteredOptions = [...this.allOptions];
            this.highlighted = -1;
        },

        highlightNext() {
            if (this.filteredOptions.length > 0) {
                this.highlighted = Math.min(this.highlighted + 1, this.filteredOptions.length - 1);
            }
        },

        highlightPrev() {
            this.highlighted = Math.max(this.highlighted - 1, 0);
        },

        selectHighlighted() {
            if (this.highlighted >= 0 && this.highlighted < this.filteredOptions.length) {
                this.selectOption(this.filteredOptions[this.highlighted]);
            }
        }
    };
}
</script>