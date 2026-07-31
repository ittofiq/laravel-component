<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test - BacaDev</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">

  <main class="max-w-4xl mx-auto px-4 py-12">

    <!-- Test 1: Basic HTML -->
    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-8">
      🧪 Test Page - BacaDev
    </h1>

    <!-- Test 2: Simple Button Component -->
    <section class="mb-12">
      <h2 class="text-2xl font-bold mb-4">Test 1: Button Component</h2>
      <div class="p-6 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
        <x-button variant="primary">Test Button</x-button>
      </div>
    </section>

    <!-- Test 3: Simple Card Component -->
    <section class="mb-12">
      <h2 class="text-2xl font-bold mb-4">Test 2: Card Component</h2>
      <x-card title="Test Card">
        <p>Ini adalah test card component</p>
      </x-card>
    </section>

    <!-- Test 4: Input Component -->
    <section class="mb-12">
      <h2 class="text-2xl font-bold mb-4">Test 3: Input Component</h2>
      <x-card>
        <x-input name="test" label="Test Input" placeholder="Ketik sesuatu..." />
      </x-card>
    </section>

    <!-- Test 5: Tailwind Styling -->
    <section class="mb-12">
      <h2 class="text-2xl font-bold mb-4">Test 4: Tailwind Styling</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="p-4 bg-blue-500 text-white rounded">Blue Box</div>
        <div class="p-4 bg-red-500 text-white rounded">Red Box</div>
        <div class="p-4 bg-green-500 text-white rounded">Green Box</div>
        <div class="p-4 bg-yellow-500 text-white rounded">Yellow Box</div>
      </div>
    </section>

    <!-- Test 6: Dark Mode -->
    <section class="mb-12">
      <h2 class="text-2xl font-bold mb-4">Test 5: Dark Mode</h2>
      <div class="p-6 bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700">
        <p class="text-gray-900 dark:text-white">
          Teks ini akan berubah warna di dark mode
        </p>
      </div>
    </section>

    <!-- Status -->
    <section class="mt-12 p-6 bg-green-50 dark:bg-green-900/20 rounded border border-green-200 dark:border-green-700">
      <h3 class="text-lg font-bold text-green-900 dark:text-green-200 mb-2">✅ Setup OK!</h3>
      <p class="text-green-800 dark:text-green-300">
        Jika Anda bisa melihat halaman ini dengan styling yang benar, berarti:
      </p>
      <ul class="list-disc ml-6 mt-2 text-green-800 dark:text-green-300 space-y-1">
        <li>✅ Vite dev server berjalan</li>
        <li>✅ Tailwind CSS loaded</li>
        <li>✅ Komponen Laravel bekerja</li>
        <li>✅ Hot reload siap</li>
      </ul>
    </section>

  </main>

</body>
</html>
