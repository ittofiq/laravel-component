{{-- Komponen Mobile Preview - Device mockup untuk preview ukuran mobile --}}
@props([
    'label' => 'Mobile Preview',
    'device' => 'iPhone 15 Pro',
    'width' => '375px',
])

<div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-lg">
    {{-- Header --}}
    <div class="flex items-center justify-between px-4 py-2.5 bg-[#21252b] border-b border-gray-700/50">
        <div class="flex items-center gap-3">
            <div class="flex gap-1.5">
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                <span class="w-3 h-3 rounded-full bg-green-500"></span>
            </div>
            <span class="text-xs text-gray-400 font-medium">{{ $label }} — {{ $device }} ({{ $width }})</span>
        </div>
        <div class="flex items-center gap-2">
            <span class="text-[10px] text-gray-500">📱</span>
        </div>
    </div>

    {{-- Phone Frame --}}
    <div class="flex justify-center bg-gray-100 dark:bg-gray-900 py-8">
        <div class="relative" style="width: {{ $width }}">
            {{-- Phone Bezel --}}
            <div class="bg-gray-900 rounded-[3rem] p-3 shadow-2xl" style="box-shadow: 0 0 0 4px #1f2937, 0 0 0 6px #374151, 0 20px 60px rgba(0,0,0,0.5);">
                {{-- Dynamic Island --}}
                <div class="flex justify-center mb-3">
                    <div class="w-28 h-7 bg-black rounded-full"></div>
                </div>

                {{-- Screen --}}
                <div class="bg-white dark:bg-gray-800 rounded-[2rem] overflow-hidden border border-gray-700">
                    {{-- Status Bar --}}
                    <div class="flex items-center justify-between px-6 py-2 bg-white dark:bg-gray-800 text-[10px] font-semibold text-gray-900 dark:text-white">
                        <span>9:41</span>
                        <span class="flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/></svg>
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M17.778 8.222c-4.296-4.296-11.26-4.296-15.556 0A1 1 0 01.808 6.808c5.076-5.077 13.308-5.077 18.384 0a1 1 0 01-1.414 1.414zM14.95 11.05a7 7 0 00-9.9 0 1 1 0 01-1.414-1.414 9 9 0 0112.728 0 1 1 0 01-1.414 1.414zM12.12 13.88a3 3 0 00-4.242 0 1 1 0 01-1.415-1.415 5 5 0 017.072 0 1 1 0 01-1.415 1.415zM10 16a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/></svg>
                            <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                        </span>
                    </div>

                    {{-- Content Area --}}
                    <div class="overflow-y-auto p-4 space-y-3" style="max-height: 500px; min-height: 250px;">
                        {!! $slot !!}
                    </div>

                    {{-- Home Indicator --}}
                    <div class="flex justify-center pb-2 pt-1 bg-white dark:bg-gray-800">
                        <div class="w-32 h-1 bg-gray-300 dark:bg-gray-600 rounded-full"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>