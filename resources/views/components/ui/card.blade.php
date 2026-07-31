{{-- Komponen Card dengan Tailwind CSS --}}
@props([
    'title' => null,
    'subtitle' => null,
    'headerImage' => null,
    'headerImageAlt' => 'Card image',
    'headerImageHeight' => 'h-48',
    'variant' => 'default',    // default, bordered, elevated, flat
    'hover' => 'lift',          // lift, glow, scale, border, none
    'padding' => 'md',          // none, sm, md, lg
    'footerDivider' => true,
    // Form-aware props
    'asForm' => false,
    'method' => 'POST',
    'action' => null,
    'csrf' => true,
    'submitLabel' => 'Save',
    'cancelLabel' => 'Cancel',
    'cancelUrl' => null,
    'loading' => false,         // External loading state (optional)
])

@php
    $variants = [
        'default' => 'bg-white dark:bg-gray-800 shadow-md border border-gray-200 dark:border-gray-700',
        'bordered' => 'bg-white dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-600',
        'elevated' => 'bg-white dark:bg-gray-800 shadow-xl border border-gray-100 dark:border-gray-700/50',
        'flat' => 'bg-gray-50 dark:bg-gray-800/50 border border-gray-100 dark:border-gray-700/30',
    ];

    $hovers = [
        'lift' => 'hover:shadow-xl hover:-translate-y-1 transition-all duration-300',
        'glow' => 'hover:shadow-lg hover:shadow-blue-500/10 dark:hover:shadow-blue-500/5 transition-shadow duration-300',
        'scale' => 'hover:shadow-lg hover:scale-[1.02] transition-all duration-300',
        'border' => 'hover:border-blue-400 dark:hover:border-blue-500 transition-colors duration-200',
        'none' => '',
    ];

    $paddings = [
        'none' => 'p-0',
        'sm' => 'p-3',
        'md' => 'p-5',
        'lg' => 'p-8',
    ];

    $baseClass = $variants[$variant] ?? $variants['default'];
    $hoverClass = $hovers[$hover] ?? $hovers['lift'];
    $paddingClass = $paddings[$padding] ?? $paddings['md'];
    $hasHeader = $title || $subtitle || $headerImage;
    $hasFooter = isset($footer) && !$footer->isEmpty();
    $hasActions = isset($actions) && !$actions->isEmpty();
    $needsCsrf = $csrf && in_array(strtoupper($method), ['POST', 'PUT', 'PATCH', 'DELETE']);
    $isForm = $asForm && $action;
    $tag = $isForm ? 'form' : 'div';
@endphp

<{{ $tag }}
    @if($isForm) action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" @endif
    @if(!$isForm || $hover !== 'none') class="rounded-lg overflow-hidden {{ $baseClass }} {{ $hoverClass }}" @endif
    @if($isForm)
        x-data="{ submitting: false }"
        @submit="submitting = true"
    @endif
>
    @if($isForm && $needsCsrf)
        @csrf
        @method($method)
    @endif

    @if($isForm && $hover === 'none')
        {{-- When hover is none on form, apply classes to inner wrapper --}}
        <div class="rounded-lg overflow-hidden {{ $baseClass }}">
    @endif

    {{-- Header Image --}}
    @if($headerImage)
        <div class="{{ $headerImageHeight }} overflow-hidden -mx-[1px] -mt-[1px]">
            <img src="{{ $headerImage }}" alt="{{ $headerImageAlt }}" class="w-full h-full object-cover" />
        </div>
    @endif

    {{-- Title + Actions Row --}}
    @if($hasHeader || $hasActions)
        <div class="flex items-start justify-between gap-4 px-5 pt-5 {{ $headerImage ? '' : '' }}">
            @if($hasHeader)
                <div class="flex-1 min-w-0 {{ $headerImage ? '' : 'pb-4 border-b border-gray-200 dark:border-gray-700' }} mb-4">
                    @if($title)
                        <h2 class="text-lg font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
                    @endif
                    @if($subtitle)
                        <p class="text-xs text-gray-500 dark:text-gray-400 {{ $title ? 'mt-0.5' : '' }}">{{ $subtitle }}</p>
                    @endif
                </div>
            @endif

            {{-- Header Actions --}}
            @if($hasActions)
                <div class="flex items-center gap-2 flex-shrink-0">
                    {{ $actions }}
                </div>
            @endif
        </div>
    @endif

    {{-- Content --}}
    @if(!$slot->isEmpty())
        <div class="text-gray-700 dark:text-gray-300 {{ $paddingClass }}">
            {{ $slot }}
        </div>
    @endif

    {{-- Footer --}}
    @if($hasFooter || $isForm)
        <div class="px-5 py-4 bg-gray-50 dark:bg-gray-800/80 {{ $footerDivider ? 'border-t border-gray-200 dark:border-gray-700' : '' }} flex items-center justify-between gap-3">
            @if($hasFooter)
                {{ $footer }}
            @elseif($isForm)
                {{-- Auto form footer --}}
                <div>
                    @if($cancelUrl)
                        <a href="{{ $cancelUrl }}" class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition">
                            {{ $cancelLabel }}
                        </a>
                    @endif
                </div>
                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="px-4 py-2 text-sm font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center gap-2"
                        :disabled="submitting"
                    >
                        <svg x-show="submitting" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                        <span x-text="submitting ? 'Saving...' : '{{ $submitLabel }}'">{{ $submitLabel }}</span>
                    </button>
                </div>
            @endif
        </div>
    @endif

    @if($isForm && $hover === 'none')
        </div>
    @endif
</{{ $tag }}>