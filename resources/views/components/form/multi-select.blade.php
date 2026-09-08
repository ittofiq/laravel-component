{{-- Komponen Multi-Select Custom seperti Select2 dengan Alpine.js --}}
@props([
    'name' => null,
    'label' => null,
    'options' => [],
    'placeholder' => 'Cari dan pilih opsi...',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-3 py-2 text-base',
        'lg' => 'px-4 py-2.5 text-lg',
        'xl' => 'px-5 py-3 text-xl',
        default => 'px-3 py-2 text-base',
    };
    $textClass = match($size) {
        'xs' => 'text-xs',
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-lg',
        'xl' => 'text-xl',
        default => 'text-base',
    };
    $optionPadding = match($size) {
        'xs' => 'px-2 py-1',
        'sm' => 'px-2.5 py-1.5',
        'md' => 'px-4 py-2',
        'lg' => 'px-4 py-2.5',
        'xl' => 'px-5 py-3',
        default => 'px-4 py-2',
    };
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

    <div class="relative" x-data="multiSelectData({{ $optionsJson }}, {{ $disabled ? 'true' : 'false' }})" @click.outside="open = false">

        <!-- Hidden input -->
        <input type="hidden" name="{{ $name }}[]" :value="JSON.stringify(selected)" />

        <!-- Selection box -->
        <div class="w-full min-h-10 {{ $sizeClass }} rounded-lg border transition-all duration-200 focus-within:ring-2 {{ $error ? 'border-red-500 focus-within:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus-within:ring-blue-500' }} bg-white dark:bg-gray-700 cursor-pointer {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}" @click="open = !open">

            <!-- Tags -->
            <div class="flex flex-wrap gap-2 mb-1">
                <template x-for="val in selected" :key="val">
                    <div class="inline-flex items-center gap-1 px-2 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded">
                        <span x-text="options[val] || val"></span>
                        <button type="button" @click.stop="removeItem(val)" class="ml-1 hover:text-blue-600">✕</button>
                    </div>
                </template>

                <!-- Search -->
                <input
                    type="text"
                    placeholder="{{ $placeholder }}"
                    x-model="search"
                    @input="updateFiltered"
                    @focus="open = true"
                    @keydown.escape="open = false"
                    class="flex-1 min-w-32 bg-transparent outline-none text-gray-900 dark:text-white placeholder-gray-500"
                    {{ $disabled ? 'disabled' : '' }}
                />
            </div>
        </div>

        <!-- Dropdown -->
        <div x-show="open" class="absolute top-full left-0 right-0 mt-1 z-50 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-y-auto">

            <template x-for="(text, value) in filteredOptions" :key="value">
                <div
                    @click.stop="toggleItem(value)"
                    class="{{ $optionPadding }} {{ $textClass }} cursor-pointer text-gray-900 dark:text-white hover:bg-blue-50 dark:hover:bg-blue-900/30"
                    :class="selected.includes(value) ? 'bg-blue-100 dark:bg-blue-900/20 font-semibold' : ''"
                >
                    <span x-text="text"></span>
                </div>
            </template>

            <div x-show="Object.keys(filteredOptions).length === 0" class="px-4 py-3 text-center text-gray-500 text-sm">
                Tidak ada opsi
            </div>
        </div>

        <!-- Error -->
        @if($error)
            <p class="text-sm text-red-500 flex items-center gap-1 mt-1">
                <span>⚠️</span> {{ $error }}
            </p>
        @endif

        <!-- Helper -->
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
            ✓ Ketik untuk cari, klik untuk pilih, X untuk hapus
        </p>
    </div>
</div>

<script>
function multiSelectData(allOptions, isDisabled) {
    return {
        options: allOptions,
        selected: [],
        search: '',
        open: false,
        filteredOptions: allOptions,
        isDisabled,

        init() {
            this.updateFiltered();
        },

        updateFiltered() {
            if (!this.search.trim()) {
                this.filteredOptions = { ...this.options };
                return;
            }

            const query = this.search.toLowerCase();
            const filtered = {};

            Object.entries(this.options).forEach(([key, value]) => {
                if (key.toLowerCase().includes(query) || value.toLowerCase().includes(query)) {
                    filtered[key] = value;
                }
            });

            this.filteredOptions = filtered;
        },

        toggleItem(value) {
            if (this.isDisabled) return;

            const index = this.selected.indexOf(value);
            if (index > -1) {
                this.selected.splice(index, 1);
            } else {
                this.selected.push(value);
            }
        },

        removeItem(value) {
            if (this.isDisabled) return;

            const index = this.selected.indexOf(value);
            if (index > -1) {
                this.selected.splice(index, 1);
            }
        }
    };
}
</script>
