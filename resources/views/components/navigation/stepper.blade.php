{{-- Komponen Stepper / Step Indicator --}}
@props([
    'steps' => [],
    'current' => 1,
    'variant' => 'numbered', // numbered, icon, bullet
    'orientation' => 'horizontal', // horizontal, vertical
    'clickable' => false,
])

@php
    $total = count($steps);
    if ($total === 0) return;
@endphp

@if($orientation === 'vertical')
    {{-- Vertical Stepper --}}
    <div class="space-y-0">
        @foreach($steps as $index => $step)
            @php $stepNum = $index + 1; $isActive = $stepNum === $current; $isDone = $stepNum < $current; @endphp
            <div class="flex gap-4">
                <div class="flex flex-col items-center">
                    {{-- Circle --}}
                    <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 z-10
                        {{ $isActive ? 'bg-blue-500 text-white shadow-md scale-110' : '' }}
                        {{ $isDone ? 'bg-green-500 text-white' : '' }}
                        {{ !$isActive && !$isDone ? 'bg-gray-200 dark:bg-gray-600 text-gray-500 dark:text-gray-400' : '' }}">
                        @if($isDone)
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        @else
                            {{ $stepNum }}
                        @endif
                    </div>
                    {{-- Connector --}}
                    @if($index < $total - 1)
                        <div class="w-0.5 flex-1 min-h-[24px] {{ $stepNum < $current ? 'bg-green-500' : 'bg-gray-200 dark:bg-gray-600' }}"></div>
                    @endif
                </div>
                <div class="pb-8">
                    <p class="font-semibold text-sm {{ $isActive ? 'text-blue-600 dark:text-blue-400' : ($isDone ? 'text-green-600 dark:text-green-400' : 'text-gray-500 dark:text-gray-400') }}">
                        {{ is_array($step) ? $step['label'] : $step }}
                    </p>
                    @if(is_array($step) && isset($step['description']))
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">{{ $step['description'] }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@else
    {{-- Horizontal Stepper --}}
    <div class="flex items-start justify-between">
        @foreach($steps as $index => $step)
            @php $stepNum = $index + 1; $isActive = $stepNum === $current; $isDone = $stepNum < $current; @endphp
            <div class="flex-1 flex flex-col items-center relative">
                {{-- Connector Line --}}
                @if($index > 0)
                    <div class="absolute top-5 right-1/2 w-full h-1 -translate-y-1/2 {{ $stepNum <= $current ? 'bg-blue-500' : 'bg-gray-200 dark:bg-gray-600' }}" style="z-index: 0;"></div>
                @endif

                {{-- Circle --}}
                <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold transition-all duration-300 z-10
                    {{ $isActive ? 'bg-blue-500 text-white shadow-md ring-4 ring-blue-100 dark:ring-blue-900/30' : '' }}
                    {{ $isDone ? 'bg-green-500 text-white' : '' }}
                    {{ !$isActive && !$isDone ? 'bg-gray-200 dark:bg-gray-600 text-gray-500 dark:text-gray-400' : '' }}
                    {{ $clickable ? 'cursor-pointer hover:scale-110' : '' }}"
                    @if($clickable) onclick="goToStep({{ $stepNum }})" @endif
                >
                    @if($isDone)
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    @else
                        {{ $stepNum }}
                    @endif
                </div>

                {{-- Label --}}
                <p class="text-xs mt-2 text-center font-medium {{ $isActive ? 'text-blue-600 dark:text-blue-400' : ($isDone ? 'text-green-600 dark:text-green-400' : 'text-gray-400 dark:text-gray-500') }}">
                    {{ is_array($step) ? $step['label'] : $step }}
                </p>
                @if(is_array($step) && isset($step['description']))
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5 text-center">{{ $step['description'] }}</p>
                @endif
            </div>
        @endforeach
    </div>
@endif