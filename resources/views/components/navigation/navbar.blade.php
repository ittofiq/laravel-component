{{-- Komponen Navbar dengan Mobile Menu, Dropdown, Search, Notifications --}}
@props([
    'brand' => 'BacaDev',
    'brandUrl' => '/',
    'brandLogo' => null,       // URL logo image (optional)
    'links' => [],             // [['label' => 'Home', 'href' => '/', 'active' => true], ...]
    'fixed' => true,
    'variant' => 'default',    // default, transparent, colored
    'shadow' => true,
    'searchable' => false,
    'searchPlaceholder' => 'Search...',
    'notifications' => false,  // Show notification bell
    'notificationCount' => 0,
    'userMenu' => false,       // Show user avatar dropdown
    'userName' => 'User',
    'userAvatar' => null,
])

@php
    $variants = [
        'default' => 'bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700',
        'transparent' => 'bg-transparent',
        'colored' => 'bg-blue-600 dark:bg-blue-800',
    ];
    $variantClass = $variants[$variant] ?? $variants['default'];
    $textClass = $variant === 'colored' ? 'text-white' : 'text-gray-900 dark:text-white';
    $linkClass = $variant === 'colored'
        ? 'text-blue-100 hover:text-white hover:bg-blue-500/30'
        : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-800';
    $linkActiveClass = $variant === 'colored'
        ? 'bg-blue-500/40 text-white'
        : 'bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400';
@endphp

<nav
    x-data="{ mobileOpen: false, scrolled: false }"
    @scroll.window="scrolled = window.scrollY > 20"
    class="{{ $variantClass }} {{ $fixed ? 'sticky top-0 z-50' : '' }} transition-shadow duration-300"
    :class="{ 'shadow-md': scrolled && {{ $shadow ? 'true' : 'false' }} }"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Left: Brand + Links --}}
            <div class="flex items-center gap-6">
                {{-- Brand --}}
                <a href="{{ $brandUrl }}" class="flex items-center gap-2.5 flex-shrink-0">
                    @if($brandLogo)
                        <img src="{{ $brandLogo }}" alt="{{ $brand }}" class="h-8 w-auto" />
                    @endif
                    <span class="text-xl font-bold {{ $textClass }}">{{ $brand }}</span>
                </a>

                {{-- Desktop Links --}}
                @if(count($links) > 0)
                    <div class="hidden md:flex items-center gap-1">
                        @foreach($links as $link)
                            @if(isset($link['children']))
                                {{-- Dropdown Link --}}
                                <div class="relative" x-data="{ dropOpen: false }">
                                    <button @click="dropOpen = !dropOpen" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-1 {{ $linkClass }}">
                                        {{ $link['label'] }}
                                        <svg class="w-3 h-3 transition-transform" :class="dropOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                    </button>
                                    <div x-show="dropOpen" x-cloak x-transition @click.outside="dropOpen = false" class="absolute top-full left-0 mt-1 w-52 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1.5 z-50">
                                        @foreach($link['children'] as $child)
                                            @if(isset($child['children']))
                                                {{-- Level 2: Submenu item --}}
                                                <div class="relative" x-data="{ subOpen: false }" @mouseenter="subOpen = true" @mouseleave="subOpen = false">
                                                    <button @click="subOpen = !subOpen" class="w-full flex items-center justify-between px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                        <span>@if(isset($child['icon']))<span class="mr-2">{{ $child['icon'] }}</span>@endif{{ $child['label'] }}</span>
                                                        <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                                    </button>
                                                    {{-- Level 3: Nested submenu --}}
                                                    <div x-show="subOpen" x-cloak x-transition @click.outside="subOpen = false" class="absolute left-full top-0 ml-1 w-44 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1.5 z-50">
                                                        @foreach($child['children'] as $grandchild)
                                                            <a href="{{ $grandchild['href'] ?? '#' }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                                @if(isset($grandchild['icon']))<span class="mr-2">{{ $grandchild['icon'] }}</span>@endif
                                                                {{ $grandchild['label'] }}
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @else
                                                <a href="{{ $child['href'] ?? '#' }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                    @if(isset($child['icon'])) <span class="mr-2">{{ $child['icon'] }}</span> @endif
                                                    {{ $child['label'] }}
                                                </a>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a href="{{ $link['href'] ?? '#' }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ isset($link['active']) && $link['active'] ? $linkActiveClass : $linkClass }}">
                                    {{ $link['label'] }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Right: Search + Notifications + User + Actions --}}
            <div class="flex items-center gap-3">
                {{-- Search --}}
                @if($searchable)
                    <div class="hidden sm:block relative">
                        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" placeholder="{{ $searchPlaceholder }}" class="w-40 lg:w-56 pl-9 pr-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                    </div>
                @endif

                {{-- Notification Bell --}}
                @if($notifications)
                    <button class="relative p-2 rounded-lg {{ $linkClass }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        @if($notificationCount > 0)
                            <span class="absolute -top-0.5 -right-0.5 w-4.5 h-4.5 flex items-center justify-center text-[10px] font-bold text-white bg-red-500 rounded-full">{{ $notificationCount > 99 ? '99+' : $notificationCount }}</span>
                        @endif
                    </button>
                @endif

                {{-- User Menu --}}
                @if($userMenu)
                    <div class="relative" x-data="{ userOpen: false }" @click.outside="userOpen = false">
                        <button @click="userOpen = !userOpen" class="flex items-center gap-2 p-1.5 rounded-lg {{ $linkClass }}">
                            @if($userAvatar)
                                <img src="{{ $userAvatar }}" alt="{{ $userName }}" class="w-7 h-7 rounded-full object-cover" />
                            @else
                                <span class="w-7 h-7 rounded-full bg-blue-500 text-white flex items-center justify-center text-xs font-bold">{{ strtoupper(substr($userName, 0, 2)) }}</span>
                            @endif
                            <span class="hidden lg:inline text-sm font-medium">{{ $userName }}</span>
                            <svg class="w-3 h-3 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="userOpen" x-cloak class="absolute right-0 top-full mt-1 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 py-1.5 z-50">
                            <p class="px-4 py-2 text-xs text-gray-500 dark:text-gray-400 border-b border-gray-200 dark:border-gray-700">{{ $userName }}</p>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">👤 Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700">⚙️ Settings</a>
                            <div class="border-t border-gray-200 dark:border-gray-700 my-1"></div>
                            <a href="#" class="block px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30">🚪 Logout</a>
                        </div>
                    </div>
                @endif

                {{-- Actions Slot --}}
                @if($slot->isNotEmpty())
                    {{ $slot }}
                @endif

                {{-- Mobile Hamburger --}}
                <button @click="mobileOpen = !mobileOpen" class="md:hidden p-2 rounded-lg {{ $linkClass }}">
                    <svg x-show="!mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div x-show="mobileOpen" x-cloak class="md:hidden border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
        <div class="px-4 py-3 space-y-1">
            @if($searchable)
                <div class="relative mb-3">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" placeholder="{{ $searchPlaceholder }}" class="w-full pl-9 pr-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white" />
                </div>
            @endif
            @foreach($links as $link)
                @if(isset($link['children']))
                    <div x-data="{ mSub: false }">
                        <button @click="mSub = !mSub" class="w-full flex items-center justify-between px-3 py-2 rounded-lg text-sm font-medium {{ $linkClass }}">
                            {{ $link['label'] }}
                            <svg class="w-3 h-3 transition-transform" :class="mSub ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="mSub" class="ml-4 space-y-1">
                            @foreach($link['children'] as $child)
                                <a href="{{ $child['href'] ?? '#' }}" class="block px-3 py-2 rounded-lg text-sm {{ $linkClass }}">{{ $child['label'] }}</a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <a href="{{ $link['href'] ?? '#' }}" class="block px-3 py-2 rounded-lg text-sm font-medium {{ $linkClass }}">{{ $link['label'] }}</a>
                @endif
            @endforeach
        </div>
    </div>
</nav>