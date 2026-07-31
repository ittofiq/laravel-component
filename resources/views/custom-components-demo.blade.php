<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komponen Custom - BacaDev</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900">

  <x-navigation.navbar />

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Level 1: Spinner -->
    <x-layout.section title="Level 1: Spinner Loading" subtitle="Komponen sederhana tanpa props" centered>
      <div class="flex justify-center py-8">
        <x-feedback.spinner />
      </div>
      <x-ui.card>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Kode:</p>
        <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded text-sm overflow-x-auto"><code>&lt;x-feedback.spinner /&gt;</code></pre>
      </x-ui.card>
    </x-layout.section>

    <!-- Level 2: Hero Section -->
    <x-layout.section title="Level 2: Hero Section" subtitle="Komponen dengan props sederhana" centered>
      <x-layout.hero
        title="Belajar Tailwind CSS"
        subtitle="Buat UI yang indah dengan cepat dan mudah"
      >
        <div class="flex gap-4">
          <x-ui.button variant="primary">Mulai Sekarang</x-ui.button>
          <x-ui.button variant="secondary">Pelajari Lebih</x-ui.button>
        </div>
      </x-layout.hero>
    </x-layout.section>

    <!-- Level 3: Pricing Cards -->
    <x-layout.section title="Level 3: Pricing Cards" subtitle="Komponen dengan logika (popular flag)" centered>
      <div class="grid md:grid-cols-3 gap-8">
        <x-custom.pricing-card
          plan="Basic"
          price="29"
          :features="['5 Projects', 'Basic Support', '1 GB Storage']"
          buttonText="Mulai Gratis"
        />
        <x-custom.pricing-card
          plan="Pro"
          price="79"
          :features="['Unlimited Projects', '24/7 Support', '100 GB Storage', 'Advanced Analytics']"
          :popular="true"
          buttonText="Upgrade Sekarang"
        />
        <x-custom.pricing-card
          plan="Enterprise"
          price="299"
          :features="['Custom Everything', 'Dedicated Support', 'Unlimited Storage', 'API Access']"
          buttonText="Hubungi Sales"
        />
      </div>
    </x-layout.section>

    <!-- Level 4: Rating Stars -->
    <x-layout.section title="Level 4: Rating Stars" subtitle="Komponen dengan state dan interaksi" centered>
      <div class="space-y-8">
        <x-ui.card title="Rating Read-only">
          <div class="space-y-4">
            <div class="flex items-center gap-4">
              <span class="text-sm font-medium">5 Bintang:</span>
              <x-custom.rating-stars rating="5" size="lg" />
            </div>
            <div class="flex items-center gap-4">
              <span class="text-sm font-medium">3 Bintang:</span>
              <x-custom.rating-stars rating="3" size="md" />
            </div>
          </div>
        </x-ui.card>

        <x-ui.card title="Rating Interaktif">
          <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Coba hover atau klik untuk memberikan rating:</p>
          <x-custom.rating-stars interactive size="lg" />
        </x-ui.card>
      </div>
    </x-layout.section>

    <!-- Level 5: Dropdown Menu -->
    <x-layout.section title="Level 5: Dropdown Menu" subtitle="Komponen dengan menu nested" centered>
      <x-ui.card>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Hover untuk membuka dropdown:</p>
        <div class="flex gap-4">
          <x-navigation.dropdown label="Akun" align="left">
            <x-navigation.dropdown.item href="#profile">👤 Profile</x-navigation.dropdown.item>
            <x-navigation.dropdown.item href="#settings">⚙️ Pengaturan</x-navigation.dropdown.item>
            <hr class="my-2 border-gray-200 dark:border-gray-700">
            <x-navigation.dropdown.item href="#logout">🚪 Logout</x-navigation.dropdown.item>
          </x-navigation.dropdown>

          <x-navigation.dropdown label="Opsi" align="left">
            <x-navigation.dropdown.item href="#edit">✏️ Edit</x-navigation.dropdown.item>
            <x-navigation.dropdown.item href="#delete">🗑️ Hapus</x-navigation.dropdown.item>
            <x-navigation.dropdown.item href="#archive">📦 Archive</x-navigation.dropdown.item>
          </x-navigation.dropdown>
        </div>
      </x-ui.card>
    </x-layout.section>

    <!-- Level 6: Section dengan Named Slots -->
    <x-layout.section title="Level 6: Section Layout" subtitle="Multiple named slots" centered>
      <x-layout.section title="Fitur Utama" subtitle="Lihat apa yang kami tawarkan">
        <div class="grid md:grid-cols-3 gap-8 mb-8">
          <x-ui.card title="⚡ Cepat">
            <p class="text-gray-600 dark:text-gray-400">Dibangun dengan Tailwind CSS, loading sangat cepat.</p>
          </x-ui.card>
          <x-ui.card title="🎨 Indah">
            <p class="text-gray-600 dark:text-gray-400">Design modern dan responsive di semua perangkat.</p>
          </x-ui.card>
          <x-ui.card title="🔧 Mudah">
            <p class="text-gray-600 dark:text-gray-400">Komponennya simple dan mudah untuk di-customize.</p>
          </x-ui.card>
        </div>

        @slot('footer')
          <div class="text-center">
            <p class="text-gray-600 dark:text-gray-400">Siap untuk menggunakan komponen-komponen ini?</p>
            <x-ui.button variant="primary" class="mt-4">Mulai Proyek Baru</x-ui.button>
          </div>
        @endslot
      </x-layout.section>
    </x-layout.section>

    <!-- Level 7: Protected Button -->
    <x-layout.section title="Level 7: Protected Button" subtitle="Permission-based rendering" centered>
      <x-ui.card title="Kontrol Akses">
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
          Tombol di bawah akan disabled jika user tidak punya permission:
        </p>
        <div class="flex gap-2">
          <x-custom.protected-button permission="delete-post">
            🗑️ Hapus Post
          </x-custom.protected-button>
          <x-custom.protected-button permission="edit-user">
            ✏️ Edit User
          </x-custom.protected-button>
          <x-custom.protected-button permission="admin">
            👑 Admin Panel
          </x-custom.protected-button>
        </div>
      </x-ui.card>
    </x-layout.section>

  </main>

  <footer class="bg-gray-800 text-gray-300 py-8 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p>&copy; 2026 BacaDev. Dibuat dengan Tailwind CSS dan Laravel.</p>
    </div>
  </footer>

</body>
</html>
