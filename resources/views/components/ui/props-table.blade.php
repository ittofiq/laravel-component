{{-- Komponen Props Table - Menampilkan tabel API/props untuk komponen --}}
@props([
    'props' => [],
])

@php
    $typeColors = [
        'string' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
        'bool' => 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300',
        'array' => 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300',
        'int' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300',
        'string|null' => 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300',
        'int|null' => 'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-300',
        'mixed' => 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300',
    ];
@endphp

<div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
    <table class="w-full text-sm">
        <thead>
            <tr class="bg-gray-50 dark:bg-gray-700/50">
                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Prop</th>
                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Type</th>
                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Default</th>
                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Deskripsi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach($props as $prop)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                    <td class="px-3 py-2">
                        <code class="text-xs font-mono text-pink-600 dark:text-pink-400 bg-pink-50 dark:bg-pink-900/20 px-1.5 py-0.5 rounded">{{ $prop['name'] }}</code>
                    </td>
                    <td class="px-3 py-2">
                        @php
                            $type = $prop['type'] ?? 'mixed';
                            $colorClass = $typeColors[$type] ?? $typeColors['mixed'];
                        @endphp
                        <span class="inline-block text-[10px] font-semibold px-1.5 py-0.5 rounded-full {{ $colorClass }}">{{ $type }}</span>
                    </td>
                    <td class="px-3 py-2">
                        <code class="text-xs font-mono text-gray-500 dark:text-gray-400">{{ $prop['default'] ?? '—' }}</code>
                    </td>
                    <td class="px-3 py-2 text-xs text-gray-600 dark:text-gray-400">{{ $prop['description'] ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>