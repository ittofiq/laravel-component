{{-- Komponen Form Wizard dengan Alpine.js --}}
@props([
    'steps' => [],
    'currentStep' => 1,
])

@php
    $total = count($steps);
    if ($total === 0) return;
    $stepsJson = json_encode($steps);
@endphp

<div x-data="formWizard({{ $currentStep }}, {{ $total }}, {{ $stepsJson }})" class="space-y-8">
    {{-- Step Indicator --}}
    <div class="relative">
        {{-- Background Track --}}
        <div class="absolute top-5 left-0 right-0 h-0.5 bg-gray-200 dark:bg-gray-600" style="top: 1.25rem;"></div>
        {{-- Active Track --}}
        <div class="absolute top-5 left-0 h-0.5 bg-blue-500 transition-all duration-500" style="top: 1.25rem;" :style="'width: ' + ((currentStep - 1) / (total - 1) * 100) + '%'"></div>

        {{-- Steps --}}
        <div class="relative flex justify-between">
            <template x-for="(step, index) in steps" :key="index">
                <div class="flex flex-col items-center">
                    {{-- Circle --}}
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 z-10"
                        :class="{
                            'bg-blue-500 text-white shadow-md': index + 1 <= currentStep,
                            'bg-gray-200 dark:bg-gray-600 text-gray-500 dark:text-gray-400': index + 1 > currentStep
                        }">
                        <span x-show="index + 1 < currentStep" class="text-lg">✓</span>
                        <span x-show="index + 1 >= currentStep" x-text="index + 1"></span>
                    </div>
                    {{-- Label --}}
                    <p class="text-xs mt-2 text-center font-medium transition-colors"
                        :class="{
                            'text-blue-600 dark:text-blue-400': index + 1 <= currentStep,
                            'text-gray-400 dark:text-gray-500': index + 1 > currentStep
                        }"
                        x-text="step"></p>
                </div>
            </template>
        </div>
    </div>

    {{-- Step Content --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6 min-h-[180px]">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-3" x-text="'Step ' + currentStep + ': ' + (steps[currentStep - 1] || '')"></h3>
        <div class="text-gray-600 dark:text-gray-400 text-sm">
            {{ $slot }}
        </div>
    </div>

    {{-- Navigation --}}
    <div class="flex items-center justify-between">
        <button @click="prev" type="button" x-show="currentStep > 1"
            class="px-5 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition font-medium text-sm flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Sebelumnya
        </button>

        <div x-show="currentStep === 1"></div>

        <button @click="next" type="button" x-show="currentStep < total"
            class="px-5 py-2.5 rounded-lg bg-blue-500 hover:bg-blue-600 text-white font-medium text-sm flex items-center gap-2 transition ml-auto"
            x-text="currentStep === total - 1 ? 'Selesai' : 'Selanjutnya'">
        </button>
    </div>

    {{-- Counter --}}
    <p class="text-center text-xs text-gray-400 dark:text-gray-500" x-text="'Step ' + currentStep + ' dari ' + total"></p>
</div>