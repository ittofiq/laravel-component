<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Komponen Textarea - BacaDev</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-900">

  <x-navigation.navbar />

  <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Header -->
    <div class="mb-12">
      <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
        Komponen Textarea
      </h1>
      <p class="text-lg text-gray-600 dark:text-gray-400">
        Komponen textarea dengan validasi, character count, dan error handling.
      </p>
    </div>

    <!-- Example 1: Textarea Sederhana -->
    <x-layout.section title="Textarea Sederhana" subtitle="Tanpa props tambahan">
      <x-ui.card>
        <x-form.textarea name="message" placeholder="Tulis pesan Anda di sini..." />
      </x-ui.card>
    </x-layout.section>

    <!-- Example 2: Textarea dengan Label -->
    <x-layout.section title="Textarea dengan Label" subtitle="Label otomatis dan helper text">
      <x-ui.card>
        <x-form.textarea
          name="description"
          label="Deskripsi Produk"
          placeholder="Tulis deskripsi produk..."
          helperText="Jelaskan fitur dan manfaat produk Anda"
          rows="5"
        />
      </x-ui.card>
    </x-layout.section>

    <!-- Example 3: Textarea Required -->
    <x-layout.section title="Textarea Required" subtitle="Dengan indikator required">
      <x-ui.card>
        <x-form.textarea
          name="feedback"
          label="Feedback Anda"
          placeholder="Kami ingin mendengar saran Anda..."
          required
          rows="4"
        />
      </x-ui.card>
    </x-layout.section>

    <!-- Example 4: Textarea dengan Character Count -->
    <x-layout.section title="Textarea dengan Character Count" subtitle="Limit jumlah karakter">
      <x-ui.card>
        <x-form.textarea
          name="bio"
          label="Bio Singkat"
          placeholder="Tulis bio Anda (max 200 karakter)"
          maxLength="200"
          helperText="Jangan lebih dari 200 karakter"
          rows="3"
        />
      </x-ui.card>
    </x-layout.section>

    <!-- Example 5: Textarea dengan Error -->
    <x-layout.section title="Textarea dengan Error" subtitle="Menampilkan error message">
      <x-ui.card>
        <x-form.textarea
          name="email_error"
          label="Email"
          placeholder="nama@example.com"
          error="Format email tidak valid. Gunakan format: nama@example.com"
          rows="2"
        />
      </x-ui.card>
    </x-layout.section>

    <!-- Example 6: Textarea Disabled -->
    <x-layout.section title="Textarea Disabled" subtitle="Tidak bisa diedit">
      <x-ui.card>
        <x-form.textarea
          name="disabled_text"
          label="Field Disabled"
          value="Ini adalah text yang tidak bisa diedit. Field ini disabled."
          disabled
          rows="3"
        />
      </x-ui.card>
    </x-layout.section>

    <!-- Example 7: Textarea Readonly -->
    <x-layout.section title="Textarea Readonly" subtitle="Bisa dipilih tapi tidak bisa diedit">
      <x-ui.card>
        <x-form.textarea
          name="readonly_text"
          label="Field Readonly"
          value="Anda bisa memilih text ini tapi tidak bisa mengeditnya. Field ini readonly."
          readonly
          rows="3"
        />
      </x-ui.card>
    </x-layout.section>

    <!-- Example 8: Textarea dengan Min/Max Length -->
    <x-layout.section title="Textarea dengan Min/Max Length" subtitle="Validasi panjang text">
      <x-ui.card>
        <x-form.textarea
          name="comment"
          label="Komentar"
          placeholder="Minimal 10 karakter, maksimal 500 karakter"
          minLength="10"
          maxLength="500"
          helperText="Tulis komentar yang bermakna"
          rows="4"
        />
      </x-ui.card>
    </x-layout.section>

    <!-- Example 9: Textarea dengan Value Pre-filled -->
    <x-layout.section title="Textarea dengan Value Pre-filled" subtitle="Text yang sudah ada">
      <x-ui.card>
        <x-form.textarea
          name="edited_text"
          label="Edit Text"
          value="Ini adalah teks yang sudah ada sebelumnya. Anda bisa mengeditnya sesuai kebutuhan."
          rows="4"
        />
      </x-ui.card>
    </x-layout.section>

    <!-- Example 10: Form Demo -->
    <x-layout.section title="Form Demo" subtitle="Kombinasi beberapa textarea">
      <x-ui.card title="Buat Artikel">
        <form class="space-y-6">
          @csrf

          <!-- Judul -->
          <x-form.input
            name="title"
            label="Judul Artikel"
            placeholder="Masukkan judul artikel..."
            required
          />

          <!-- Deskripsi Singkat -->
          <x-form.textarea
            name="summary"
            label="Deskripsi Singkat"
            placeholder="Ringkasan artikel dalam 1-2 kalimat..."
            maxLength="200"
            helperText="Gunakan untuk meta description (max 200 karakter)"
            rows="2"
            required
          />

          <!-- Konten Utama -->
          <x-form.textarea
            name="content"
            label="Konten Artikel"
            placeholder="Tulis konten artikel Anda di sini..."
            minLength="50"
            maxLength="5000"
            helperText="Minimum 50 karakter, maksimum 5000 karakter"
            rows="8"
            required
          />

          <!-- Catatan -->
          <x-form.textarea
            name="notes"
            label="Catatan (Optional)"
            placeholder="Catatan internal atau note editor..."
            helperText="Catatan ini tidak akan ditampilkan di depan"
            rows="3"
          />

          <!-- Buttons -->
          <div class="flex gap-4 pt-4">
            <x-ui.button type="submit" variant="primary">
              Publikasikan Artikel
            </x-ui.button>
            <x-ui.button type="reset" variant="secondary">
              Reset Form
            </x-ui.button>
          </div>
        </form>
      </x-ui.card>
    </x-layout.section>

    <!-- Props Documentation -->
    <x-layout.section title="Props Documentation" subtitle="Semua parameter yang tersedia">
      <x-ui.card title="Props List">
        <div class="overflow-x-auto">
          <table class="w-full text-sm">
            <thead class="bg-gray-100 dark:bg-gray-800">
              <tr>
                <th class="text-left px-4 py-2 font-semibold">Props</th>
                <th class="text-left px-4 py-2 font-semibold">Tipe</th>
                <th class="text-left px-4 py-2 font-semibold">Default</th>
                <th class="text-left px-4 py-2 font-semibold">Deskripsi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              <tr>
                <td class="px-4 py-2"><code>name</code></td>
                <td class="px-4 py-2">string</td>
                <td class="px-4 py-2">-</td>
                <td class="px-4 py-2">Nama input form</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>label</code></td>
                <td class="px-4 py-2">string</td>
                <td class="px-4 py-2">null</td>
                <td class="px-4 py-2">Label textarea</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>placeholder</code></td>
                <td class="px-4 py-2">string</td>
                <td class="px-4 py-2">null</td>
                <td class="px-4 py-2">Placeholder text</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>rows</code></td>
                <td class="px-4 py-2">number</td>
                <td class="px-4 py-2">4</td>
                <td class="px-4 py-2">Jumlah baris</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>value</code></td>
                <td class="px-4 py-2">string</td>
                <td class="px-4 py-2">null</td>
                <td class="px-4 py-2">Value textarea</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>error</code></td>
                <td class="px-4 py-2">string</td>
                <td class="px-4 py-2">null</td>
                <td class="px-4 py-2">Error message</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>helperText</code></td>
                <td class="px-4 py-2">string</td>
                <td class="px-4 py-2">null</td>
                <td class="px-4 py-2">Helper text di bawah textarea</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>maxLength</code></td>
                <td class="px-4 py-2">number</td>
                <td class="px-4 py-2">null</td>
                <td class="px-4 py-2">Max character count</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>minLength</code></td>
                <td class="px-4 py-2">number</td>
                <td class="px-4 py-2">null</td>
                <td class="px-4 py-2">Min character count</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>required</code></td>
                <td class="px-4 py-2">boolean</td>
                <td class="px-4 py-2">false</td>
                <td class="px-4 py-2">Indikator required</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>disabled</code></td>
                <td class="px-4 py-2">boolean</td>
                <td class="px-4 py-2">false</td>
                <td class="px-4 py-2">Disable textarea</td>
              </tr>
              <tr>
                <td class="px-4 py-2"><code>readonly</code></td>
                <td class="px-4 py-2">boolean</td>
                <td class="px-4 py-2">false</td>
                <td class="px-4 py-2">Readonly textarea</td>
              </tr>
            </tbody>
          </table>
        </div>
      </x-ui.card>
    </x-layout.section>

    <!-- Usage Examples -->
    <x-layout.section title="Contoh Penggunaan" subtitle="Code snippet untuk berbagai use case">
      <div class="space-y-6">

        <!-- Example 1 -->
        <x-ui.card title="Contoh 1: Textarea Sederhana">
          <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded text-sm overflow-x-auto"><code>&lt;x-form.textarea
  name="message"
  placeholder="Tulis pesan..."
/&gt;</code></pre>
        </x-ui.card>

        <!-- Example 2 -->
        <x-ui.card title="Contoh 2: Dengan Label dan Helper Text">
          <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded text-sm overflow-x-auto"><code>&lt;x-form.textarea
  name="feedback"
  label="Masukan Anda"
  placeholder="Apa pendapat Anda?"
  helperText="Feedback Anda sangat berharga"
  rows="5"
/&gt;</code></pre>
        </x-ui.card>

        <!-- Example 3 -->
        <x-ui.card title="Contoh 3: Dengan Character Limit">
          <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded text-sm overflow-x-auto"><code>&lt;x-form.textarea
  name="bio"
  label="Bio Singkat"
  maxLength="150"
  helperText="Max 150 karakter"
  rows="3"
/&gt;</code></pre>
        </x-ui.card>

        <!-- Example 4 -->
        <x-ui.card title="Contoh 4: Dengan Validation">
          <pre class="bg-gray-100 dark:bg-gray-800 p-4 rounded text-sm overflow-x-auto"><code>&lt;x-form.textarea
  name="content"
  label="Konten"
  minLength="10"
  maxLength="500"
  required
  error="{{ $errors->first('content') }}"
/&gt;</code></pre>
        </x-ui.card>

      </div>
    </x-layout.section>

  </main>

  <footer class="bg-gray-800 text-gray-300 py-8 mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
      <p>&copy; 2026 BacaDev. Komponen Textarea dibuat dengan Tailwind CSS dan Laravel.</p>
    </div>
  </footer>

</body>
</html>
