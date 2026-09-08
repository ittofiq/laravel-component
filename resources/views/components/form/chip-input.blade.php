{{-- Komponen Chip Input - Tag/Chip seperti email recipients --}}
@props([
    'name' => null,
    'label' => null,
    'placeholder' => 'Ketik lalu tekan Enter...',
    'chips' => [],
    'maxChips' => null,
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
    $uniqueId = 'chip-' . uniqid();
    $chipsJson = json_encode($chips);
@endphp

<div class="flex flex-col gap-2">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)<span class="text-red-500">*</span>@endif
        </label>
    @endif

    <div
        x-data="chipInput({{ $chipsJson }}, {{ $maxChips ?? 'null' }}, '{{ $name }}')"
        @click="$refs.input.focus()"
        class="flex flex-wrap gap-2 {{ $sizeClass }} rounded-lg border cursor-text transition-colors duration-200 focus-within:ring-2 min-h-[42px] {{ $error ? 'border-red-500 focus-within:ring-red-500' : 'border-gray-300 dark:border-gray-600 focus-within:ring-blue-500 focus-within:border-blue-500' }} bg-white dark:bg-gray-700 {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
    >
        {{-- Chips --}}
        <template x-for="(chip, index) in chips" :key="index">
            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 transition-all">
                <span x-text="chip"></span>
                <button
                    @click.stop="removeChip(index)"
                    type="button"
                    class="inline-flex items-center justify-center w-4 h-4 rounded-full hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors"
                    {{ $disabled ? 'disabled' : '' }}
                >
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </span>
        </template>

        {{-- Input --}}
        <input
            x-ref="input"
            type="text"
            @keydown.enter.prevent="addChip"
            @keydown.backspace="handleBackspace"
            @keydown.,.prevent="addChip"
            @keydown.space.prevent="addChip"
            placeholder="{{ count($chips) > 0 ? '' : $placeholder }}"
            class="flex-1 min-w-[120px] bg-transparent border-none outline-none text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 py-0.5"
            :class="chips.length > 0 ? '' : 'w-full'"
            {{ $disabled ? 'disabled' : '' }}
        />

        {{-- Clear all --}}
        <button
            x-show="chips.length > 0"
            @click.stop="clearAll"
            type="button"
            class="ml-auto flex-shrink-0 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors"
            title="Clear all"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <input type="hidden" name="{{ $name }}" :value="chips.join(',')">
    </div>

    @if($error)
        <p class="text-sm text-red-500">{{ $error }}</p>
    @endif
</div>

<script>
function chipInput(initialChips, maxChips, fieldName) {
    return {
        chips: initialChips || [],
        maxChips: maxChips,

        addChip(event) {
            const value = event.target.value.trim();
            if (!value) return;

            if (this.maxChips && this.chips.length >= this.maxChips) return;

            if (!this.chips.includes(value)) {
                this.chips.push(value);
                event.target.value = '';
            }
        },

        removeChip(index) {
            this.chips.splice(index, 1);
        },

        clearAll() {
            this.chips = [];
        },

        handleBackspace(event) {
            if (event.target.value === '' && this.chips.length > 0) {
                this.chips.pop();
            }
        }
    };
}
</script>