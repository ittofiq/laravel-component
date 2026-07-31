{{-- Komponen Charts dengan Chart.js --}}
@props([
    'type' => 'bar', // bar, line, pie, doughnut, radar, polarArea
    'label' => 'Chart',
    'labels' => '[]',        // JSON array string: '["Jan","Feb","Mar"]'
    'datasets' => '[]',      // JSON array string
    'options' => '{}',       // JSON object string (Chart.js options override)
    'height' => '320px',
])

<div
    x-data="chartComponent()"
    x-init="init()"
    data-chart-type="{{ $type }}"
    data-chart-labels="{{ $labels }}"
    data-chart-datasets="{{ $datasets }}"
    data-chart-options="{{ $options }}"
    class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow"
>
    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">{{ $label }}</h3>
    <div style="height: {{ $height }}; position: relative;">
        <canvas x-ref="canvas"></canvas>
    </div>
</div>