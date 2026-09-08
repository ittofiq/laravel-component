{{-- Komponen Color Picker dengan Interactive Selection --}}
@props([
    'name' => null,
    'label' => null,
    'value' => '#3B82F6',
    'error' => null,
    'required' => false,
    'disabled' => false,
    'size' => 'md',
])

@php
    $sizeClass = match($size) {
        'xs' => 'px-2 py-1 text-xs',
        'sm' => 'px-2.5 py-1.5 text-sm',
        'md' => 'px-3 py-2 text-sm',
        'lg' => 'px-4 py-2.5 text-base',
        'xl' => 'px-5 py-3 text-lg',
        default => 'px-3 py-2 text-sm',
    };
    $uniqueId = 'colorpicker-' . uniqid();
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

    <div x-data="colorPickerComponent('{{ $uniqueId }}', '{{ $value }}', {{ $disabled ? 'true' : 'false' }})" @click.outside="isOpen = false" class="flex flex-col gap-3">
        <!-- Color Input -->
        <div class="flex gap-2 items-center">
            <input
                type="hidden"
                id="{{ $uniqueId }}"
                name="{{ $name }}"
                x-model="selectedColor"
            />

            <div
                class="w-12 h-12 rounded-lg border-2 border-gray-300 dark:border-gray-600 cursor-pointer transition-transform hover:scale-110"
                :style="'background-color: ' + selectedColor"
                @click="isOpen = !isOpen"
            ></div>

            <input
                type="text"
                placeholder="#000000"
                x-model="selectedColor"
                @input="updateColorFromText"
                class="flex-1 {{ $sizeClass }} rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 font-mono {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
                {{ $disabled ? 'disabled' : '' }}
            />

            <button @click="copyColor" type="button" class="px-3 py-2 text-sm bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded hover:bg-gray-300 dark:hover:bg-gray-600">
                📋
            </button>
        </div>

        <!-- Color Picker Dropdown -->
        <div x-show="isOpen" class="flex flex-col gap-3 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
            <!-- Color Spectrum -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-semibold text-gray-700 dark:text-gray-300">Saturation & Value</label>
                <div
                    @click="selectFromSpectrum($event)"
                    class="w-full h-40 rounded relative cursor-crosshair"
                    :style="'background: linear-gradient(to right, #fff, ' + hueColor + '), linear-gradient(to top, #000, transparent)'"
                ></div>
            </div>

            <!-- Hue Slider -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-semibold text-gray-700 dark:text-gray-300">Hue</label>
                <input
                    type="range"
                    min="0"
                    max="360"
                    x-model="hue"
                    @input="updateColorFromHue"
                    class="w-full"
                />
            </div>

            <!-- Brightness Slider -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-semibold text-gray-700 dark:text-gray-300">Brightness</label>
                <input
                    type="range"
                    min="0"
                    max="100"
                    x-model="brightness"
                    @input="updateColorFromBrightness"
                    class="w-full"
                />
            </div>

            <!-- Preset Colors -->
            <div class="flex flex-col gap-2">
                <label class="text-xs font-semibold text-gray-700 dark:text-gray-300">Preset</label>
                <div class="grid grid-cols-6 gap-2">
                    <template x-for="preset in presets" :key="preset">
                        <button
                            @click="selectedColor = preset"
                            class="w-full h-8 rounded border-2 cursor-pointer hover:scale-110 transition-transform"
                            :style="'background-color: ' + preset + '; border-color: ' + (selectedColor === preset ? '#000' : '#ddd')"
                            type="button"
                        ></button>
                    </template>
                </div>
            </div>
        </div>

        @if($error)
            <p class="text-sm text-red-500 flex items-center gap-1">
                <span>⚠️</span>
                {{ $error }}
            </p>
        @endif
    </div>
</div>

<script>
function colorPickerComponent(uniqueId, initialColor, isDisabled) {
    return {
        uniqueId,
        isDisabled,
        selectedColor: initialColor,
        isOpen: false,
        hue: 210,
        saturation: 100,
        brightness: 100,
        presets: ['#FF6B6B', '#4ECDC4', '#45B7D1', '#FFA07A', '#98D8C8', '#F7DC6F', '#BB8FCE', '#85C1E2', '#F8B88B', '#52C0A1', '#FF8C94', '#A8E6CF'],

        get hueColor() {
            return `hsl(${this.hue}, 100%, 50%)`;
        },

        init() {
            this.updateHueFromColor();
        },

        selectFromSpectrum(event) {
            const rect = event.currentTarget.getBoundingClientRect();
            const x = event.clientX - rect.left;
            const y = event.clientY - rect.top;

            this.saturation = Math.round((x / rect.width) * 100);
            this.brightness = Math.round(100 - (y / rect.height) * 100);
            this.updateColorFromHSB();
        },

        updateColorFromText() {
            if (/^#[0-9A-F]{6}$/i.test(this.selectedColor)) {
                this.updateHueFromColor();
            }
        },

        updateColorFromHue() {
            this.updateColorFromHSB();
        },

        updateColorFromBrightness() {
            this.updateColorFromHSB();
        },

        updateColorFromHSB() {
            this.selectedColor = this.hslToHex(this.hue, this.saturation, this.brightness);
        },

        updateHueFromColor() {
            const hex = this.selectedColor.replace('#', '');
            const r = parseInt(hex.substring(0, 2), 16) / 255;
            const g = parseInt(hex.substring(2, 4), 16) / 255;
            const b = parseInt(hex.substring(4, 6), 16) / 255;

            const max = Math.max(r, g, b);
            const min = Math.min(r, g, b);
            const l = (max + min) / 2;

            let h = 0;
            if (max !== min) {
                const d = max - min;
                const s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

                if (max === r) {
                    h = ((g - b) / d + (g < b ? 6 : 0)) / 6;
                } else if (max === g) {
                    h = ((b - r) / d + 2) / 6;
                } else {
                    h = ((r - g) / d + 4) / 6;
                }
            }

            this.hue = Math.round(h * 360);
        },

        hslToHex(h, s, l) {
            s /= 100;
            l /= 100;

            const k = n => (n + h / 30) % 12;
            const a = s * Math.min(l, 1 - l);
            const f = n => l - a * Math.max(-1, Math.min(k(n) - 3, Math.min(9 - k(n), 1)));

            const toHex = x => {
                const hex = Math.round(255 * f(x)).toString(16);
                return hex.length === 1 ? '0' + hex : hex;
            };

            return '#' + toHex(0) + toHex(8) + toHex(4);
        },

        copyColor() {
            navigator.clipboard.writeText(this.selectedColor);
        }
    };
}
</script>
