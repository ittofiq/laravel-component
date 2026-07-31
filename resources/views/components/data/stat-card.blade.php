{{-- Komponen Stat Card dengan Tailwind CSS --}}
@props([
    'label' => 'Statistic',
    'value' => '0',
    'icon' => '📊',
    'trend' => null,
    'trendUp' => true,
])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-gray-600 dark:text-gray-400 text-sm font-medium">{{ $label }}</p>
            <p class="text-3xl font-bold text-gray-900 dark:text-white mt-2">{{ $value }}</p>
            @if($trend)
                <p class="text-sm mt-2 flex items-center gap-1 {{ $trendUp ? 'text-green-600' : 'text-red-600' }}">
                    <span>{{ $trendUp ? '↑' : '↓' }}</span>
                    {{ $trend }}
                </p>
            @endif
        </div>
        <div class="text-4xl">{{ $icon }}</div>
    </div>
</div>
