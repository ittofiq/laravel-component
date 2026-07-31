@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold mb-2 text-gray-900 dark:text-white">🌐 Demo Pages</h1>
    <p class="text-gray-600 dark:text-gray-400 mb-12">Jelajahi dan test semua 72 komponen BacaDev</p>

    <!-- MAIN DEMOS -->
    <section class="mb-16">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white">📚 Main Demo Pages</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Complete Component Library -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">📦 Complete Component Library</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Semua 72 komponen dalam 8 kategori</p>
                <a href="{{ route('components') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    View Components →
                </a>
            </div>

            <!-- Custom Components -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">🎁 Custom Components</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Komponen custom untuk use case khusus</p>
                <a href="{{ route('custom.components') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    View Custom →
                </a>
            </div>

            <!-- Minimal Demo -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">⚡ Minimal Demo</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Demo sederhana dengan beberapa komponen utama</p>
                <a href="{{ route('demo.minimal') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    View Demo →
                </a>
            </div>

            <!-- Textarea Demo -->
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-lg transition-shadow">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">📝 Textarea Component</h3>
                <p class="text-gray-600 dark:text-gray-400 mb-4">Demo detail komponen textarea</p>
                <a href="{{ route('textarea.demo') }}" class="inline-block px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                    View Demo →
                </a>
            </div>
        </div>
    </section>

    <!-- COMPONENT CATEGORIES -->
    <section class="mb-16">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white">🎨 Component Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg border border-blue-200 dark:border-blue-800">
                <p class="text-2xl mb-2">🎨</p>
                <p class="font-semibold text-gray-900 dark:text-white">UI Components</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">7 komponen</p>
            </div>
            <div class="p-4 bg-green-50 dark:bg-green-900/30 rounded-lg border border-green-200 dark:border-green-800">
                <p class="text-2xl mb-2">📝</p>
                <p class="font-semibold text-gray-900 dark:text-white">Form Components</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">18 komponen</p>
            </div>
            <div class="p-4 bg-purple-50 dark:bg-purple-900/30 rounded-lg border border-purple-200 dark:border-purple-800">
                <p class="text-2xl mb-2">📊</p>
                <p class="font-semibold text-gray-900 dark:text-white">Data Components</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">8 komponen</p>
            </div>
            <div class="p-4 bg-orange-50 dark:bg-orange-900/30 rounded-lg border border-orange-200 dark:border-orange-800">
                <p class="text-2xl mb-2">🧭</p>
                <p class="font-semibold text-gray-900 dark:text-white">Navigation</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">8 komponen</p>
            </div>
            <div class="p-4 bg-pink-50 dark:bg-pink-900/30 rounded-lg border border-pink-200 dark:border-pink-800">
                <p class="text-2xl mb-2">🪟</p>
                <p class="font-semibold text-gray-900 dark:text-white">Overlay Components</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">8 komponen</p>
            </div>
            <div class="p-4 bg-red-50 dark:bg-red-900/30 rounded-lg border border-red-200 dark:border-red-800">
                <p class="text-2xl mb-2">🔔</p>
                <p class="font-semibold text-gray-900 dark:text-white">Feedback Components</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">6 komponen</p>
            </div>
            <div class="p-4 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg border border-indigo-200 dark:border-indigo-800">
                <p class="text-2xl mb-2">🏗️</p>
                <p class="font-semibold text-gray-900 dark:text-white">Layout Components</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">9 komponen</p>
            </div>
            <div class="p-4 bg-yellow-50 dark:bg-yellow-900/30 rounded-lg border border-yellow-200 dark:border-yellow-800">
                <p class="text-2xl mb-2">🎁</p>
                <p class="font-semibold text-gray-900 dark:text-white">Custom Components</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">8 komponen</p>
            </div>
        </div>
    </section>

    <!-- QUICK LINKS -->
    <section class="mb-16">
        <h2 class="text-2xl font-bold mb-8 text-gray-900 dark:text-white">🚀 Quick Links</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{ route('components') }}" class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400 transition-colors">
                <p class="font-semibold text-gray-900 dark:text-white">👀 View All Components</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">Lihat semua 72 komponen siap pakai</p>
            </a>
            <a href="{{ url('/') }}" class="p-4 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 hover:border-blue-500 dark:hover:border-blue-400 transition-colors">
                <p class="font-semibold text-gray-900 dark:text-white">🏠 Back to Home</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">Kembali ke halaman utama</p>
            </a>
        </div>
    </section>

    <!-- STATISTICS -->
    <section class="p-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg text-white">
        <h2 class="text-3xl font-bold mb-4">📈 BacaDev Component Library</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div>
                <p class="text-4xl font-bold">72</p>
                <p class="text-sm opacity-90">Total Components</p>
            </div>
            <div>
                <p class="text-4xl font-bold">100%</p>
                <p class="text-sm opacity-90">Dark Mode</p>
            </div>
            <div>
                <p class="text-4xl font-bold">8</p>
                <p class="text-sm opacity-90">Categories</p>
            </div>
            <div>
                <p class="text-4xl font-bold">0</p>
                <p class="text-sm opacity-90">Dependencies</p>
            </div>
        </div>
        <p class="mt-6 text-sm opacity-90">Production-ready component library built with Tailwind CSS & Laravel Blade</p>
    </section>

</div>
@endsection
