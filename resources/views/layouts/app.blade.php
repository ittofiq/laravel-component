<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Terapkan tema sebelum CSS load, mencegah flash tema yang salah --}}
    <script>
        (function () {
            var t = localStorage.getItem('theme');
            if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        })();
    </script>
    <meta name="description" content="BacaDev - Production-ready Tailwind CSS Component Library untuk Laravel dengan 101 Blade components">
    <meta property="og:title" content="BacaDev Component Library">
    <meta property="og:description" content="101 production-ready Blade components dengan Tailwind CSS 4, Alpine.js, dan dark mode.">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="BacaDev Component Library">
    <meta name="twitter:description" content="101 production-ready Blade components untuk Laravel">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎨</text></svg>">
    <title>@yield('title', 'BacaDev - Component Library')</title>
    @vite(['resources/css/app.css', 'resources/js/app.ts'])
</head>
<body class="min-h-screen flex flex-col bg-gray-50 dark:bg-gray-900" style="min-height:100vh;display:flex;flex-direction:column;" x-data="darkMode()" @keydown.window="handleShortcut($event)">
    {{-- Skip to content --}}
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[99999] focus:px-4 focus:py-2 focus:bg-white dark:focus:bg-gray-800 focus:border focus:border-blue-500 focus:rounded-lg focus:shadow-lg focus:text-blue-700 dark:focus:text-blue-300 focus:outline-none">
        Skip to content
    </a>

    <main id="main-content" class="flex-1 flex flex-col" style="flex:1 1 0%;display:flex;flex-direction:column;">
        @yield('content')
    </main>

    {{-- Dark Mode Toggle --}}
    <button
        @click="toggle"
        class="fixed top-6 right-6 z-[9998] w-12 h-12 rounded-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 shadow-lg flex items-center justify-center hover:scale-110 transition-transform"
        :aria-label="isDark ? 'Switch to light mode' : 'Switch to dark mode'"
        title="Toggle dark mode (D)"
    >
        {{-- Sun icon (light mode) --}}
        <svg x-show="!isDark" class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
        </svg>
        {{-- Moon icon (dark mode) --}}
        <svg x-show="isDark" class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
        </svg>
    </button>

    {{-- Keyboard Shortcuts Help Modal --}}
    <div
        x-data="{ shortcutsOpen: false }"
        x-show="shortcutsOpen"
        @keydown.escape.window="shortcutsOpen = false"
        @open-shortcuts.window="shortcutsOpen = true"
        class="fixed inset-0 z-[9999] flex items-center justify-center"
        x-cloak
    >
        <div class="absolute inset-0 bg-black/60" @click="shortcutsOpen = false"></div>
        <div class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 p-8 max-w-lg w-full mx-4 max-h-[85vh] overflow-y-auto">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">⌨️ Keyboard Shortcuts</h2>
                <button @click="shortcutsOpen = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="space-y-5">
                <div>
                    <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Navigasi</h3>
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Home</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G H</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Semua Komponen</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G C</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">UI Components</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G U</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Form Components</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G F</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Data Components</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G D</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Navigation</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G N</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Overlay</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G O</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Feedback</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G B</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Layout</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G L</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Custom</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">G M</kbd></div>
                    </div>
                </div>
                <div>
                    <h3 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Aksi</h3>
                    <div class="space-y-1.5">
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Toggle Dark Mode</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">D</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Tampilkan Shortcuts</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">?</kbd></div>
                        <div class="flex items-center justify-between text-sm"><span class="text-gray-600 dark:text-gray-300">Tutup Modal</span><kbd class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-600 dark:text-gray-300">Esc</kbd></div>
                    </div>
                </div>
            </div>

            <p class="text-xs text-gray-400 dark:text-gray-500 mt-6 text-center">Tekan <kbd class="px-1.5 py-0.5 bg-gray-100 dark:bg-gray-700 rounded font-mono">?</kbd> kapan saja untuk menampilkan panduan ini</p>
        </div>
    </div>

    {{-- Keyboard shortcut hint --}}
    <div class="fixed bottom-4 right-6 z-40">
        <button @click="$dispatch('open-shortcuts')" class="px-3 py-1.5 text-xs bg-white/90 dark:bg-gray-800/90 backdrop-blur border border-gray-200 dark:border-gray-700 rounded-lg shadow text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 transition">
            <kbd class="px-1 py-0.5 bg-gray-100 dark:bg-gray-700 rounded font-mono text-gray-500 dark:text-gray-400">?</kbd> Shortcuts
        </button>
    </div>
</body>
</html>