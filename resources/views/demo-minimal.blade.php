<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Minimal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white dark:bg-gray-900">

<div class="max-w-4xl mx-auto p-8">

    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
        🧪 Demo Minimal - Test Tailwind CSS
    </h1>

    <p class="text-lg text-gray-600 dark:text-gray-400 mb-8">
        Jika Anda bisa melihat halaman ini dengan styling yang benar, Tailwind CSS sudah loaded.
    </p>

    <!-- Test Colors -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Test 1: Tailwind Colors
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="h-20 bg-blue-500 rounded flex items-center justify-center text-white font-bold">
                Blue 500
            </div>
            <div class="h-20 bg-red-500 rounded flex items-center justify-center text-white font-bold">
                Red 500
            </div>
            <div class="h-20 bg-green-500 rounded flex items-center justify-center text-white font-bold">
                Green 500
            </div>
            <div class="h-20 bg-purple-500 rounded flex items-center justify-center text-white font-bold">
                Purple 500
            </div>
        </div>
    </section>

    <!-- Test Typography -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Test 2: Typography
        </h2>
        <div class="space-y-3">
            <p class="text-xs text-gray-600 dark:text-gray-400">Text XS</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">Text SM</p>
            <p class="text-base text-gray-600 dark:text-gray-400">Text Base</p>
            <p class="text-lg text-gray-600 dark:text-gray-400">Text LG</p>
            <p class="text-xl font-bold text-gray-900 dark:text-white">Text XL Bold</p>
        </div>
    </section>

    <!-- Test Spacing -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Test 3: Spacing (Padding)
        </h2>
        <div class="space-y-3">
            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded">p-2 (small padding)</div>
            <div class="p-4 bg-blue-100 dark:bg-blue-900/30 rounded">p-4 (medium padding)</div>
            <div class="p-8 bg-blue-100 dark:bg-blue-900/30 rounded">p-8 (large padding)</div>
        </div>
    </section>

    <!-- Test Dark Mode -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Test 4: Dark Mode
        </h2>
        <div class="p-6 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded">
            <p class="text-gray-900 dark:text-white">
                ✨ Jika Anda enable dark mode, warna akan berubah (background gelap, text terang)
            </p>
        </div>
    </section>

    <!-- Test Buttons -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
            Test 5: Basic Buttons
        </h2>
        <div class="space-y-3">
            <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                Blue Button
            </button>
            <button class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                Green Button
            </button>
            <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 transition">
                Red Button
            </button>
        </div>
    </section>

    <!-- Status -->
    <section class="p-6 bg-green-50 dark:bg-green-900/20 rounded border border-green-200 dark:border-green-700">
        <h3 class="text-lg font-bold text-green-900 dark:text-green-200 mb-2">
            ✅ Tailwind CSS Loaded Successfully!
        </h3>
        <p class="text-green-800 dark:text-green-300">
            Jika Anda bisa melihat:
        </p>
        <ul class="list-disc ml-6 mt-2 text-green-800 dark:text-green-300 space-y-1">
            <li>5 colored boxes dengan text "Blue 500", "Red 500", dll</li>
            <li>Typography dengan berbagai ukuran</li>
            <li>Padding examples</li>
            <li>Dark mode berubah saat di-toggle</li>
            <li>Buttons yang berwarna dan bisa di-hover</li>
        </ul>
        <p class="mt-4 text-green-800 dark:text-green-300">
            Maka Tailwind CSS dan Vite sudah bekerja dengan sempurna!
        </p>
    </section>

    <!-- Back -->
    <div class="mt-12 text-center">
        <a href="http://localhost:8000/" class="text-blue-500 hover:underline dark:text-blue-400">
            ← Kembali ke Home
        </a>
    </div>

</div>

</body>
</html>
