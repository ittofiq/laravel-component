{{-- Komponen Footer dengan Tailwind CSS --}}
@props([
    'brand' => 'BacaDev',
    'description' => null,
    'links' => [],
    'socialLinks' => [],
    'copyright' => null,
])

@php
    $year = date('Y');
    $copyrightText = $copyright ?? "© {$year} {$brand}. All rights reserved.";
@endphp

<footer class="mt-auto bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800" style="margin-top:auto;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Brand Column --}}
            <div class="md:col-span-2">
                <a href="/" class="text-xl font-bold text-blue-600 dark:text-blue-400">{{ $brand }}</a>
                @if($description)
                    <p class="mt-3 text-sm text-gray-500 dark:text-gray-400 max-w-sm">{{ $description }}</p>
                @endif
                @if(count($socialLinks) > 0)
                    <div class="flex gap-3 mt-4">
                        @foreach($socialLinks as $social)
                            <a href="{{ $social['href'] ?? '#' }}" target="_blank" rel="noopener"
                                class="w-9 h-9 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-gray-500 dark:text-gray-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-500 dark:hover:text-blue-400 transition-colors"
                                title="{{ $social['label'] ?? '' }}">
                                @if(isset($social['icon']))
                                    <span class="text-lg">{{ $social['icon'] }}</span>
                                @else
                                    <span class="text-sm font-bold">{{ $social['label'][0] ?? '?' }}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Link Columns --}}
            @foreach($links as $group)
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider mb-4">
                        {{ $group['title'] }}
                    </h3>
                    <ul class="space-y-2.5">
                        @foreach($group['items'] as $item)
                            <li>
                                <a href="{{ $item['href'] ?? '#' }}"
                                    class="text-sm text-gray-500 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition-colors">
                                    {{ $item['label'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-10 pt-6 border-t border-gray-200 dark:border-gray-800 flex flex-col sm:flex-row items-center justify-between gap-4">
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $copyrightText }}</p>
            @if($slot->isNotEmpty())
                <div class="flex items-center gap-4">
                    {{ $slot }}
                </div>
            @endif
        </div>
    </div>
</footer>