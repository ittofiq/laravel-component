{{-- Komponen Playground — Storybook-style interactive preview + controls + code snippet --}}
@props([
    'component' => 'ui.button',   // nama komponen Blade untuk code snippet: <x-ui.button ...>
    'title' => null,              // judul tampilan
    'controls' => [],             // [['name'=>'variant','label'=>'Variant','type'=>'select','options'=>['primary','secondary'],'default'=>'primary'], ...]
    'content' => '...',           // inner text untuk code snippet
])

@php
    // Bangun state Alpine + argumen codeSnippet dari definisi controls
    $state = ['copied: false'];
    $snippetArgs = [];
    foreach ($controls as $c) {
        $name = $c['name'];
        $default = $c['default'] ?? null;
        $state[] = $name . ': ' . json_encode($default);
        $snippetArgs[] = $name . ': ' . $name;
    }
    $xData = '{ ' . implode(', ', $state) . ' }';
    $snippetArgsStr = implode(', ', $snippetArgs);
@endphp

<div x-data="{{ $xData }}" class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
    {{-- Header --}}
    @if($title)
        <div class="px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600 flex items-center gap-2">
            <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">{{ $title }}</span>
            <code class="text-xs text-gray-400 dark:text-gray-500 font-mono">x-{{ $component }}</code>
        </div>
    @endif

    {{-- Preview --}}
    <div class="p-8 bg-gray-50 dark:bg-gray-900 flex items-center justify-center min-h-24">
        {{ $slot }}
    </div>

    {{-- Controls --}}
    @if($controls)
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700">
            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">🎮 Controls</p>
            <div class="flex flex-wrap gap-4 items-end">
                @foreach($controls as $c)
                    <label class="flex flex-col gap-1">
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $c['label'] }}</span>
                        @if(($c['type'] ?? 'select') === 'select')
                            <select x-model="{{ $c['name'] }}" class="px-2 py-1.5 text-sm rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                                @foreach($c['options'] as $opt)
                                    @if(is_array($opt))
                                        <option value="{{ $opt['value'] }}">{{ $opt['label'] ?? $opt['value'] }}</option>
                                    @else
                                        <option value="{{ $opt }}">{{ $opt }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @elseif(($c['type'] ?? 'select') === 'checkbox')
                            <input type="checkbox" x-model="{{ $c['name'] }}" class="w-4 h-4 mt-1">
                        @else
                            <input type="text" x-model="{{ $c['name'] }}" class="px-2 py-1.5 text-sm rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                        @endif
                    </label>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Code snippet --}}
    <div class="px-4 py-2.5 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex items-center gap-2">
        <code class="text-xs text-gray-600 dark:text-gray-300 font-mono flex-1 truncate" x-text="codeSnippet('{{ $component }}', { {{ $snippetArgsStr }} }, '{{ $content }}')"></code>
        <button
            type="button"
            @click="navigator.clipboard.writeText(codeSnippet('{{ $component }}', { {{ $snippetArgsStr }} }, '{{ $content }}')).then(() => { copied = true; setTimeout(() => copied = false, 1500); })"
            class="flex-shrink-0 px-2 py-1 text-xs font-medium rounded bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors"
            x-text="copied ? '✅ Copied!' : '📋 Copy'"
        ></button>
    </div>
</div>